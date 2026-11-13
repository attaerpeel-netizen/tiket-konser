<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $customers = [
            ['name' => 'Budi Santoso', 'email' => 'budi.santoso@gmail.com', 'phone' => '0813-9876-5432'],
            ['name' => 'Rian Pratama', 'email' => 'rian.pratama@yahoo.com', 'phone' => '0857-1234-5678'],
            ['name' => 'Dimas Aditya', 'email' => 'dimas.adit@outlook.com', 'phone' => '0878-8765-4321'],
            ['name' => 'Nadia Salsabila', 'email' => 'nadia.salsa@gmail.com', 'phone' => '0821-3344-5566'],
            ['name' => 'Fajar Nugraha', 'email' => 'fajar.nugraha@gmail.com', 'phone' => '0896-5544-3322'],
        ];

        foreach ($customers as $c) {
            User::updateOrCreate(
                ['email' => $c['email']],
                [
                    'name' => $c['name'],
                    'password' => Hash::make('password123'),
                    'phone' => $c['phone'],
                    'role' => 'customer',
                    'status' => 'Aktif',
                ]
            );
        }
    }
}
