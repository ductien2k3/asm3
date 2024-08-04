<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCourseRequest;
use App\Services\Contracts\CategoryServiceInterface;
use App\Services\Contracts\CourseServiceInterface;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CourseAdminController extends Controller
{
    protected $courseService;
    protected $categoryService;

    public function __construct(
        CourseServiceInterface $courseService,
        CategoryServiceInterface $categoryService
    ) {
        $this->courseService = $courseService;
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $courses = $this->courseService->getAllCourse();
        return view('admin.course.index', compact('courses'));
    }

    public function create()
    {
        $categories = $this->categoryService->getAllCategory();
        return view('admin.course.create', compact('categories'));
    }
    public function store(StoreCourseRequest $request)
    {
        $userId = Auth::id();
        DB::beginTransaction();
        try {
            $course = $this->courseService->store($request);
            $course->users()->attach($userId);
            $courseId = $course->id;
            DB::commit();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            DB::rollBack();
            return redirect()->back()->with('error', __('content.course.message.create.error'));
        }

        return redirect()->route('admin.courses.index')->with('success', __('content.course.message.create.success'));
    }

    public function edit($id)
    {
        $course = $this->courseService->edit($id);
        if (!$course) {
            return redirect()->route('admin.courses.index')->with('error', __('content.courses.message.error'));
        }
        $categories = $this->categoryService->getAllCategory();
        return view('admin.course.edit', compact('course', 'categories'));
    }

    public function update(StoreCourseRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $this->courseService->update($request, $id);
            DB::commit();
            return redirect()->route('admin.courses.index')->with('success', __('content.course.message.update.success'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            DB::rollBack();
            return redirect()->back()->with('error', __('content.course.message.update.error'));
        }
    }

    public function delete($id)
    {
        $course = $this->courseService->edit($id);
        if (empty($course)) {
            return abort(404);
        }
        try {
            $course->delete();
            return redirect()->route('admin.courses.index')->with('success', __('content.course.message.delete.success'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('admin.courses.index')->with('error', __('content.course.message.delete.error'));
        }
    }

}
