<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App;
class Region extends Model
{
    use HasFactory;

    protected $table='regions';

    protected $fillable = ['name_ar','name_en'];

    public function getNameAttribute()
    {

        return $this->{'name_'.App::getLocale()};

    }  // end of get name 

}
