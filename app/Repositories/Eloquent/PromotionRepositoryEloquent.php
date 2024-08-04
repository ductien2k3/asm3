<?php

namespace App\Repositories\Eloquent;

use App\Models\Promotion;
use App\Repositories\Contracts\PromotionRepository;
use Prettus\Repository\Eloquent\BaseRepository;
use App\Repositories\Traits\RepositoryTraits;

class PromotionRepositoryEloquent extends BaseRepository implements PromotionRepository
{
    use RepositoryTraits;
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Promotion::class;
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
