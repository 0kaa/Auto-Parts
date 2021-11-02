<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App;
use App\Models\User;

class ActivityType extends Model
{
    use HasFactory;

    protected $table = 'activities_type';

    protected $fillable = ['name_ar', 'name_en', 'num_pieces', 'image'];

    public function getNameAttribute()
    {

        return $this->{'name_' . App::getLocale()};
    }  // end of get name

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
