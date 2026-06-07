<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bookings = Booking::all();
        $methods = ['Transfer Bank', 'QRIS', 'E-Wallet'];

        foreach ($bookings as $booking) {
            $metode = $methods[array_rand($methods)];
            
            // Determine payment status based on booking status
            if ($booking->status === 'selesai' || $booking->status === 'disetujui') {
                $status = 'berhasil';
            } elseif ($booking->status === 'dibatalkan') {
                $status = rand(1, 2) === 1 ? 'ditolak' : 'pending';
            } else {
                $status = 'pending';
            }

            Payment::create([
                'booking_id' => $booking->id,
                'metode_pembayaran' => $metode,
                'bukti_pembayaran' => 'bukti_pembayaran/dummy_proof.png',
                'status' => $status,
            ]);
        }
    }
}
