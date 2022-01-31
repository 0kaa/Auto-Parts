<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'order_status_id',
        'order_ship_name',
        'order_ship_phone',
        'order_ship_address',
        'order_delivered_at',
        'total_amount',
        'order_number',
        'seller_id',
        'user_id',
        'shipping_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->select('id', 'name', 'image');
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id', 'id');
    }

    public function order_items()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }

    public function shipping()
    {
        return $this->belongsTo(Shipping::class, 'shipping_id', 'id');
    }

    public function order_status()
    {
        return $this->belongsTo(OrderStatus::class, 'order_status_id', 'id');
    }
    
}
