<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomOrderAttribute extends Model
{
    use HasFactory;

    protected $fillable = ['attribute_id', 'option_id', 'custom_order_item_id', 'type', 'value'];


    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }

    public function option()
    {
        return $this->belongsTo(Option::class);
    }

    public function customOrderItem()
    {
        return $this->belongsTo(CustomOrderItem::class);
    }
}
