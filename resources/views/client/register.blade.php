@extends('client.layout.master_layout')

@section('content')

<section class="form-container">

   <form action="{{ route('store')}}" method="post" enctype="multipart/form-data">
      @csrf
      <h3>login now</h3>
      <p>User name <span>*</span></p>
      <input type="text" name="user_name" placeholder="enter your user name" required maxlength="50" class="box"  value="{{ old('user_name')}}">
      @error('user_name')
         <div class="text-danger">{{ $message }}</div>
      @enderror
      <p>Họ và tên <span>*</span></p>
      <input type="text" name="full_name" placeholder="enter your họ tên đầy đủ" required maxlength="200" class="box" value="{{ old('full_name')}}">
      @error('full_name')
         <div class="text-danger">{{ $message }}</div>
      @enderror
      <p>your email <span>*</span></p>
      <input type="email" name="email" placeholder="enter your email" required maxlength="100" class="box" value="{{ old('email')}} ">
      @error('email')
         <div class="text-danger">{{ $message }}</div>
      @enderror
      <p>your password <span>*</span></p>
      <input type="password" name="password" placeholder="enter your password" required maxlength="100" class="box">
      @error('password')
         <div class="text-danger">{{ $message }}</div>
      @enderror
      <input type="submit" value="login new" name="submit" class="btn">
   </form>
</section>

@endsection
