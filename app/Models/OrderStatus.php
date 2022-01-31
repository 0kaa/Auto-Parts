<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class OrderStatus extends Model
{
    use HasFactory;    

    protected $fillable = ['name_ar', 'name_en', 'id'];

    protected $hidden = ['created_at', 'updated_at'];

    public function getNameAttribute()
    {

        return $this->{'name_' . App::getLocale()};
    }
}
