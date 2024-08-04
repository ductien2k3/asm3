@extends('client.layout.master_layout')

@section('content')
<section class="form-container">

   <form action="{{ route('updateProfile') }}" method="post" enctype="multipart/form-data">
      @csrf
      <h3>Update Profile</h3>
      <input type="hidden" name="role_id" placeholder="Role ID" maxlength="50" class="box" value="1">
      <p>Update Username</p>
      <input type="text" name="user_name" placeholder="Username" maxlength="50" class="box" value="{{ old('user_name', $user->user_name) }}">
      @error('user_name')
          <div class="alert alert-danger">{{ $message }}</div>
      @enderror
      
      <p>Update Email</p>
      <input type="email" name="email" placeholder="Email" maxlength="50" class="box" value="{{ old('email', $user->email) }}">
      @error('email')
          <div class="alert alert-danger">{{ $message }}</div>
      @enderror
      
      <p>Update Full Name</p>
      <input type="text" name="full_name" placeholder="Full Name" maxlength="50" class="box" value="{{ old('full_name', $user->full_name) }}">
      @error('full_name')
          <div class="alert alert-danger">{{ $message }}</div>
      @enderror
      
      <p>Update Gender</p>
      <select name="gender" class="box">
         <option value="0" {{ old('gender', $user->gender) == '0' ? 'selected' : '' }}>Male</option>
         <option value="1" {{ old('gender', $user->gender) == '1' ? 'selected' : '' }}>Female</option>
      </select>
      @error('gender')
          <div class="alert alert-danger">{{ $message }}</div>
      @enderror
      
      <p>Update Phone</p>
      <input type="text" name="phone" placeholder="Phone" maxlength="20" class="box" value="{{ old('phone', $user->phone) }}">
      @error('phone')
          <div class="alert alert-danger">{{ $message }}</div>
      @enderror
      
      <p>Update Address</p>
      <input type="text" name="address" placeholder="Address" maxlength="100" class="box" value="{{ old('address', $user->address) }}">
      @error('address')
          <div class="alert alert-danger">{{ $message }}</div>
      @enderror
      
      <p>Update Description</p>
      <textarea name="description" placeholder="Description" maxlength="255" class="box">{{ old('description', $user->description) }}</textarea>
      @error('description')
          <div class="alert alert-danger">{{ $message }}</div>
      @enderror
      
      <p>Previous Password</p>
      <input type="password" name="old_pass" placeholder="Enter your old password" maxlength="20" class="box">
      @error('old_pass')
          <div class="alert alert-danger">{{ $message }}</div>
      @enderror
      
      <p>New Password</p>
      <input type="password" name="new_pass" placeholder="Enter your new password" maxlength="20" class="box">
      @error('new_pass')
          <div class="alert alert-danger">{{ $message }}</div>
      @enderror
      
      <p>Confirm Password</p>
      <input type="password" name="c_pass" placeholder="Confirm your new password" maxlength="20" class="box">
      @error('c_pass')
          <div class="alert alert-danger">{{ $message }}</div>
      @enderror
      
      <p>Update Picture</p>
      <input type="file" name="image" accept="image/*" class="box">
      @error('image')
          <div class="alert alert-danger">{{ $message }}</div>
      @enderror
      
      <input type="submit" value="Update Profile" name="submit" class="btn">
   </form>

</section>
@endsection
