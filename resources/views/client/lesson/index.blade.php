@extends('client.layout.master_layout')

@section('content')

<section class="watch-video">

   <div class="video-container">
      <div class="video" data-video-url="{{ $lesson->video_url }}" data-video-title="{{ $lesson->title }}">
         <!-- Video sẽ được tải bằng jQuery -->
      </div>
      
      <h3 class="title">{{ $lesson->title }}</h3>
      <div class="info">
         <p class="date"><i class="fas fa-calendar"></i><span>{{ $lesson->created_at }}</span></p>
         <p class="date"><i class="fas fa-heart"></i><span>44 likes</span></p>
      </div>
      <div class="tutor">
         <img src="images/pic-2.jpg" alt="">
         <div>
            <h3>john deo</h3>
            <span>developer</span>
         </div>
      </div>
      <form action="" method="post" class="flex">
         <a href="{{ route('coursesDetail',[$courseId])}}" class="inline-btn">view playlist</a>
         <button><i class="far fa-heart"></i><span>like</span></button>
      </form>
      <p class="description">
         {{ $lesson->content }}
      </p>
   </div>

</section>

<section class="comments">

   <h1 class="heading">5 comments</h1>

   @auth
   <form action="{{ route('reviews.store', $lesson->id) }}" class="add-comment" method="POST">
      @csrf
      <h3>add comments</h3>
      <div>
         <label for="rating">Rating (1-5):</label>
         <input type="number" name="rating" min="1" max="5" required>
      </div>
      <textarea name="review" placeholder="enter your comment" required maxlength="1000" cols="30" rows="10"></textarea>
      <input type="submit" value="add comment" class="inline-btn" name="add_comment">
   </form>
   @endauth
   <h1 class="heading">user comments</h1>

   <div class="box-container">
    @forelse($reviews as $review)
    <div class="box">
        <div class="user">
            <img src="{{ asset('storage/' . $review->user->image) }}" alt="">
            <div>
                <h3>{{ $review->user->full_name }}</h3>
                <span>{{ $review->created_at->format('d M Y, H:i') }}</span>
            </div>
        </div>
        <div class="comment-box">{{ $review->review }}</div>

        @auth
            @if(Auth::id() === $review->user_id)
                <form action="{{ route('reviews.edit', $review->id) }}" method="GET" class="flex-btn">
                    @csrf
                    <input type="submit" value="Edit Comment" class="inline-option-btn">
                </form>
                <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" class="flex-btn">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="Delete Comment" class="inline-delete-btn">
                </form>
            @endif
        @endauth
    </div>
    @empty
        <p>No reviews yet.</p>
    @endforelse
</div>


   

</section>

@endsection

@push('scripts')
   <script>
      $(document).ready(function() {
    $('.video').each(function() {
        var videoUrl = $(this).data('video-url');
        var youtubeId = null;
        var embedUrl = null;
        var videoFile = '{{ Storage::url($lesson->video_url) }}';

        // Tìm kiếm ID video YouTube
        var youtubePattern = /(?:https?:\/\/)?(?:www\.)?youtube\.com\/(?:[^\/\n\s]+\/\S+\/|v\/|embed\/|watch\?v=|watch\?.+&v=)?([^"&?\/\s]{11})/;
        var match = youtubePattern.exec(videoUrl);
        if (match) {
            youtubeId = match[1];
        }

        // Tạo URL nhúng từ ID video
        embedUrl = youtubeId ? "https://www.youtube.com/embed/" + youtubeId : null;

        if (embedUrl) {
            // Thêm iframe YouTube vào phần tử video
            $(this).html('<iframe src="' + embedUrl + '" frameborder="0" allowfullscreen width="1120px" height="630px"></iframe>');
        } else {
            // Thêm video local vào phần tử video
            $(this).html('<video id="video_file_preview" controls><source src="' + videoFile + '" type="video/mp4"></video>');
        }
    });
});

   </script>
@endpush