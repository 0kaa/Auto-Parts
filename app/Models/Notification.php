<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'message_ar',
        'message_en',
        'type',
        'model_id',
        'user_id',
        'read_at'
    ];

    protected $casts = [
        'read_at'   => 'datetime',
    ];

    public function getMessageAttribute()
    {

        return $this->{'message_' . App::getLocale()};
    }
}
