<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Field;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::where('role', 'user')->get();
        $fields = Field::all();
        
        $statuses = ['pending', 'disetujui', 'selesai', 'dibatalkan'];
        
        // Let's create 50 bookings
        for ($i = 1; $i <= 50; $i++) {
            $user = $users->random();
            $field = $fields->random();
            
            // Random date between 30 days ago and 7 days in the future
            $date = Carbon::now()->addDays(rand(-30, 7));
            
            // Random start hour between 08:00 and 21:00
            $startHour = rand(8, 21);
            $durations = [1, 2, 3];
            $duration = $durations[array_rand($durations)];
            
            $startTime = Carbon::createFromTime($startHour, 0, 0);
            $endTime = (clone $startTime)->addHours($duration);
            
            $jamMulai = $startTime->format('H:i:s');
            $jamSelesai = $endTime->format('H:i:s');
            
            $totalHarga = $field->harga_per_jam * $duration;
            
            // Make sure booking status matches date logically
            // If date is in the past, status is more likely 'selesai' or 'dibatalkan'
            if ($date->isPast()) {
                $status = rand(1, 10) <= 8 ? 'selesai' : 'dibatalkan';
            } else {
                $status = $statuses[array_rand(['pending', 'disetujui', 'dibatalkan'])]; // No 'selesai' for future
            }
            
            Booking::create([
                'kode_booking' => 'BK-' . strtoupper(Str::random(8)),
                'user_id' => $user->id,
                'field_id' => $field->id,
                'tanggal' => $date->format('Y-m-d'),
                'jam_mulai' => $jamMulai,
                'durasi' => $duration,
                'jam_selesai' => $jamSelesai,
                'total_harga' => $totalHarga,
                'status' => $status,
            ]);
        }
    }
}
