<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $orders = [
            [
                'order_code' => 'ORD-PK-20261020-001',
                'user_id' => 2,
                'concert_id' => 1,
                'ticket_category_id' => 3,
                'quantity' => 2,
                'price_per_ticket' => 350000,
                'total_amount' => 700000,
                'payment_status' => 'Dibayar',
                'payment_date' => '2026-10-20 10:45:00',
                'notes' => 'Transfer via BCA Virtual Account terverifikasi.',
            ],
            [
                'order_code' => 'ORD-PK-20261021-002',
                'user_id' => 3,
                'concert_id' => 1,
                'ticket_category_id' => 2,
                'quantity' => 3,
                'price_per_ticket' => 185000,
                'total_amount' => 555000,
                'payment_status' => 'Dibayar',
                'payment_date' => '2026-10-21 15:10:00',
                'notes' => 'Transfer via Mandiri terverifikasi.',
            ],
            [
                'order_code' => 'ORD-PK-20261022-003',
                'user_id' => 4,
                'concert_id' => 3,
                'ticket_category_id' => 7,
                'quantity' => 2,
                'price_per_ticket' => 165000,
                'total_amount' => 330000,
                'payment_status' => 'Menunggu Pembayaran',
                'payment_date' => null,
                'notes' => 'Menunggu bukti bayar rekening penampung.',
            ],
            [
                'order_code' => 'ORD-PK-20261023-004',
                'user_id' => 5,
                'concert_id' => 2,
                'ticket_category_id' => 5,
                'quantity' => 1,
                'price_per_ticket' => 145000,
                'total_amount' => 145000,
                'payment_status' => 'Dibayar',
                'payment_date' => '2026-10-23 09:40:00',
                'notes' => 'Pencatatan pembayaran manual di teller bank.',
            ],
            [
                'order_code' => 'ORD-PK-20261024-005',
                'user_id' => 2,
                'concert_id' => 4,
                'ticket_category_id' => 10,
                'quantity' => 4,
                'price_per_ticket' => 150000,
                'total_amount' => 600000,
                'payment_status' => 'Menunggu Pembayaran',
                'payment_date' => null,
                'notes' => 'Order rombongan pelajar pensi.',
            ],
            [
                'order_code' => 'ORD-PK-20261025-006',
                'user_id' => 3,
                'concert_id' => 3,
                'ticket_category_id' => 8,
                'quantity' => 1,
                'price_per_ticket' => 320000,
                'total_amount' => 320000,
                'payment_status' => 'Dibatalkan',
                'payment_date' => null,
                'notes' => 'Batas waktu pembayaran telah kedaluwarsa.',
            ],
        ];

        foreach ($orders as $o) {
            Order::updateOrCreate(['order_code' => $o['order_code']], $o);
        }
    }
}
