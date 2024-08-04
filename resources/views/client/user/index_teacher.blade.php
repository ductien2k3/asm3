@extends('client.layout.master_layout')

@section('content')

<section class="teachers">

   <h1 class="heading">expert teachers</h1>

   <form action="" method="post" class="search-tutor">
      <input type="text" name="search_box" placeholder="search tutors..." required maxlength="100">
      <button type="submit" class="fas fa-search" name="search_tutor"></button>
   </form>

   <div class="box-container">

      <div class="box offer">
         <h3>become a tutor</h3>
         <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet, itaque ipsam fuga ex et aliquam.</p>
         <a href="register.html" class="inline-btn">get started</a>
      </div>

      @foreach($teachers as $teacher)
      <div class="box">
         <div class="tutor">
            <img src="{{ asset('storage/' . $teacher->image) }}" alt="">
            <div>
               <h3>{{ $teacher->full_name}}</h3>
               <span>{{ $teacher->user_name}}</span>
            </div>
         </div>
         <p>total playlists : <span>4</span></p>
         <p>total videos : <span>18</span></p>
         <p>total likes : <span>1208</span></p>
         <a href="{{ route('detailTeacher', [$teacher->id])}}" class="inline-btn">view profile</a>
      </div>
      @endforeach
   </div>
   {{ $teachers->links('admin.layout.paginate') }}
</section>
@endsection
