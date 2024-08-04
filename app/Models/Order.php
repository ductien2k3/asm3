<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_course_id',
        'payment_date',
        'amount',
    ];

    public function userCourse()
    {
        return $this->belongsTo(UserCourse::class);
    }
    public function userCourse2()
    {
        return $this->belongsTo(UserCourse::class, 'user_course_id');
    }
    public function course2()
    {
        return $this->userCourse2->course2();
    }
    public function user()
    {
        return $this->userCourse2->user();
    }
}
