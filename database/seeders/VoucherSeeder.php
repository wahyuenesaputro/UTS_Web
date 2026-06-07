<?php

namespace Database\Seeders;

use App\Models\Voucher;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class VoucherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vouchers = [
            [
                'kode_voucher' => 'DISKON10',
                'diskon' => 10000,
                'tanggal_mulai' => Carbon::now()->subDays(5),
                'tanggal_berakhir' => Carbon::now()->addDays(30),
                'status' => 'aktif',
            ],
            [
                'kode_voucher' => 'BADMINTON20',
                'diskon' => 20000,
                'tanggal_mulai' => Carbon::now()->subDays(2),
                'tanggal_berakhir' => Carbon::now()->addDays(15),
                'status' => 'aktif',
            ],
            [
                'kode_voucher' => 'VIPMEMBER',
                'diskon' => 30000,
                'tanggal_mulai' => Carbon::now()->subDays(10),
                'tanggal_berakhir' => Carbon::now()->addDays(60),
                'status' => 'aktif',
            ],
            [
                'kode_voucher' => 'EXPIRED50',
                'diskon' => 50000,
                'tanggal_mulai' => Carbon::now()->subDays(30),
                'tanggal_berakhir' => Carbon::now()->subDays(5),
                'status' => 'tidak_aktif',
            ],
        ];

        foreach ($vouchers as $voucher) {
            Voucher::create($voucher);
        }
    }
}
