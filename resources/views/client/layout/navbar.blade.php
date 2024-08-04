<header class="header">
   <section class="flex">
      <a href="home.html" class="logo">Educa.</a>
      <form action="search.html" method="post" class="search-form">
         <input type="text" name="search_box" required placeholder="search courses..." maxlength="100">
         <button type="submit" class="fas fa-search"></button>
      </form>
      
      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="search-btn" class="fas fa-search"></div>
         <div id="user-btn" class="fas fa-user"></div>
         <div id="toggle-btn" class="fas fa-sun"></div>
      </div>

      @if (Auth::check())
      <div class="profile">
         <img src="{{ asset('storage/' . Auth::user()->image) }}" class="image" alt="">
         <h3 class="name">{{ Auth::user()->full_name }}</h3>
         <p class="role">{{ Auth::user()->user_name }}</p>
         <a href="{{ route('profile')}}" class="btn">view profile</a>
         <a href="{{ route('cart.index')}}" class="btn">Cart</a>
         <div class="flex-btn">
            <a href="{{ route('logout')}}" class="option-btn">logout</a>
         </div>
      </div>
      @else
         <div class="profile">
         <img src="images/pic-1.jpg" class="image" alt="">
         <h3 class="name">shaikh anas</h3>
         <p class="role">studen</p>
         <a href="{{ route('profile')}}" class="btn">view profile</a>
         <div class="flex-btn">
            <a href="{{ route('login')}}" class="option-btn">login</a>
            <a href="{{ route('register')}}" class="option-btn">register</a>
         </div>
         <div class="flex-btn">
            <a href="{{ route('logout')}}" class="option-btn">logout</a>
         </div>
      </div>
      @endif

   </section>
</header>