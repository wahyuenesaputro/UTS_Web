<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Field;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        $totalUser = User::where('role', 'user')->count();
        $totalField = Field::count();
        $totalBooking = Booking::count();
        $bookingHariIni = Booking::whereDate('tanggal', $today)->count();
        
        // Sum total_harga for disetujui or selesai bookings
        $pendapatanHariIni = Booking::whereDate('tanggal', $today)
            ->whereIn('status', ['disetujui', 'selesai'])
            ->sum('total_harga');

        $pendapatanBulanIni = Booking::whereMonth('tanggal', Carbon::now()->month)
            ->whereYear('tanggal', Carbon::now()->year)
            ->whereIn('status', ['disetujui', 'selesai'])
            ->sum('total_harga');

        // Prepare monthly chart data for the last 6 months
        $chartData = Booking::select(
                DB::raw('DATE_FORMAT(tanggal, "%Y-%m") as month'),
                DB::raw('SUM(total_harga) as revenue'),
                DB::raw('COUNT(*) as total_bookings')
            )
            ->whereIn('status', ['disetujui', 'selesai'])
            ->where('tanggal', '>=', Carbon::now()->subMonths(5)->startOfMonth())
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get();

        $months = [];
        $revenues = [];
        $bookingsCount = [];

        // Fill in missing months to avoid gaps in chart
        for ($i = 5; $i >= 0; $i--) {
            $monthStr = Carbon::now()->subMonths($i)->format('Y-m');
            $monthLabel = Carbon::now()->subMonths($i)->translatedFormat('F Y');
            $months[] = $monthLabel;
            
            $found = $chartData->firstWhere('month', $monthStr);
            $revenues[] = $found ? (float) $found->revenue : 0;
            $bookingsCount[] = $found ? (int) $found->total_bookings : 0;
        }

        return view('admin.dashboard', compact(
            'totalUser',
            'totalField',
            'totalBooking',
            'bookingHariIni',
            'pendapatanHariIni',
            'pendapatanBulanIni',
            'months',
            'revenues',
            'bookingsCount'
        ));
    }
}
