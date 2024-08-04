<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCourse extends Model
{
    use HasFactory;
    protected $table = 'user_courses';
    protected $fillable = ['user_id', 'course_id', 'status'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function course2()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
