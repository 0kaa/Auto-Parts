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
        'car_id',
        'order_status',
        'user_id',
        'activity_type_id',
        'sup_activity_id',
        'order_data'
    ];

    protected $casts = [
        'order_data' => 'array',

    ];

    public function seller()
    {
        return $this->belongsTo(User::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function activityType()
    {
        return $this->belongsTo(ActivityType::class);
    }

    public function supActivity()
    {
        return $this->belongsTo(SupActivity::class);
    }

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    
}
