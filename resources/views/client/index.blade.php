@extends('client.layout.master_layout')

@section('content')

<section class="home-grid">

   <h1 class="heading">quick options</h1>

   <div class="box-container">
      <div class="box">
         <h3 class="title">likes and comments</h3>
         <p class="likes">total likes : <span>25</span></p>
         <a href="#" class="inline-btn">view likes</a>
         <p class="likes">total comments : <span>12</span></p>
         <a href="#" class="inline-btn">view comments</a>
         <p class="likes">saved playlists : <span>4</span></p>
         <a href="#" class="inline-btn">view playlists</a>
      </div>

      <div class="box">
         <h3 class="title">top categories</h3>
         <div class="flex">
            @foreach($categories as $category)
            <a href="#"><span>{{ $category->name }}</span></a>
            @endforeach
         </div>
      </div>

      <div class="box">
         <h3 class="title">popular course</h3>
         <div class="flex">
            @foreach($courses as $course)
            <a href="#"><span>{{ $course->title }}</span></a>
            @endforeach
         </div>
      </div>

      <div class="box">
         <h3 class="title">become a tutor</h3>
         <p class="tutor">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Perspiciatis, nam?</p>
         <a href="teachers.html" class="inline-btn">get started</a>
      </div>

   </div>

</section>

<section class="courses">

   <h1 class="heading">our courses</h1>

   <div class="box-container">
      @foreach($courses as $course)
      <div class="box">
         <div class="tutor">
            @php
            $teacher = $course->users->first(); // Lấy giáo viên đầu tiên từ collection
            @endphp
            @if($teacher && $teacher->image)
               <img src="{{ asset('storage/' . $teacher->image) }}" alt="{{ $teacher->full_name }}">
            @else
               <img src="{{ asset('storage/default_teacher_image.jpg') }}" alt="Default Image">
            @endif
            <div class="info">
               <h3>{{ $teacher ? $teacher->full_name : 'Unknown' }}</h3>
               <span>{{ $course->start_date }}</span>
            </div>
         </div>
         <div class="thumb">
            <img src="{{ asset('storage/' . $course->image) }}" alt="{{ $course->title }}">
            <span>10 videos</span>
         </div>
         <h3 class="title">{{ $course->title }}</h3>
         @if(!in_array($course->id, $purchasedCourses))
         <form action="{{ route('cart.add') }}" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{ $course->id }}">
            <button type="submit" class="inline-btn">Add to Cart</button>
         </form>
         @else
         <p class="already-purchased">Already Purchased</p>
         <a href="{{ route('coursesDetail', [$course->id]) }}" class="inline-btn">view playlist</a>
         @endif
      </div>
      @endforeach
   </div>

   <div class="more-btn">
      <a href="{{ route('courses') }}" class="inline-option-btn">view all courses</a>
   </div>

</section>

@endsection
