<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    /**
     * User: Show payment page for a specific booking.
     */
    public function show($bookingId)
    {
        $booking = Booking::with(['field', 'payment'])->findOrFail($bookingId);

        // Authorize user
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        return view('user.payments.show', compact('booking'));
    }

    /**
     * User: Upload proof of payment.
     */
    public function uploadProof(Request $request, Booking $booking)
    {
        // Authorize user
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'metode_pembayaran' => 'required|in:Transfer Bank,QRIS,E-Wallet',
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $payment = $booking->payment;

        if (!$payment) {
            $payment = new Payment(['booking_id' => $booking->id]);
        }

        // Delete old proof if exists
        if ($payment->bukti_pembayaran) {
            Storage::disk('public')->delete($payment->bukti_pembayaran);
        }

        // Save new proof
        $path = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');

        $payment->fill([
            'metode_pembayaran' => $request->metode_pembayaran,
            'bukti_pembayaran' => $path,
            'status' => 'pending', // Re-evaluate back to pending
        ])->save();

        return redirect()->route('user.bookings.index')
            ->with('success', 'Bukti pembayaran berhasil diunggah. Menunggu verifikasi admin.');
    }

    /**
     * Admin: List all payments.
     */
    public function adminIndex(Request $request)
    {
        $status = $request->input('status');

        $payments = Payment::with(['booking.user', 'booking.field'])
            ->when($status, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(15)
            ->withQueryString();

        return view('admin.payments.index', compact('payments'));
    }

    /**
     * Admin: Verify payment (Mark as Berhasil).
     */
    public function verify(Payment $payment)
    {
        $payment->update(['status' => 'berhasil']);
        
        // Also approve booking
        $payment->booking->update(['status' => 'disetujui']);

        return back()->with('success', 'Pembayaran berhasil diverifikasi.');
    }

    /**
     * Admin: Reject payment (Mark as Ditolak).
     */
    public function reject(Payment $payment)
    {
        $payment->update(['status' => 'ditolak']);

        // Also cancel booking
        $payment->booking->update(['status' => 'dibatalkan']);

        return back()->with('success', 'Pembayaran ditolak dan booking dibatalkan.');
    }
}
