<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Services\Contracts\UserServiceInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserAdminController extends Controller
{
    protected $userService;

    public function __construct(
        UserServiceInterface $userService
    ) {
        $this->userService = $userService;
    }
    public function index()
    {
        $users = $this->userService->getAll();
        return view('admin.user.index', compact('users'));
    }
    public function create()
    {
        return view('admin.user.create');
    }
    public function store(StoreUserRequest $request)
    {
        try {
            $this->userService->store($request);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', __('content.user.message.create.error'));
        }
        return redirect()->route('admin.user.index')->with('success', __('content.user.message.create.success'));
    }
    public function edit($id)
    {
        $user = $this->userService->edit($id);
        if (!$user) {
            return redirect()->route('admin.user.index')->with('error', __('content.user.message.error'));
        }
        return view('admin.user.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, $id)
    {
        try {
            $this->userService->update($request, $id);
            return redirect()->route('admin.user.index')->with('success', __('content.class.message.update.success'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', __('content.class.message.update.error'));
        }
    }
    public function delete($id)
    {
        $user = $this->userService->edit($id);
        if (empty($user)) {
            return abort(404);
        }
        try {
            $user->delete();
            return redirect()->route('admin.user.index')->with('success', __('content.course.message.delete.success'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('admin.user.index')->with('error', __('content.course.message.delete.error'));
        }
    }
}

