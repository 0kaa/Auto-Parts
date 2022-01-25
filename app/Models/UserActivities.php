<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserActivities extends Model
{
    use HasFactory;

    // $fillable 
    protected $fillable = [
        'id',
        'activity_type_id'
    ];

    public function activity()
    {
        return $this->belongsTo(ActivityType::class, 'activity_type_id');
    }
}
