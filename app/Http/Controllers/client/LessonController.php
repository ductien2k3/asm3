<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\ReviewLesson;
use App\Services\Contracts\CategoryServiceInterface;
use App\Services\Contracts\CourseServiceInterface;
use App\Services\Contracts\LessonServiceInterface;
use Illuminate\Http\Request;

class LessonController extends Controller
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

    public function watchVideo($courseId, $lessonId)
    {
        // Lấy thông tin bài học từ dịch vụ
        $lesson = $this->lessonService->getLessonByCourseIdAndLessonId($courseId, $lessonId);

        // Kiểm tra xem bài học có tồn tại không
        if (!$lesson) {
            abort(404, 'Lesson not found');
        }
        // Lấy bình luận của bài học
        $reviews = ReviewLesson::where('lesson_id', $lessonId)->with('user')->get();

        // Trả về view với thông tin bài học và bình luận
        return view('client.lesson.index', compact('courseId', 'lessonId', 'lesson', 'reviews'));
    }

}
