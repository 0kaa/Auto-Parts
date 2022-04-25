<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'company_sector_id',
    ];

    public function companySector()
    {
        return $this->belongsTo(CompanySector::class, 'company_sector_id');
    }
}
