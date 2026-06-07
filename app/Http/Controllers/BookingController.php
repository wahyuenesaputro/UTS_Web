<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Models\Booking;
use App\Models\Field;
use App\Models\Payment;
use App\Models\Voucher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    /**
     * User: View their own bookings list.
     */
    public function index()
    {
        $bookings = Booking::with(['field', 'payment'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('user.bookings.index', compact('bookings'));
    }

    /**
     * Admin: View all bookings in the system.
     */
    public function adminIndex(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');
        $fieldId = $request->input('field_id');

        $bookings = Booking::with(['user', 'field', 'payment'])
            ->when($search, function ($query, $search) {
                return $query->where('kode_booking', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            })
            ->when($status, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->when($fieldId, function ($query, $fieldId) {
                return $query->where('field_id', $fieldId);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(15)
            ->withQueryString();

        $fields = Field::all();

        return view('admin.bookings.index', compact('bookings', 'fields'));
    }

    /**
     * User: Show booking form.
     */
    public function create(Request $request)
    {
        $fields = Field::where('status', 'tersedia')->get();
        $selectedFieldId = $request->input('field_id');
        
        return view('user.bookings.create', compact('fields', 'selectedFieldId'));
    }

    /**
     * User: Store a booking.
     */
    public function store(StoreBookingRequest $request)
    {
        $validated = $request->validated();
        
        $field = Field::findOrFail($validated['field_id']);
        
        // 1. Check if court is available
        if ($field->status !== 'tersedia') {
            return back()->withInput()->withErrors(['field_id' => 'Lapangan sedang tidak tersedia untuk dipesan.']);
        }

        // 2. Calculate end time
        $startTime = Carbon::createFromFormat('H:i', $validated['jam_mulai']);
        $endTime = (clone $startTime)->addHours((int) $validated['durasi']);
        
        $jamMulai = $startTime->format('H:i:s');
        $jamSelesai = $endTime->format('H:i:s');
        
        // 3. Conflict check: A court cannot have multiple bookings at the same date and overlapping times
        // Logic: start1 < end2 AND end1 > start2
        $overlapExists = Booking::where('field_id', $field->id)
            ->where('tanggal', $validated['tanggal'])
            ->where('status', '!=', 'dibatalkan')
            ->where(function ($query) use ($jamMulai, $jamSelesai) {
                $query->where('jam_mulai', '<', $jamSelesai)
                      ->where('jam_selesai', '>', $jamMulai);
            })
            ->exists();

        if ($overlapExists) {
            return back()->withInput()->withErrors(['jam_mulai' => 'Lapangan sudah dipesan pada tanggal dan jam tersebut. Silakan pilih waktu lain.']);
        }

        // 4. Calculate pricing
        $subtotal = $field->harga_per_jam * $validated['durasi'];
        $discount = 0;

        // 5. Apply Voucher if any
        if (!empty($validated['kode_voucher'])) {
            $voucher = Voucher::where('kode_voucher', $validated['kode_voucher'])
                ->where('status', 'aktif')
                ->whereDate('tanggal_mulai', '<=', $validated['tanggal'])
                ->whereDate('tanggal_berakhir', '>=', $validated['tanggal'])
                ->first();

            if (!$voucher) {
                return back()->withInput()->withErrors(['kode_voucher' => 'Kode voucher tidak valid atau sudah kedaluwarsa.']);
            }
            $discount = $voucher->diskon;
        }

        $totalHarga = max(0, $subtotal - $discount);
        
        // 6. Generate kode_booking
        $kodeBooking = 'BK-' . strtoupper(Str::random(8));
        while (Booking::where('kode_booking', $kodeBooking)->exists()) {
            $kodeBooking = 'BK-' . strtoupper(Str::random(8));
        }

        // 7. Create booking
        $booking = Booking::create([
            'kode_booking' => $kodeBooking,
            'user_id' => Auth::id(),
            'field_id' => $field->id,
            'tanggal' => $validated['tanggal'],
            'jam_mulai' => $jamMulai,
            'durasi' => $validated['durasi'],
            'jam_selesai' => $jamSelesai,
            'total_harga' => $totalHarga,
            'status' => 'pending',
        ]);

        // 8. Auto-create pending payment record
        Payment::create([
            'booking_id' => $booking->id,
            'metode_pembayaran' => 'Transfer Bank', // default
            'bukti_pembayaran' => null,
            'status' => 'pending',
        ]);

        return redirect()->route('user.payments.show', $booking->id)
            ->with('success', 'Booking berhasil dibuat! Silakan lakukan pembayaran.');
    }

    /**
     * User/Admin: View details.
     */
    public function show(Booking $booking)
    {
        // Check authorization
        if (Auth::user()->role !== 'admin' && $booking->user_id !== Auth::id()) {
            abort(403);
        }

        $booking->load(['field', 'payment', 'user']);
        return view('user.bookings.show', compact('booking'));
    }

    /**
     * Admin: Approve a booking.
     */
    public function approve(Booking $booking)
    {
        $booking->update(['status' => 'disetujui']);
        
        // Automatically approve payment as successful if payment exists
        if ($booking->payment) {
            $booking->payment->update(['status' => 'berhasil']);
        }

        return back()->with('success', 'Booking berhasil disetujui.');
    }

    /**
     * Admin: Cancel a booking.
     */
    public function cancel(Booking $booking)
    {
        $booking->update(['status' => 'dibatalkan']);

        // Automatically reject payment if payment exists
        if ($booking->payment) {
            $booking->payment->update(['status' => 'ditolak']);
        }

        return back()->with('success', 'Booking berhasil dibatalkan.');
    }
}
