<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewLesson extends Model
{
    use HasFactory;

    // Thêm các trường vào thuộc tính fillable
    protected $table = 'reviews_lesson';
    protected $fillable = [
        'user_id',
        'lesson_id',
        'review',
        'rating',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}

