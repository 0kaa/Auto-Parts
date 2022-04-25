<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App;

class CompanySector extends Model
{
    use HasFactory;

    protected $table = 'company_sector';

    protected $fillable = ['name_ar', 'name_en', 'image'];

    public function getNameAttribute()
    {

        return $this->{'name_' . App::getLocale()};
    }  // end of get name     

    public function models()
    {
        return $this->hasMany(CompanyModel::class, 'company_sector_id');
    }
}
