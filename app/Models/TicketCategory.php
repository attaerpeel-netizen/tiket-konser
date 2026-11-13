<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'concert_id',
        'name',
        'price',
        'initial_capacity',
        'sold_count',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'initial_capacity' => 'integer',
        'sold_count' => 'integer',
    ];

    public function concert()
    {
        return $this->belongsTo(Concert::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function getRemainingStockAttribute(): int
    {
        $remaining = $this->initial_capacity - $this->sold_count;
        return max(0, $remaining);
    }

    public function getPercentageSoldAttribute(): float
    {
        if ($this->initial_capacity <= 0) return 0.0;
        return round(($this->sold_count / $this->initial_capacity) * 100, 1);
    }
}
