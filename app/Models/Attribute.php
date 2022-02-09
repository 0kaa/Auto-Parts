<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Attribute extends Model
{
    use HasFactory;

    protected $fillable = ['name_ar', 'name_en', 'sub_activity_id', 'type'];

    public function getNameAttribute()
    {

        return $this->{'name_' . App::getLocale()};
    }  // end of get name


    public function options()
    {
        return $this->hasMany(Option::class, 'attribute_id', 'id');
    }
}
