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
        'piece_name',
        'piece_image',
        'piece_price',
        'piece_description',
        'form_image',
        'car_id',
        'order_status_id',
        'payment_url',
        'shipping_id',
        'payment_id',
        'user_id',
        'activity_type_id',
        'sub_activity_id',
        'sub_sub_activity_id',
        'note',
        'quantity',
    ];


    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function activityType()
    {
        return $this->belongsTo(ActivityType::class);
    }

    public function subActivity()
    {
        return $this->belongsTo(SubActivity::class);
    }

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function multiCustomOrder()
    {
        return $this->belongsTo(MultiCustomOrder::class, 'id', 'custom_order_id');
    }

    public function attributes()
    {
        return $this->hasMany(CustomOrderAttribute::class);
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
}
