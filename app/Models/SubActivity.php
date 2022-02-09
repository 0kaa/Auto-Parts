<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Cviebrock\EloquentSluggable\Sluggable;


class SubActivity extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = ['name_ar', 'type', 'parent_id', 'name_en', 'slug'];

    public function getNameAttribute()
    {

        return $this->{'name_' . App::getLocale()};
    }  // end of get name

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name_en'
            ]
        ];
    }

    public function subActivities()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

    public function attributes()
    {
        return $this->hasMany(Attribute::class, 'sub_activity_id', 'id');
    }
}
