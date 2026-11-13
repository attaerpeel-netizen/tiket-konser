<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@punkticket.id'],
            [
                'name' => 'Atta Alfarizi',
                'password' => Hash::make('punkrock2026'),
                'phone' => '0812-3456-7890',
                'role' => 'admin',
                'status' => 'Aktif',
            ]
        );

        User::updateOrCreate(
            ['email' => 'attaerpeel@gmail.com'],
            [
                'name' => 'Atta Alfarizi (Owner)',
                'password' => Hash::make('punkrock2026'),
                'phone' => '0812-3456-7890',
                'role' => 'admin',
                'status' => 'Aktif',
            ]
        );
    }
}
