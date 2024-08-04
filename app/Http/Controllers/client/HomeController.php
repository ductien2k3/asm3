<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\Order;
use App\Services\Contracts\CategoryServiceInterface;
use App\Services\Contracts\CourseServiceInterface;
use App\Services\Contracts\UserServiceInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    protected $courseService;
    protected $categoryService;
    protected $userService;

    public function __construct(
        CourseServiceInterface $courseService,
        CategoryServiceInterface $categoryService,
        UserServiceInterface $userService
    ) {
        $this->courseService = $courseService;
        $this->categoryService = $categoryService;
        $this->userService = $userService;
    }

    public function index()
    {
        $courses = $this->courseService->getAllCourseHome();
        $courses = $courses->load('users');
        $categories = $this->categoryService->getAllCategory();
        $purchasedCourses = [];

        if (Auth::check()) {
            $user = Auth::user();
            $purchasedCourses = $user->coursesUser()->pluck('course_id')->toArray();
        }

        return view('client.index', compact('courses', 'categories', 'purchasedCourses'));
    }

    public function about()
    {
        return view('client.about');
    }

    public function contactUs()
    {
        return view('client.contactUs');
    }

    public function showLogin()
    {
        return view('client.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = $this->userService->login($request);

        if ($user) {
            return redirect()->route('home');
        } else {
            return redirect()->back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }
    }

    public function register()
    {
        return view('client.register');
    }
    public function store(StoreUserRequest $request)
    {
        try {
            $this->userService->store($request);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', __('content.user.message.create.error'));
        }
        return redirect()->route('login')->with('success', __('content.user.message.create.success'));
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function showOrders()
    {
        $user = Auth::user();
        $orders = Order::whereHas('userCourse', function ($query) use ($user) {
            $query->where('user_id', $user->id)
                ->where('status', 'paid');
        })->with('userCourse.course') // Đưa vào thông tin khóa học
            ->paginate(PAGINATE_MAX_HOME);

        return view('client.orders.index', compact('orders'));
    }
}
