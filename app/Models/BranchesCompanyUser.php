<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchesCompanyUser extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','city' , 'region_id' , 'phone' , 'address'];

}
