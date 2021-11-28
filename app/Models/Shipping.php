<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Shipping extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'shipping_name_en',
        'shipping_name_ar',
    ];

    public function getShippingNameAttribute()
    {

        return $this->{'shipping_name_' . App::getLocale()};
    }
}
