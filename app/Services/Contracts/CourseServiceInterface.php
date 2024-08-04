<?php

namespace App\Services\Contracts;

interface CourseServiceInterface
{
    public function getAllCourse();
    public function create($data);
    public function store($data);
    public function edit($id);
    public function update($data, $id);

    // client 
    public function getAllCourseHome();

}
