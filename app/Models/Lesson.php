<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lesson extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'lessons';

    protected $fillable = [
        'course_id',
        'title',
        'content',
        'video_url',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'lesson_useradd', 'lesson_id', 'user_id');
    }
    public function reviewLesson()
    {
        return $this->belongsTo(ReviewLesson::class);
    }
}

