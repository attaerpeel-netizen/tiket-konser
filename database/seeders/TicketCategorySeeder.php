<?php

namespace Database\Seeders;

use App\Models\TicketCategory;
use Illuminate\Database\Seeder;

class TicketCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            // Concert 1: Punk Rock Rebellion
            ['id' => 1, 'concert_id' => 1, 'name' => 'Presale 1 (Early Bird)', 'price' => 125000, 'initial_capacity' => 500, 'sold_count' => 500],
            ['id' => 2, 'concert_id' => 1, 'name' => 'Regular Tribune & Festival', 'price' => 185000, 'initial_capacity' => 1500, 'sold_count' => 890],
            ['id' => 3, 'concert_id' => 1, 'name' => 'VIP Front Stage + Exclusive T-Shirt', 'price' => 350000, 'initial_capacity' => 300, 'sold_count' => 215],

            // Concert 2: Pop Punk Never Die
            ['id' => 4, 'concert_id' => 2, 'name' => 'Presale Festival', 'price' => 95000, 'initial_capacity' => 400, 'sold_count' => 400],
            ['id' => 5, 'concert_id' => 2, 'name' => 'Regular Moshpit Area', 'price' => 145000, 'initial_capacity' => 1000, 'sold_count' => 430],

            // Concert 3: Pesta Pop Punk Nusantara
            ['id' => 6, 'concert_id' => 3, 'name' => 'Presale Baraya Bandung', 'price' => 110000, 'initial_capacity' => 600, 'sold_count' => 600],
            ['id' => 7, 'concert_id' => 3, 'name' => 'Regular Festival', 'price' => 165000, 'initial_capacity' => 1200, 'sold_count' => 510],
            ['id' => 8, 'concert_id' => 3, 'name' => 'VIP Soundcheck Experience', 'price' => 320000, 'initial_capacity' => 150, 'sold_count' => 140],

            // Concert 4: Back to School
            ['id' => 9, 'concert_id' => 4, 'name' => 'Pelajar & Mahasiswa (Presale)', 'price' => 85000, 'initial_capacity' => 800, 'sold_count' => 620],
            ['id' => 10, 'concert_id' => 4, 'name' => 'Regular Gate', 'price' => 150000, 'initial_capacity' => 1500, 'sold_count' => 410],

            // Concert 5: Underground Sound (Selesai)
            ['id' => 11, 'concert_id' => 5, 'name' => 'General Admission', 'price' => 120000, 'initial_capacity' => 2500, 'sold_count' => 2500],
        ];

        foreach ($categories as $cat) {
            TicketCategory::updateOrCreate(['id' => $cat['id']], $cat);
        }
    }
}
