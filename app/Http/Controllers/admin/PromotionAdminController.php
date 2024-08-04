<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePromotionRequest;
use App\Http\Requests\UpdatePromotionRequest;
use App\Services\Contracts\PromotionServiceInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PromotionAdminController extends Controller
{
    protected $promotionService;
    protected $courseService;

    public function __construct(
        PromotionServiceInterface $promotionService,
    ) {
        $this->promotionService = $promotionService;
    }
    public function index()
    {
        $promotions = $this->promotionService->getAll();
        return view('admin.promotion.index', compact('promotions'));
    }
    public function create()
    {
        $randomCode = strtoupper(Str::random(10));
        return view('admin.promotion.create', compact('randomCode'));
    }
    public function store(StorePromotionRequest $request)
    {
        try {
            $this->promotionService->store($request);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', __('content.promotion.message.create.error'));
        }
        return redirect()->route('admin.promotion.index')->with('success', __('content.promotion.message.create.success'));
    }
    public function edit($id)
    {
        $promotion = $this->promotionService->edit($id);
        if (!$promotion) {
            return redirect()->route('admin.promotion.index')->with('error', __('content.promotion.message.error'));
        }
        return view('admin.promotion.edit', compact('promotion'));
    }

    public function update(UpdatePromotionRequest $request, $id)
    {
        try {
            $this->promotionService->update($request, $id);
            return redirect()->route('admin.promotion.index')->with('success', __('content.promotion.message.update.success'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('admin.promotion.index')->with('error', __('content.promotion.message.update.error'));
        }
    }

    public function delete($id)
    {
        $course = $this->promotionService->edit($id);
        if (empty($course)) {
            return abort(404);
        }
        try {
            $course->delete();
            return redirect()->route('admin.promotion.index')->with('success', __('content.promotion.message.delete.success'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('admin.promotion.index')->with('error', __('content.promotion.message.delete.error'));
        }
    }
}
