<?php

namespace App\Services\Web;

use App\Repositories\Contracts\CategoryRepository;
use App\Services\Contracts\CategoryServiceInterface;
use App\Traits\FileTrait;

class CategoryService implements CategoryServiceInterface
{
    use FileTrait {
        delete as deleteFile;
    }

    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAllCategory()
    {
        $orderBy['updated_at'] = 'desc';
        $filter = [];
        $categories = $this->categoryRepository->paginateByFilters(
            $filter,
            PAGINATE_MAX_RECORD,
            [],
            $orderBy
        )->withQueryString();

        return $categories;
    }
    public function create($data)
    {
    }
    public function store($data)
    {
        $params = [
            'name' => $data->name,
            'description' => $data->description,
        ];
        $category = $this->categoryRepository->create($params);

        return $category;
    }
    public function edit($id)
    {
        return $this->categoryRepository->find($id);
    }
    public function update($data, $id)
    {
        $category = $this->categoryRepository->find($id);
        $params = [];
        $params = [
            'name' => $data->name,
            'description' => $data->description,
        ];

        $category = $this->categoryRepository->update($params, $id);

        return $category;
    }
    public function getDetailCategory($id)
    {
        return $this->categoryRepository->find($id);
    }

}
