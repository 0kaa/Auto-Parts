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
        'user_id',
        'activity_type_id',
        'sup_activity_id',
        'order_data'
    ];

    protected $casts = [
        'order_data' => 'array',

    ];
}
