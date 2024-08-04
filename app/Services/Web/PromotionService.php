<?php

namespace App\Services\Web;

use App\Repositories\Contracts\PromotionRepository;
use App\Services\Contracts\PromotionServiceInterface;
use App\Traits\FileTrait;

class PromotionService implements PromotionServiceInterface
{
    use FileTrait {
        delete as deleteFile;
    }

    protected $promotionRepository;

    public function __construct(PromotionRepository $promotionRepository)
    {
        $this->promotionRepository = $promotionRepository;
    }

    public function getAll()
    {
        $orderBy['updated_at'] = 'desc';
        $filter = [];
        $promotions = $this->promotionRepository->paginateByFilters(
            $filter,
            PAGINATE_MAX_RECORD,
            [],
            $orderBy
        )->withQueryString();

        return $promotions;
    }
    public function create($data)
    {
    }
    public function store($data)
    {
        $params = [
            'code' => $data->code,
            'description' => $data->description,
            'discount_percentage' => $data->discount_percentage,
            'start_date' => $data->start_date,
            'end_date' => $data->end_date
        ];
        $promotion = $this->promotionRepository->create($params);

        return $promotion;
    }
    public function edit($id)
    {
        return $this->promotionRepository->find($id);
    }
    public function update($data, $id)
    {
        $promotion = $this->promotionRepository->find($id);
        $params = [];
        $params = [
            'description' => $data->description,
            'discount_percentage' => $data->discount_percentage,
            'start_date' => $data->start_date,
            'end_date' => $data->end_date
        ];

        $promotion = $this->promotionRepository->update($params, $id);

        return $promotion;
    }
}
