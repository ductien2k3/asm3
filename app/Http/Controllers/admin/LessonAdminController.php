<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLessonRequest;
use App\Services\Contracts\CourseServiceInterface;
use App\Services\Contracts\LessonServiceInterface;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LessonAdminController extends Controller
{
    protected $lessonService;
    protected $courseService;

    public function __construct(
        LessonServiceInterface $lessonService,
        CourseServiceInterface $courseService,
    ) {
        $this->lessonService = $lessonService;
        $this->courseService = $courseService;
    }

    public function index()
    {
        $lessons = $this->lessonService->getAll();
        return view('admin.lesson.index', compact('lessons'));
    }
    public function create()
    {
        $courses = $this->courseService->getAllCourse();
        return view('admin.lesson.create', compact('courses'));
    }

    public function store(StoreLessonRequest $request)
    {
        $userId = Auth::id();
        DB::beginTransaction();
        try {
            $lesson = $this->lessonService->store($request);
            $lesson->users()->attach($userId);
            $lessonId = $lesson->id;
            DB::commit();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            DB::rollBack();
            return redirect()->back()->with('error', 'Bài học không được tạo thành công.');
        }
        return redirect()->route('admin.lessons.index')->with('success', 'Bài học đã được tạo thành công.');
    }
    public function edit($id)
    {
        $lesson = $this->lessonService->edit($id);
        if (!$lesson) {
            return redirect()->route('admin.lessons.index')->with('error', __('content.courses.message.error'));
        }
        $courses = $this->courseService->getAllCourse();
        return view('admin.lesson.edit', compact('lesson', 'courses'));
    }
    public function update(StoreLessonRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $this->lessonService->update($request, $id);
            DB::commit();
            return redirect()->route('admin.lessons.index')->with('success', 'Bài học đã được cập nhật thành công.');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            DB::rollBack();
            return redirect()->back()->with('error', __('Bài học cập nhật thất bại'));
        }
    }
    public function delete($id)
    {
        $lesson = $this->lessonService->edit($id);
        if (empty($lesson)) {
            return abort(404);
        }
        try {
            $lesson->delete();
            return redirect()->route('admin.lessons.index')->with('success', __('Xoá thành công'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('admin.lessons.index')->with('error', __('xoá thất bại'));
        }
    }
}
