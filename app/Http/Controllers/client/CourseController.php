<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Services\Contracts\CategoryServiceInterface;
use App\Services\Contracts\CourseServiceInterface;
use App\Services\Contracts\LessonServiceInterface;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    protected $courseService;
    protected $categoryService;
    protected $lessonService;

    public function __construct(
        CourseServiceInterface $courseService,
        CategoryServiceInterface $categoryService,
        LessonServiceInterface $lessonService,
    ) {
        $this->courseService = $courseService;
        $this->categoryService = $categoryService;
        $this->lessonService = $lessonService;
    }
    public function index()
    {
        $courses = $this->courseService->getAllCourseHome();
        return view('client.course.index', compact('courses'));
    }
    public function detail($id)
    {
        $course = $this->courseService->edit($id);
        $lessons = $this->lessonService->getLessonsByCourseId($id);
        return view('client.course.detail', compact('course', 'lessons'));
    }

}
