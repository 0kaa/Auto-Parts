<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'order_status',
        'orderable_type',
        'orderable_id',
        'order_total',
        'order_date',
        'order_time',
        'order_note',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->select('id', 'name', 'image');
    }

    public function orderable()
    {
        return $this->morphTo();
    }
}
