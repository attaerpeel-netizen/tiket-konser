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
        Schema::create('ticket_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('concert_id')->constrained('concerts')->onDelete('cascade');
            $table->string('name'); // Presale, Regular, VIP
            $table->decimal('price', 12, 2)->default(0.00);
            $table->unsignedInteger('initial_capacity')->default(0);
            $table->unsignedInteger('sold_count')->default(0);
            $table->timestamps();

            $table->index('concert_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ticket_categories');
    }
};
