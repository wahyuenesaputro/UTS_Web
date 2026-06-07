<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Field;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Show report form.
     */
    public function index()
    {
        return view('admin.reports.index');
    }

    /**
     * Generate report and export to PDF.
     */
    public function generate(Request $request)
    {
        $request->validate([
            'tipe_laporan' => 'required|in:harian,bulanan,tahunan',
            'tanggal' => 'required_if:tipe_laporan,harian|nullable|date',
            'bulan' => 'required_if:tipe_laporan,bulanan|nullable|integer|between:1,12',
            'tahun' => 'required_if:tipe_laporan,bulanan,tahunan|nullable|integer|min:2020|max:2035',
        ]);

        $tipe = $request->tipe_laporan;
        $bookingsQuery = Booking::with(['user', 'field', 'payment'])
            ->whereIn('status', ['disetujui', 'selesai']);

        $title = 'Laporan Pendapatan';
        $period = '';

        if ($tipe === 'harian') {
            $date = Carbon::parse($request->tanggal);
            $bookingsQuery->whereDate('tanggal', $date);
            $period = $date->translatedFormat('d F Y');
            $title .= ' Harian';
        } elseif ($tipe === 'bulanan') {
            $month = $request->bulan;
            $year = $request->tahun;
            $bookingsQuery->whereMonth('tanggal', $month)->whereYear('tanggal', $year);
            $period = Carbon::createFromDate($year, $month, 1)->translatedFormat('F Y');
            $title .= ' Bulanan';
        } else {
            $year = $request->tahun;
            $bookingsQuery->whereYear('tanggal', $year);
            $period = $year;
            $title .= ' Tahunan';
        }

        $bookings = $bookingsQuery->orderBy('tanggal', 'asc')->get();

        // Totals
        $totalBooking = $bookings->count();
        $totalPendapatan = $bookings->sum('total_harga');

        // Revenue by Field breakdown
        $fieldsBreakdown = Field::all()->map(function ($field) use ($bookings) {
            $fieldBookings = $bookings->where('field_id', $field->id);
            return [
                'nama_lapangan' => $field->nama_lapangan,
                'jenis_lapangan' => $field->jenis_lapangan,
                'total_booking' => $fieldBookings->count(),
                'total_pendapatan' => $fieldBookings->sum('total_harga'),
            ];
        });

        $data = [
            'title' => $title,
            'period' => $period,
            'bookings' => $bookings,
            'totalBooking' => $totalBooking,
            'totalPendapatan' => $totalPendapatan,
            'fieldsBreakdown' => $fieldsBreakdown,
            'dateGenerated' => Carbon::now()->translatedFormat('d F Y H:i'),
        ];

        // Generate PDF using dompdf
        $pdf = Pdf::loadView('admin.reports.pdf', $data);

        return $pdf->stream('Laporan_Reservasi_' . str_replace(' ', '_', $period) . '.pdf');
    }
}
