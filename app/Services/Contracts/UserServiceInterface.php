<?php

namespace App\Services\Contracts;

interface UserServiceInterface
{
    public function getAll();
    public function create($data);
    public function store($data);
    public function edit($id);
    public function update($data, $id);
    public function getDetailCategory($id);

    // client
    public function register($data);
    public function login($data);
}
