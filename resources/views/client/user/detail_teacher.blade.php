@extends('client.layout.master_layout')

@section('content')
<section class="teacher-profile">

   <h1 class="heading">profile details</h1>

   <div class="details">
      <div class="tutor">
         <img src="{{ asset('storage/' . $teacher->image) }}" alt="">
         <h3>{{ $teacher->full_name}}</h3>
         <span>{{ $teacher->user_name}}</span>
      </div>
      <div class="flex">
         <p>total playlists : <span>4</span></p>
         <p>total videos : <span>18</span></p>
         <p>total likes : <span>1208</span></p>
         <p>total comments : <span>52</span></p>
      </div>
   </div>

</section>

<section class="courses">

   <h1 class="heading">our courses</h1>

   <div class="box-container">

      @foreach ($courses as $course)
          <div class="box">
         <div class="thumb">
            <img src="{{ asset('storage/' . $course->image) }}" alt="">
            <span>10 videos</span>
         </div>
         <h3 class="title">{{ Str::limit($course->title, 30, '...') }}</h3>
         <a href="{{ route('coursesDetail' , [$course->id])}}" class="inline-btn">view playlist</a>
      </div>
      @endforeach
   </div>

</section>
@endsection
