<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomOrder extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'seller_id',
        'order_status_id',
        'payment_url',
        'shipping_id',
        'payment_id',
        'user_id',
        'price'
    ];


    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function multiCustomOrder()
    {
        return $this->belongsTo(MultiCustomOrder::class, 'id', 'custom_order_id');
    }

    public function order_status()
    {
        return $this->belongsTo(OrderStatus::class, 'order_status_id', 'id');
    }

    public function shipping()
    {
        return $this->belongsTo(Shipping::class, 'shipping_id', 'id');
    }

    public function payment()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_id', 'id');
    }

    public function custom_order_items()
    {
        return $this->hasMany(CustomOrderItem::class, 'custom_order_id', 'id');
    }
}
