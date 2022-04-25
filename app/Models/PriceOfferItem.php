<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceOfferItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'price_offer_id',
        'custom_order_item_id',
        'quantity',
        'price',
    ];

    public function priceOffer()
    {
        return $this->belongsTo(PriceOffer::class);
    }

    public function customOrderItem()
    {
        return $this->belongsTo(CustomOrderItem::class);
    }
}
