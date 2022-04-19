<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceOffer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */

    protected $fillable = [
        'custom_order_item_id',
        'seller_id',
        'price',
        'status_id',
        'note',
        'created_at',
        'updated_at',
    ];

    public function customOrderItem()
    {
        return $this->belongsTo(CustomOrderItem::class);
    }

    public function seller()
    {
        return $this->belongsTo(User::class);
    }

    public function order_status()
    {
        return $this->belongsTo(OrderStatus::class, 'status_id', 'id');
    }
}
