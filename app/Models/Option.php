<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Option extends Model
{
    use HasFactory;

    protected $fillable = ['name_ar', 'name_en', 'attribute_id', 'type', 'type', 'parent_id'];


    public function getNameAttribute()
    {

        return $this->{'name_' . App::getLocale()};
    }  // end of get name



    public function childs()
    {
        return $this->hasMany(self::class, 'parent_id');
    }
}
