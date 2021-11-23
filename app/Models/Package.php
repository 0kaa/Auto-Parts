<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Package extends Model
{
    use HasFactory;

    // fillable
    protected $fillable = [
        'name_ar',
        'name_en',
        'description_en',
        'description_ar',
        'price',
        'discount_price',
        'duration_ar',
        'duration_en',
        'keyword_ar',
        'keyword_en',
        'badge',
        'features'
    ];

    protected $casts = [
        'features' => 'array'
    ];


    public function getNameAttribute()
    {

        return $this->{'name_' . App::getLocale()};
    }

    public function getDescriptionAttribute()
    {

        return $this->{'description_' . App::getLocale()};
    }
    public function getKeywordAttribute()
    {

        return $this->{'keyword_' . App::getLocale()};
    }
    public function getDurationAttribute()
    {

        return $this->{'duration_' . App::getLocale()};
    }
}
