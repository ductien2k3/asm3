<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'class_models';

    protected $fillable = [
        'course_id',
        'title',
        'schedule',
        'location',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
