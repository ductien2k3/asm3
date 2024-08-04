<div class="side-bar">

   <div id="close-btn">
      <i class="fas fa-times"></i>
   </div>

   @if (Auth::check())
   <div class="profile">
      <img src="{{ asset('storage/' . Auth::user()->image) }}" class="image" alt="">
      <h3 class="name">{{ Auth::user()->full_name }}</h3>
      <p class="role">{{ Auth::user()->user_name }}</p>
      <a href="{{ route('profile') }}" class="btn">view profile</a>
   </div>
   @else
    <div class="profile">
      <img src="images/pic-1.jpg" class="image" alt="">
      <h3 class="name">Vui lòng <a href="{{ route('login') }}">đăng nhập</a> để tiếp tục.</h3>
   </div>
   @endif


   <nav class="navbar">
      <a href="{{ route('home') }}"><i class="fas fa-home"></i><span>home</span></a>
      <a href="{{ route('about') }}"><i class="fas fa-question"></i><span>about</span></a>
      <a href="{{ route('courses') }}"><i class="fas fa-graduation-cap"></i><span>courses</span></a>
      <a href="{{ route('teacher') }}"><i class="fas fa-chalkboard-teacher"></i><span>teachers</span></a>
      <a href="{{ route('contact-us') }}"><i class="fas fa-headset"></i><span>contact us</span></a>
      <a href="{{ route('orders.index') }}"><i class="fas fa-headset"></i><span>my course</span></a>
   </nav>
   
</div>