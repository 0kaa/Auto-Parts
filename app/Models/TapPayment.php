<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TapPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'charge_id',
        'amount',
        'status',
        'orderable_type',
        'orderable_id',
    ];

    // public function order()
    // {
    //     return $this->belongsTo(Order::class, 'order_id');
    // }


    public function orderable()
    {
        return $this->morphTo();
    }

    public function order()
    {
        return $this->hasOne(Order::class, 'id', 'orderable_id');
    }

    public function custom_order()
    {
        return $this->hasOne(CustomOrder::class, 'id', 'orderable_id');
    }
}
