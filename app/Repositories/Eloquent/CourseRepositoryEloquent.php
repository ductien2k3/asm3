<?php

namespace App\Repositories\Eloquent;

use App\Models\Course;
use App\Repositories\Contracts\CourseRepository;
use Prettus\Repository\Eloquent\BaseRepository;
use App\Repositories\Traits\RepositoryTraits;

class CourseRepositoryEloquent extends BaseRepository implements CourseRepository
{
    use RepositoryTraits;
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Course::class;
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
}
