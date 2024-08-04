@extends('client.layout.master_layout')

@section('content')
<section class="courses">
    <h1 class="heading">Your Orders</h1>
    <div class="box-container">
        @foreach($orders as $order)
        <div class="box">
            <div class="tutor">
                <img src="images/pic-2.jpg" alt="">
                <div class="info">
                    <h3>{{ $order->userCourse->course->title }}</h3>
                    <span>Start Date: {{ $order->userCourse->course->start_date }}</span>
                </div>
            </div>
            <div class="thumb">
                <img src="{{ asset('storage/' . $order->userCourse->course->image) }}" alt="">
                <span>10 videos</span>
            </div>
            <h3 class="title">{{ $order->userCourse->course->title }}</h3>
            <a href="{{ route('coursesDetail', [$order->userCourse->course->id]) }}" class="inline-btn">View Details</a>
        </div>
        @endforeach  
    </div>
    {{ $orders->links('admin.layout.paginate') }}
</section>
@endsection
