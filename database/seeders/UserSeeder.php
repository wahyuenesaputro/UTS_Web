<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin
        User::create([
            'name' => 'Admin Utama',
            'email' => 'admin@gmail.com',
            'phone' => '081234567890',
            'address' => 'Jl. Badminton No. 1, Jakarta',
            'avatar' => null,
            'role' => 'admin',
            'password' => Hash::make('password'),
        ]);

        // Create 10 Users
        $users = [
            ['name' => 'Budi Santoso', 'email' => 'budi@gmail.com', 'phone' => '081298765432', 'address' => 'Jl. Sudirman No. 10, Jakarta'],
            ['name' => 'Andi Wijaya', 'email' => 'andi@gmail.com', 'phone' => '081387654321', 'address' => 'Jl. Gatot Subroto No. 22, Bandung'],
            ['name' => 'Dimas Pratama', 'email' => 'dimas@gmail.com', 'phone' => '081476543210', 'address' => 'Jl. Diponegoro No. 45, Surabaya'],
            ['name' => 'Rizky Saputra', 'email' => 'rizky@gmail.com', 'phone' => '081565432109', 'address' => 'Jl. Asia Afrika No. 12, Bandung'],
            ['name' => 'Agus Setiawan', 'email' => 'agus@gmail.com', 'phone' => '081654321098', 'address' => 'Jl. Malioboro No. 89, Yogyakarta'],
            ['name' => 'Fajar Hidayat', 'email' => 'fajar@gmail.com', 'phone' => '081743210987', 'address' => 'Jl. Slamet Riyadi No. 56, Solo'],
            ['name' => 'Arif Nugroho', 'email' => 'arif@gmail.com', 'phone' => '081832109876', 'address' => 'Jl. Pemuda No. 78, Semarang'],
            ['name' => 'Dedi Kurniawan', 'email' => 'dedi@gmail.com', 'phone' => '081921098765', 'address' => 'Jl. Gajah Mada No. 34, Medan'],
            ['name' => 'Wahyu Prasetyo', 'email' => 'wahyu@gmail.com', 'phone' => '081230987654', 'address' => 'Jl. Pahlawan No. 15, Surabaya'],
            ['name' => 'Rian Saputra', 'email' => 'rian@gmail.com', 'phone' => '081340876543', 'address' => 'Jl. Imam Bonjol No. 67, Makassar'],
        ];

        foreach ($users as $userData) {
            User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'phone' => $userData['phone'],
                'address' => $userData['address'],
                'avatar' => null,
                'role' => 'user',
                'password' => Hash::make('password'),
            ]);
        }
    }
}
