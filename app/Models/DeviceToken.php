<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceToken extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'firebase_token',
        'device_id',
        'platform_type',
        'is_loggedin',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
