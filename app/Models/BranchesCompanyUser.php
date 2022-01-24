<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchesCompanyUser extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'city_id', 'region_id', 'phone', 'address'];


    public function region()
    {
        return $this->hasOne(Region::class, 'id', 'region_id');
    }

    public function city()
    {
        return $this->hasOne(City::class, 'id', 'city_id');
    }


}
