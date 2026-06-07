<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Active bookings: status pending or disetujui
        $bookingAktif = Booking::where('user_id', $userId)
            ->whereIn('status', ['pending', 'disetujui'])
            ->count();

        // Total transaction value for approved or completed bookings
        $totalTransaksi = Booking::where('user_id', $userId)
            ->whereIn('status', ['disetujui', 'selesai'])
            ->sum('total_harga');

        // Last 5 bookings with field and payment details
        $riwayatBooking = Booking::with(['field', 'payment'])
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('user.dashboard', compact(
            'bookingAktif',
            'totalTransaksi',
            'riwayatBooking'
        ));
    }
}
