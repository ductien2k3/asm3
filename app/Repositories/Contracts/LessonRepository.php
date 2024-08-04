<?php

namespace App\Repositories\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

interface LessonRepository extends RepositoryInterface
{
    public function getLessonsByCourseId($courseId);
}