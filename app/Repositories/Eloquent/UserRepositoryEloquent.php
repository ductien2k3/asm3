<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Contracts\UserRepository;
use Prettus\Repository\Eloquent\BaseRepository;
use App\Repositories\Traits\RepositoryTraits;

class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    use RepositoryTraits;
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
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
