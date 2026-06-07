<?php

namespace Database\Seeders;

use App\Models\Table;
use Illuminate\Database\Seeder;

class TableSeeder extends Seeder
{
    public function run(): void
    {
        $tables = [
            ['name' => 'Meja 1 - Window', 'capacity' => 2],
            ['name' => 'Meja 2 - Corner', 'capacity' => 4],
            ['name' => 'Meja 3 - Center', 'capacity' => 6],
            ['name' => 'Meja 4 - VIP Room', 'capacity' => 8],
            ['name' => 'Meja 5 - Outdoor', 'capacity' => 4],
            ['name' => 'Meja 6 - Bar Area', 'capacity' => 2],
        ];

        foreach ($tables as $t) {
            Table::create($t);
        }
    }
}
