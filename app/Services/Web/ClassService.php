<?php

namespace App\Services\Web;

use App\Repositories\Contracts\ClassRepository;

use App\Services\Contracts\ClassServiceInterface;
use App\Traits\FileTrait;
use Illuminate\Support\Facades\Storage;

class ClassService implements ClassServiceInterface
{
    use FileTrait {
        delete as deleteFile;
    }

    protected $classRepository;

    public function __construct(ClassRepository $classRepository)
    {
        $this->classRepository = $classRepository;
    }

    public function getAllClass()
    {
        $orderBy['updated_at'] = 'desc';
        $filter = [];
        $classes = $this->classRepository->paginateByFilters(
            $filter,
            PAGINATE_MAX_RECORD,
            ['course'],
            $orderBy
        )->withQueryString();
        return $classes;
    }
    public function create($data)
    {

    }
    public function store($data)
    {
        $params = [
            'course_id' => $data->course_id,
            'title' => $data->title,
            'schedule' => $data->schedule,
            'location' => $data->location,
        ];
        $class = $this->classRepository->create($params);
        return $class;
    }
    public function edit($id)
    {
        return $this->classRepository->find($id);
    }
    public function update($data, $id)
    {
        $this->classRepository->find($id);
        $params = [];
        $params = [
            'course_id' => $data->course_id,
            'title' => $data->title,
            'schedule' => $data->schedule,
            'location' => $data->location,
        ];

        return $this->classRepository->update($params, $id);
    }
}