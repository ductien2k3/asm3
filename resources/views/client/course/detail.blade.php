@extends('client.layout.master_layout')

@section('content')

<section class="playlist-details">

   <h1 class="heading">playlist details</h1>

   <div class="row">

      <div class="column">
         <form action="" method="post" class="save-playlist">
            <button type="submit"><i class="far fa-bookmark"></i> <span>save playlist</span></button>
         </form>
   
         <div class="thumb">
            <img src="{{ asset('storage/' . $course->image) }}" alt="">
            <span>10 videos</span>
         </div>
      </div>
      <div class="column">
         <div class="tutor">
            <img src="images/pic-2.jpg" alt="">
            <div>
               <h3>john deo</h3>
               <span>{{ $course->created_at}}</span>
            </div>
         </div>
   
         <div class="details">
            <h3>{{ $course->title}}</h3>
            <p>{{ $course->description	}}</p>
            <a href="#" class="inline-btn">view profile</a>
         </div>
      </div>
   </div>

</section>

<section class="playlist-videos">

   <h1 class="heading">playlist videos</h1>

   <div class="box-container">
      @foreach ($lessons as $lesson)
      <a class="box" href="{{ route('watch-video', ['courseId' => $course->id, 'lessonId' => $lesson->id]) }}">
         <i class="fas fa-play"></i>
         <img src="{{ asset('storage/' . $course->image) }}" alt="">
         <h3>{{ $lesson->title}}</h3>
      </a>
      @endforeach
   </div>

</section>
@endsection
