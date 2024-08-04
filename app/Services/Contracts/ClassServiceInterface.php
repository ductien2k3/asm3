<?php

namespace App\Services\Contracts;

interface ClassServiceInterface
{
    public function getAllClass();
    public function create($data);
    public function store($data);
    public function edit($id);
    public function update($data, $id);
}
