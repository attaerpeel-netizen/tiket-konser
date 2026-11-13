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
        Schema::create('concerts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('poster_url')->nullable();
            $table->json('lineup')->nullable();
            $table->dateTime('date_time');
            $table->string('location');
            $table->text('description')->nullable();
            $table->enum('status', ['Draft', 'Akan Datang', 'Berlangsung', 'Selesai'])->default('Draft');
            $table->timestamps();

            $table->index('status');
            $table->index('date_time');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('concerts');
    }
};
