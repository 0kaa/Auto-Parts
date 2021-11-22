<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Faqs extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'question_en',
        'question_ar',
        'answer_en',
        'answer_ar',
    ];
    public function getQuestionAttribute()
    {

        return $this->{'question_' . App::getLocale()};
    }
    public function getAnswerAttribute()
    {

        return $this->{'answer_' . App::getLocale()};
    }
}
