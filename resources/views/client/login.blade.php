@extends('client.layout.master_layout')

@section('content')

<section class="form-container">
   <form action="{{ route('login.post') }}" method="post" enctype="multipart/form-data">
      @csrf
      <h3>login now</h3>
      <p>your email <span>*</span></p>
      <input type="email" name="email" placeholder="enter your email" required maxlength="50" class="box" value="{{ old('email')}}">
      @error('email')
         <div class="text-danger">{{ $message }}</div>
      @enderror
      <p>your password <span>*</span></p>
      <input type="password" name="password" placeholder="enter your password" required maxlength="20" class="box">
      @error('password')
         <div class="text-danger">{{ $message }}</div>
      @enderror
      <input type="submit" value="login now" name="submit" class="btn">
   </form>
</section>

@endsection
