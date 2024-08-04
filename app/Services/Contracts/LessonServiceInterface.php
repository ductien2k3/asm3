<?php

namespace App\Services\Contracts;

interface LessonServiceInterface
{
    public function getAll();
    public function create($data);
    public function store($data);
    public function edit($id);
    public function update($data, $id);

    public function getLessonsByCourseId($id);

    public function getLessonByCourseIdAndLessonId($courseId, $lessonId);
}
