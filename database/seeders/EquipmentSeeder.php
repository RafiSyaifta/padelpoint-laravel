<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Equipment;

class EquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Equipment::create([
            'name' => 'Sewa Raket Paddle',
            'price' => 25000,
            'description' => 'Raket paddle standar berkualitas',
            'type' => 'rental',
        ]);

        Equipment::create([
            'name' => 'Beli Bola (Isi 3)',
            'price' => 15000,
            'description' => 'Satu tabung isi 3 bola padel',
            'type' => 'purchase',
        ]);

        Equipment::create([
            'name' => 'Air Mineral (600ml)',
            'price' => 5000,
            'description' => 'Air mineral dingin',
            'type' => 'purchase',
        ]);
    }
}
