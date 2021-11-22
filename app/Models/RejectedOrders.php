<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RejectedOrders extends Model
{
    use HasFactory;

    // fillable
    protected $fillable = [
        'order_id',
        'seller_id'
    ];

    // relations
    public function order()
    {
        return $this->belongsTo(CustomOrder::class, 'order_id');
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }
}
