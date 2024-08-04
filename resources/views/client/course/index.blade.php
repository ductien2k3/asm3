@extends('client.layout.master_layout')

@section('content')
    <section class="courses">

   <h1 class="heading">our courses</h1>

   <div class="box-container">
      @foreach($courses as $course)
      <div class="box">
         <div class="tutor">
            <img src="images/pic-2.jpg" alt="">
            <div class="info">
               <h3>john deo</h3>
               <span>{{$course->start_date}}</span>
            </div>
         </div>
         <div class="thumb">
            <img src="{{ asset('storage/' . $course->image) }}" alt="">
            <span>10 videos</span>
         </div>
         <h3 class="title">{{$course->title}}</h3>
         <a href="{{ route('coursesDetail' , [$course->id] )}}" class="inline-btn">view playlist</a>
      </div>
      @endforeach  
   </div>
   {{ $courses->links('admin.layout.paginate') }}
</section>

@endsection
