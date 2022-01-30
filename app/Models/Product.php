<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Rating;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id',
        'name',
        'price',
        'image',
        'description',
        'features',
        'details',
        'seller_id',
    ];

    protected $casts = [
        'features'  => 'array',
        'details'   => 'array',
    ];

    public static $rules = [
        'name'      => 'required',
        'price'     => 'required',
        'details'   => 'required',
        'features'  => 'required',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [];

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id', 'id')->role('owner_store');;
    }

    public function ratings()
    {
        return $this->morphMany(Rating::class, 'rateable');
    }

    public function favourite()
    {
        return $this->morphMany(Favourite::class, 'favouriteable');
    }
    
}
