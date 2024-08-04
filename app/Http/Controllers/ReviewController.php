<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\ReviewLesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, $lessonId)
    {
        $request->validate([
            'review' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        ReviewLesson::create([
            'user_id' => Auth::id(),
            'lesson_id' => $lessonId,
            'review' => $request->input('review'),
            'rating' => $request->input('rating'),
        ]);

        return redirect()->back()->with('success', 'Review added successfully!');
    }
    public function edit($id)
    {
        $review = ReviewLesson::findOrFail($id);
        $this->authorize('update', $review); // Sử dụng policy để kiểm tra quyền
        return view('client.reviews.edit', compact('review'));
    }

    public function update(Request $request, $id)
    {
        $review = ReviewLesson::findOrFail($id);

        $request->validate([
            'review' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $review->update([
            'review' => $request->input('review'),
            'rating' => $request->input('rating'),
        ]);

        // Lấy ID của lesson từ review
        $lessonId = $review->lesson_id;
        $courseId = Lesson::findOrFail($lessonId)->course_id;

        return redirect()->route('watch-video', [$courseId, $lessonId])
            ->with('success', 'Review updated successfully!');
    }


    public function destroy($id)
    {
        $review = ReviewLesson::findOrFail($id);
        $this->authorize('delete', $review);

        $review->delete();

        return redirect()->back()->with('success', 'Review deleted successfully!');
    }


}
