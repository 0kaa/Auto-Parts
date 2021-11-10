<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App;

class City extends Model
{
    use HasFactory;

    protected $table = 'cities';

    protected $fillable = ['id', 'name_ar', 'name_en'];

    public function getNameAttribute()
    {

        return $this->{'name_' . App::getLocale()};
    }  // end of get name 
}
