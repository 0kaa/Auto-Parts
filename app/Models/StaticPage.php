<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class StaticPage extends Model
{
    use HasFactory;

    protected $table='static_pages';

    protected $fillable = ['main_image','sub_image','main_image_home','sub_image_home','slug','title_ar','title_en','desc_ar','desc_en'];

    public function getTitleAttribute()
    {

        return $this->{'title_'.App::getLocale()};

    }  // end of get title

    public function getContentAttribute()
    {

        return $this->{'desc_'.App::getLocale()};

    }  // end of get content

}
