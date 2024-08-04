<?php

namespace App\Repositories\Eloquent;

use App\Models\ClassModel;
use App\Repositories\Contracts\ClassRepository;
use Prettus\Repository\Eloquent\BaseRepository;
use App\Repositories\Traits\RepositoryTraits;

class ClassRepositoryEloquent extends BaseRepository implements ClassRepository
{
    use RepositoryTraits;
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ClassModel::class;
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
