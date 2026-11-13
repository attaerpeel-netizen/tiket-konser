<?php

namespace Database\Seeders;

use App\Models\Concert;
use Illuminate\Database\Seeder;

class ConcertSeeder extends Seeder
{
    public function run(): void
    {
        $concerts = [
            [
                'id' => 1,
                'name' => 'Punk Rock Rebellion Indonesia',
                'poster_url' => 'posters/concert1.jpg',
                'lineup' => ['Pee Wee Gaskins', 'Rocket Rockers', 'Closehead'],
                'date_time' => '2026-11-15 18:30:00',
                'location' => 'Senayan Park Outdoor Arena, Jakarta Pusat',
                'description' => 'Panggung akbar perayaan distorsi pop punk tanah air! Mengumpulkan raksasa melodic punk lintas generasi dalam satu panggung megah di jantung ibukota.',
                'status' => 'Akan Datang',
            ],
            [
                'id' => 2,
                'name' => 'Pop Punk Never Die',
                'poster_url' => 'posters/concert2.jpg',
                'lineup' => ['Stand Here Alone', 'Pee Wee Gaskins', 'For Revenge'],
                'date_time' => '2026-11-28 16:00:00',
                'location' => 'Lapangan Karangpawitan, Karawang',
                'description' => 'Festival pop punk penuh gairah reuni anak muda dengan semangat pantang padam dan nyanyian serak khas pop punk 2000-an.',
                'status' => 'Akan Datang',
            ],
            [
                'id' => 3,
                'name' => 'Pesta Pop Punk Nusantara',
                'poster_url' => 'posters/concert3.jpg',
                'lineup' => ['Closehead', 'Rocket Rockers', 'Rosemary'],
                'date_time' => '2026-12-05 17:00:00',
                'location' => 'Monumen Perjuangan Rakyat Jawa Barat, Bandung',
                'description' => 'Kota Kembang membara! Menghadirkan trio legendaris melodic punk Bandung yang melahirkan lagu-lagu hymne masa SMA.',
                'status' => 'Akan Datang',
            ],
            [
                'id' => 4,
                'name' => 'Back to School Pop Punk Fest',
                'poster_url' => 'posters/concert4.jpg',
                'lineup' => ['Endank Soekamti', 'Superman Is Dead', 'Stand Here Alone'],
                'date_time' => '2026-12-19 15:30:00',
                'location' => 'GOR Kertajaya Indoor Stadium, Surabaya',
                'description' => 'Nostalgia panggung pensi SMA terliar se-Jawa Timur! Format panggung 360 derajat dengan energy moshing tak tertandingi.',
                'status' => 'Akan Datang',
            ],
            [
                'id' => 5,
                'name' => 'Underground Sound Festival',
                'poster_url' => 'posters/concert5.jpg',
                'lineup' => ['Superman Is Dead', 'Endank Soekamti', 'Captain Jack'],
                'date_time' => '2026-10-15 19:00:00',
                'location' => 'Stadion Mandala Krida, Yogyakarta',
                'description' => 'Edisi spesial underground rock and roll Yogyakarta yang mengguncang panggung dengan 15.000 penonton dari seantero pulau Jawa.',
                'status' => 'Selesai',
            ],
        ];

        foreach ($concerts as $c) {
            Concert::updateOrCreate(['id' => $c['id']], $c);
        }
    }
}
