@extends('admin.layout.master_layout')

@section('content')
<div class="wrapper mt-3">
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row"> 
            <h3 class="card-title p-2">All Orders</h3> 
          <div class="col-12">
            <div class="card">
              <div class="card-header">
              <!-- /.card-header -->
              <div class="card-body">
                @foreach($orders as $order)
        <div class="box">
            <h3>Order ID: {{ $order->id }}</h3>
            <p>User Course ID: {{ $order->user_course_id }}</p>
            <p>Purchased By: {{ $order->userCourse->user->full_name }}</p> <!-- Hiển thị tên người mua -->
             <p>Course Title: {{ $order->userCourse2->course2->title }}</p> <!-- Hiển thị tên khóa học -->
            <p>Date: {{ $order->payment_date }}</p>
            <p>Status: {{ $order->userCourse->status }}</p>
            <p>Total: {{ $order->amount }}</p>
            <a href="{{ route('admin.orders.show', [$order->id]) }}" class="inline-btn">View Details</a>
        </div>
        @endforeach
                <div class="d-flex justify-content-between mt-2">
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>

  </div>

</div>
@endsection

