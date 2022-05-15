<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WalletRequest extends Model
{
    use HasFactory;

    protected $table = 'wallet_requests';

    protected $fillable = ['amount', 'user_id', 'is_approved'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
