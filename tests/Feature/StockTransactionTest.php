<?php

namespace Tests\Feature;

use App\Models\Concert;
use App\Models\Order;
use App\Models\TicketCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StockTransactionTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;
    protected $concert;
    protected $category;
    protected $customer;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::create([
            'name' => 'Atta Alfarizi',
            'email' => 'admin@punkticket.id',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'status' => 'Aktif',
        ]);

        $this->customer = User::create([
            'name' => 'Rian Pratama',
            'email' => 'rian@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'customer',
            'status' => 'Aktif',
        ]);

        $this->concert = Concert::create([
            'name' => 'Punk Rock Rebellion Indonesia',
            'date_time' => now()->addDays(20),
            'location' => 'Senayan Park Jakarta',
            'description' => 'Konser pop punk',
            'status' => 'Akan Datang',
        ]);

        $this->category = TicketCategory::create([
            'concert_id' => $this->concert->id,
            'name' => 'Regular',
            'price' => 150000,
            'initial_capacity' => 100,
            'sold_count' => 10,
        ]);
    }

    public function test_cancelling_order_releases_stock(): void
    {
        $order = Order::create([
            'order_code' => 'ORD-TEST-001',
            'user_id' => $this->customer->id,
            'concert_id' => $this->concert->id,
            'ticket_category_id' => $this->category->id,
            'quantity' => 5,
            'price_per_ticket' => 150000,
            'total_amount' => 750000,
            'payment_status' => 'Menunggu Pembayaran',
        ]);

        $response = $this->actingAs($this->admin)->patch("/orders/{$order->id}/status", [
            'payment_status' => 'Dibatalkan',
            'notes' => 'Pembatalan otomatis sistem',
        ]);

        $response->assertSessionHas('success');
        $this->category->refresh();
        $this->assertEquals(5, $this->category->sold_count);
    }

    public function test_capacity_cannot_be_reduced_below_sold_tickets(): void
    {
        $response = $this->actingAs($this->admin)->put("/tickets/{$this->category->id}", [
            'concert_id' => $this->concert->id,
            'name' => 'Regular',
            'price' => 150000,
            'initial_capacity' => 5, // smaller than sold_count (10)
        ]);

        $response->assertSessionHasErrors('initial_capacity');
        $this->category->refresh();
        $this->assertEquals(100, $this->category->initial_capacity);
    }
}
