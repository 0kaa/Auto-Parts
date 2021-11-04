<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faqs extends Model
{
    use HasFactory;
    protected $fillable = [
        'question_en',
        'question_ar',
        'answer_en',
        'answer_ar',
    ];
}
