<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role_id',
        'user_name',
        'email',
        'password',
        'full_name',
        'gender',
        'phone',
        'image',
        'address',
        'description',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_adduser', 'user_id', 'course_id');
    }
    public function coursesUser()
    {
        return $this->belongsToMany(Course::class, 'user_courses', 'user_id', 'course_id');
    }
    public function lesson()
    {
        return $this->belongsToMany(Lesson::class, 'lesson_useradd', 'user_id', 'lesson_id');
    }
}
