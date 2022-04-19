<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomOrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'piece_name',
        'piece_image',
        'piece_price',
        'piece_description',
        'form_image',
        'note',
        'quantity',
        'car_id',
        'custom_order_id',
        'activity_type_id',
        'sub_activity_id',
        'sub_sub_activity_id',
      
    ];

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
    public function attributes()
    {
        return $this->hasMany(CustomOrderAttribute::class);
    }
}
