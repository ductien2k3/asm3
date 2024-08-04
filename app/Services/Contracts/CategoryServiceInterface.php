<?php

namespace App\Services\Contracts;

interface CategoryServiceInterface
{
    public function getAllCategory();
    public function create($data);
    public function store($data);
    public function edit($id);
    public function update($data, $id);
    public function getDetailCategory($id);

}
