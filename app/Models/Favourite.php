<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
    use HasFactory;

    protected $fillable = [
        'favouriteable_type',
        'favouriteable_id',
        'user_id',
    ];
    public function users()
    {
        return $this->hasMany(User::class, 'id', 'favouriteable_id');
    }
    public function products()
    {
        return $this->hasMany(Product::class, 'id', 'favouriteable_id');
    }
}
