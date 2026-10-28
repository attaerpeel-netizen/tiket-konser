<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_code',
        'user_id',
        'concert_id',
        'ticket_category_id',
        'quantity',
        'price_per_ticket',
        'total_amount',
        'payment_status',
        'payment_date',
        'notes',
    ];

    protected $casts = [
        'price_per_ticket' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'payment_date' => 'datetime',
        'quantity' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function concert()
    {
        return $this->belongsTo(Concert::class);
    }

    public function ticketCategory()
    {
        return $this->belongsTo(TicketCategory::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
