<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionsPackage extends Model
{
    use HasFactory;
    // fillable
    protected $fillable = [
        'id',
        'user_id',
        'plan_id',
        'start_date',
        'end_date',
    ];

    // relations
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function plan()
    {
        return $this->belongsTo(Package::class);
    }
    
}