@extends('admin.layout.master_layout')

@section('content')
<div class="wrapper mt-3">
  <div class="content-wrapper">


<section class="order-detail">
    <h1 class="heading">Order Details</h1>
    <div class="box">
        <h3>Order ID: {{ $order->id }}</h3>
        <p>User Course ID: {{ $order->user_course_id }}</p>
        <p>Purchased By: {{ $order->userCourse->user->full_name }}</p>
        <p>Date: {{ $order->payment_date }}</p>
        <p>Status: {{ $order->userCourse->status }}</p>
        <p>Total: {{ $order->amount }}</p>
        <h4>Course:</h4>
        <p>{{ $order->userCourse->course->title }}</p>
        <img src="{{ asset('storage/' . $order->userCourse->course->image)  }}" alt="" width="100px" height="100px"></>
    </div>
</section>

  </div>

</div>
@endsection
