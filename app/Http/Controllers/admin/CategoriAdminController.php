<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Services\Contracts\CategoryServiceInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoriAdminController extends Controller
{
    protected $categoryService;

    public function __construct(
        CategoryServiceInterface $categoryService
    ) {
        $this->categoryService = $categoryService;
    }
    public function index()
    {
        $categories = $this->categoryService->getAllCategory();
        return view('admin.category.index', compact('categories'));
    }
    public function create()
    {
        return view('admin.category.create');
    }
    public function store(CategoryRequest $request)
    {
        try {
            $this->categoryService->store($request);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('admin.category.index')->with('error', __('content.category.message.create.error'));
        }
        return redirect()->route('admin.category.index')->with('success', __('content.category.message.create.success'));
    }
    public function edit($id)
    {
        $category = $this->categoryService->edit($id);
        if (!$category) {
            return redirect()->route('admin.category.index')->with('error', __('content.category.message.error'));
        }
        return view('admin.category.edit', compact('category'));
    }

    public function update(CategoryRequest $request, $id)
    {
        try {
            $this->categoryService->update($request, $id);
            return redirect()->route('admin.category.index')->with('success', __('content.category.message.update.success'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('admin.category.index')->with('error', __('content.category.message.update.error'));
        }
    }

    public function detail($id)
    {
        $category = $this->categoryService->getDetailCategory($id);
        if (empty($category)) {
            return abort(404);
        }
        return view('admin.category.detail', compact('category'));
    }
    public function delete($id)
    {
        $category = $this->categoryService->getDetailCategory($id);
        if (empty($category)) {
            return abort(404);
        }
        try {
            $category->delete();
            return redirect()->route('admin.category.index')->with('success', __('content.category.message.delete.success'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('admin.category.index')->with('error', __('content.category.message.delete.error'));
        }
    }

}
