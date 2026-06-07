<?php

namespace Database\Seeders;

use App\Models\Field;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::where('role', 'user')->get();
        $fields = Field::all();

        $reviews = [
            [
                'rating' => 5,
                'komentar' => 'Lapangan bersih sekali dan pencahayaan sangat memuaskan! Sangat direkomendasikan.',
            ],
            [
                'rating' => 5,
                'komentar' => 'Karpetnya empuk tidak licin, sangat nyaman digunakan untuk main rally panjang.',
            ],
            [
                'rating' => 5,
                'komentar' => 'Fasilitas lengkap, parkir luas, dan lapangannya sangat bagus dan terawat.',
            ],
            [
                'rating' => 5,
                'komentar' => 'Sangat merekomendasikan Lapangan VIP. Pelayanannya top dan AC-nya dingin.',
            ],
            [
                'rating' => 5,
                'komentar' => 'Bagus banget lapangannya! Bersih, rapi, dan adminnya ramah banget.',
            ],
            [
                'rating' => 5,
                'komentar' => 'Lantai vinyl di lapangan A luar biasa kesat, pergelangan kaki aman dari cedera.',
            ],
            [
                'rating' => 5,
                'komentar' => 'Main malam hari di sini seru banget, lampu sangat terang tidak ada bayangan mengganggu.',
            ],
            [
                'rating' => 4,
                'komentar' => 'Lapangannya bagus, hanya saja kamar mandinya agak kurang bersih pas saya pakai.',
            ],
            [
                'rating' => 4,
                'komentar' => 'Pencahayaan oke, karpet bagus, tapi ruang tunggu agak sempit.',
            ],
            [
                'rating' => 4,
                'komentar' => 'Sangat menyenangkan main di sini, proses booking online-nya gampang dan cepat.',
            ],
            [
                'rating' => 4,
                'komentar' => 'Tempatnya strategis di tengah kota, kondisi lapangan terawat dengan baik.',
            ],
            [
                'rating' => 4,
                'komentar' => 'Lapangannya standar internasional, mantap pokoknya, cuma harganya lumayan.',
            ],
            [
                'rating' => 4,
                'komentar' => 'Sirkulasi udara di dalam gedung cukup baik, tidak terlalu pengap walau ramai.',
            ],
            [
                'rating' => 4,
                'komentar' => 'Kantinnnya menjual shuttlecock berkualitas dan minuman dingin lengkap.',
            ],
            [
                'rating' => 3,
                'komentar' => 'Lapangan lumayan oke, tapi terasa agak panas kalau main di siang hari.',
            ],
            [
                'rating' => 3,
                'komentar' => 'Standar sih, tapi parkiran motor agak sempit pas jam ramai sore-sore.',
            ],
            [
                'rating' => 3,
                'komentar' => 'Lapangan VIP bagus tapi menurut saya harganya agak kemahalan.',
            ],
            [
                'rating' => 3,
                'komentar' => 'Karpet di Lapangan B ada sedikit yang terkelupas di pojokan, tapi masih aman dipakai.',
            ],
            [
                'rating' => 3,
                'komentar' => 'Biasa aja sih, seperti lapangan badminton sewaan pada umumnya.',
            ],
            [
                'rating' => 3,
                'komentar' => 'Proses verifikasi pembayaran agak lambat, tolong ditingkatkan respon adminnya.',
            ],
            [
                'rating' => 2,
                'komentar' => 'Lapangannya agak licin, tolong lantai pel secara berkala biar tidak membahayakan.',
            ],
            [
                'rating' => 2,
                'komentar' => 'Pelayanan admin kurang ramah, mukanya cemberut terus pas kami datang.',
            ],
            [
                'rating' => 2,
                'komentar' => 'Pencahayaan di Lapangan C agak silau, bikin mata sakit pas smash.',
            ],
            [
                'rating' => 2,
                'komentar' => 'Kamar mandi kotor sekali dan airnya kecil, susah bilas setelah main.',
            ],
            [
                'rating' => 2,
                'komentar' => 'Atapnya sepertinya bocor tipis-tipis pas hujan lebat kemarin, ada genangan sedikit.',
            ],
            [
                'rating' => 1,
                'komentar' => 'Sangat tidak nyaman! Karpetnya licin parah dan saya hampir terkilir.',
            ],
            [
                'rating' => 1,
                'komentar' => 'Jadwal tabrakan dan admin sangat lambat merespon. Sangat mengecewakan.',
            ],
            [
                'rating' => 1,
                'komentar' => 'Sangat buruk. Lapangannya berdebu sekali seperti tidak pernah dibersihkan.',
            ],
            [
                'rating' => 1,
                'komentar' => 'Gedung bau rokok padahal ada tanda dilarang merokok. Sangat mengganggu pernapasan.',
            ],
            [
                'rating' => 1,
                'komentar' => 'Uang hangus karena telat bayar 5 menit padahal bukti sudah dikirim. Pelayanan payah!',
            ],
        ];

        // Ensure we seed 30 reviews
        for ($i = 0; $i < 30; $i++) {
            $user = $users->random();
            $field = $fields->random();
            $reviewTemplate = $reviews[$i % count($reviews)];

            Review::create([
                'user_id' => $user->id,
                'field_id' => $field->id,
                'rating' => $reviewTemplate['rating'],
                'komentar' => $reviewTemplate['komentar'],
            ]);
        }
    }
}
