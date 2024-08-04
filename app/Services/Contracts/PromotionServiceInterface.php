<?php

namespace App\Services\Contracts;

interface PromotionServiceInterface
{
    public function getAll();
    public function create($data);
    public function store($data);
    public function edit($id);
    public function update($data, $id);
}
