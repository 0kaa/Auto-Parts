<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SliderService extends Model
{
    use HasFactory;

    protected $table='sliders_services';
    protected $fillable=array('image');
}
