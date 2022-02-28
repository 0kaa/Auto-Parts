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
        'payment_url',
        'payment_id',
        'order_number',
        'seller_id',
        'user_id',
        'shipping_id'
    ];

    // public function getOrderDeliveredAtAttribute($date){

    //     $dateFromat = Carbon::createFromFormat('Y-m-d H:i:s', $date);

    //     // Get the current app locale
    //     $locale = app()->getLocale();
    //     // Tell Carbon to use the current app locale
    //     Carbon::setlocale($locale);

    //     $format = $locale === 'ar' ? 'M' : 'M';
    //     // Use `translatedFormat()` to get a translated date string
    //     return $dateFromat->translatedFormat($format);        

    // }

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

    public function payment()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_id', 'id');
    }
}
