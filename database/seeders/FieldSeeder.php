<?php

namespace Database\Seeders;

use App\Models\Field;
use Illuminate\Database\Seeder;

class FieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fields = [
            [
                'nama_lapangan' => 'Lapangan A',
                'jenis_lapangan' => 'Vinyl',
                'harga_per_jam' => 50000,
                'deskripsi' => 'Lapangan badminton beralaskan Vinyl standar nasional. Nyaman digunakan untuk pemula maupun profesional.',
                'gambar' => null,
                'status' => 'tersedia',
            ],
            [
                'nama_lapangan' => 'Lapangan B',
                'jenis_lapangan' => 'Karpet',
                'harga_per_jam' => 60000,
                'deskripsi' => 'Lapangan beralaskan karpet sintetik berkualitas tinggi dengan daya cengkram optimal.',
                'gambar' => null,
                'status' => 'tersedia',
            ],
            [
                'nama_lapangan' => 'Lapangan C',
                'jenis_lapangan' => 'Sintetis',
                'harga_per_jam' => 70000,
                'deskripsi' => 'Lapangan sintetis modern dengan pencahayaan LED yang merata di semua sudut lapangan.',
                'gambar' => null,
                'status' => 'tersedia',
            ],
            [
                'nama_lapangan' => 'Lapangan VIP',
                'jenis_lapangan' => 'Karpet Premium',
                'harga_per_jam' => 100000,
                'deskripsi' => 'Lapangan VIP ber-AC, karpet premium standar internasional, lengkap dengan area duduk eksklusif.',
                'gambar' => null,
                'status' => 'tersedia',
            ],
        ];

        foreach ($fields as $fieldData) {
            Field::create($fieldData);
        }
    }
}
