@extends('client.layout.master_layout')

@section('content')
<div class="container">
    <h1>Edit Comment</h1>

    <form action="{{ route('reviews.update', $review->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="rating">Rating (1-5):</label>
            <input type="number" name="rating" value="{{ $review->rating }}" min="1" max="5" required>
        </div>
        <div>
            <label for="review">Review:</label>
            <textarea name="review" required maxlength="1000" cols="30" rows="10">{{ $review->review }}</textarea>
        </div>
        <button type="submit" class="btn-submit">Update Review</button>
    </form>
</div>
@endsection
