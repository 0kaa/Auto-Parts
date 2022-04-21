<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;
    // $fillable 
    protected $fillable = [
        'id',
        'balance',
        'currency',
        'user_id'
    ];
}
