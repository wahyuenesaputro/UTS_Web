<?php

namespace App\Http\Controllers;

use App\Models\Table;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function index()
    {
        $tables = Table::all();
        $reservations = Reservation::where('user_id', Auth::id())
            ->with('table')
            ->orderByDesc('created_at')
            ->get();

        return view('user.reservasi', compact('tables', 'reservations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'table_id' => 'required|exists:tables,id',
            'date'     => 'required|date|after_or_equal:today',
            'time'     => 'required',
            'pax'      => 'required|integer|min:1',
        ]);

        Reservation::create([
            'user_id'  => Auth::id(),
            'table_id' => $request->table_id,
            'date'     => $request->date,
            'time'     => $request->time,
            'pax'      => $request->pax,
        ]);

        return redirect()->route('user.reservasi.index')
            ->with('success', 'Reservasi berhasil dikirim! Menunggu konfirmasi admin.');
    }
}
