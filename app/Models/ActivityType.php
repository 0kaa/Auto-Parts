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

    protected $fillable = ['name_ar', 'cover', 'name_en', 'num_pieces', 'image'];

    public function getNameAttribute()
    {

        return $this->{'name_' . App::getLocale()};
    }  // end of get name

    public function store()
    {
        return $this->hasMany(User::class)->role('owner_store');
    }

    public function sub_activity()
    {
        return $this->hasMany(SubActivity::class);
    }
}
