<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    protected $fillable = [
    'question', 'answer',       // Indo (Default)
    'question_en', 'answer_en', // Inggris
    'question_zh', 'answer_zh', // China (Baru)
    'is_active'
    ];
}