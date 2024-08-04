<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Contracts\CourseServiceInterface;
use App\Services\Contracts\UserServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $userService;
    protected $courseService;

    public function __construct(
        UserServiceInterface $userService,
        CourseServiceInterface $courseService,
    ) {
        $this->userService = $userService;
        $this->courseService = $courseService;
    }
    public function indexTeacher()
    {
        $teachers = User::where('role_id', 2)->paginate(PAGINATE_MAX_HOME);
        return view('client.user.index_teacher', compact('teachers'));
    }

    public function detailTeacher($id)
    {
        $teacher = User::findOrFail($id);
        $courses = $teacher->courses;
        return view('client.user.detail_teacher', compact('teacher', 'courses'));
    }
    public function profile()
    {
        if (Auth::check()) {
            $user = Auth::user();
            return view('client.user.profile', compact('user'));
        } else {
            return redirect()->route('login');
        }
    }
    public function showUpdateForm()
    {
        if (Auth::check()) {
            $user = Auth::user();

            return view('client.user.update', compact('user'));
        } else {
            return redirect()->route('login');
        }
    }

    public function update(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $id = $user->id;
            try {
                $updatedUser = $this->userService->update($request, $id);
                return redirect()->route('profile')->with('success', 'Cập nhật thông tin thành công!');
            } catch (\Exception $e) {
                return redirect()->route('profile')->with('error', 'Có lỗi xảy ra trong quá trình cập nhật thông tin.');
            }
        } else {
            return redirect()->route('login');
        }
    }
}
