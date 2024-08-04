<?php

namespace App\Repositories\Eloquent;

use App\Models\Lesson;
use App\Repositories\Contracts\LessonRepository;
use Prettus\Repository\Eloquent\BaseRepository;
use App\Repositories\Traits\RepositoryTraits;

class LessonRepositoryEloquent extends BaseRepository implements LessonRepository
{
    use RepositoryTraits;
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Lesson::class;
    }
    /**
     * Implement the abstract method `buildQuery` from `BaseRepository`.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function buildQuery($model, $filters)
    {
        return $model;
    }
    public function getLessonsByCourseId($courseId)
    {
        return $this->model->where('course_id', $courseId)->get();
    }
    public function getLessonByCourseIdAndLessonId($courseId, $lessonId)
    {
        return $this->model->where('course_id', $courseId)->where('id', $lessonId)->first();
    }
}
