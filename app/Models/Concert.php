<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Concert extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'poster_url',
        'lineup',
        'date_time',
        'location',
        'description',
        'status',
    ];

    protected $casts = [
        'lineup' => 'array',
        'date_time' => 'datetime',
    ];

    public function ticketCategories()
    {
        return $this->hasMany(TicketCategory::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function getTotalAvailableStockAttribute(): int
    {
        return $this->ticketCategories->sum(function ($cat) {
            return $cat->remaining_stock;
        });
    }

    public function getTotalSoldTicketsAttribute(): int
    {
        return $this->ticketCategories->sum('sold_count');
    }
}
