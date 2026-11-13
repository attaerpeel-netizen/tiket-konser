<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations for MySQL.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_code', 50)->unique();
            $table->foreignId('user_id')->constrained('users')->onDelete('restrict');
            $table->foreignId('concert_id')->constrained('concerts')->onDelete('restrict');
            $table->foreignId('ticket_category_id')->constrained('ticket_categories')->onDelete('restrict');
            $table->unsignedInteger('quantity')->default(1);
            $table->decimal('price_per_ticket', 12, 2);
            $table->decimal('total_amount', 12, 2);
            $table->enum('payment_status', ['Menunggu Pembayaran', 'Dibayar', 'Dibatalkan'])->default('Menunggu Pembayaran');
            $table->dateTime('payment_date')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index(['payment_status', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
