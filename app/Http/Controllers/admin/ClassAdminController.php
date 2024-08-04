<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClassRequest;
use App\Services\Contracts\ClassServiceInterface;
use App\Services\Contracts\CourseServiceInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ClassAdminController extends Controller
{
    protected $courseService;
    protected $classService;

    public function __construct(
        CourseServiceInterface $courseService,
        ClassServiceInterface $classService
    ) {
        $this->courseService = $courseService;
        $this->classService = $classService;
    }
    public function index()
    {
        $classes = $this->classService->getAllClass();
        return view('admin.class.index', compact('classes'));
    }
    public function create()
    {
        $courses = $this->courseService->getAllCourse();
        return view('admin.class.create', compact('courses'));
    }

    public function store(StoreClassRequest $request)
    {
        DB::beginTransaction();
        try {
            $this->classService->store($request);
            DB::commit();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            DB::rollBack();
            return redirect()->back()->with('error', __('content.class.message.create.error'));
        }
        return redirect()->route('admin.class.index')->with('success', __('content.class.message.create.success'));
    }
    public function edit($id)
    {
        $class = $this->classService->edit($id);
        if (!$class) {
            return redirect()->route('admin.class.index')->with('error', __('content.class.message.error'));
        }
        $courses = $this->courseService->getAllCourse();
        return view('admin.class.edit', compact('courses', 'class'));
    }

    public function update(StoreClassRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $this->classService->update($request, $id);
            DB::commit();
            return redirect()->route('admin.class.index')->with('success', __('content.class.message.update.success'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            DB::rollBack();
            return redirect()->back()->with('error', __('content.class.message.update.error'));
        }
    }
    public function delete($id)
    {
        $class = $this->classService->edit($id);
        if (empty($class)) {
            return abort(404);
        }
        try {
            $class->delete();
            return redirect()->route('admin.class.index')->with('success', __('content.class.message.delete.success'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('admin.class.index')->with('error', __('content.class.message.delete.error'));
        }
    }
}
