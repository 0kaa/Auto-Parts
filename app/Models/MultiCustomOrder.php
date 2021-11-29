<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MultiCustomOrder extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id',
        'seller_id',
        'custom_order_id',
    ];

    public function customOrder()
    {
        return $this->belongsTo(CustomOrder::class);
    }
    
}
