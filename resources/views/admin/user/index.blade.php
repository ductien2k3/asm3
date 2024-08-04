@extends('admin.layout.master_layout')

@section('content')

<div class="wrapper mt-3">
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row"> 
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Danh sách người dùng</h3> 
                <a href="{{ route('admin.user.create')}}" class="d-flex justify-content-end text-primary">Thêm Mới</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Họ và tên</th>
                    <th>Hình ảnh</th>
                    <th>Tên đăng nhập</th>
                    <th>Email</th>        
                    <th>Số điện thoại</th>
                    <th>Địa chỉ</th>
                    <th>Ngày tạo</th>
                    <th>Hành động</th>
                  </tr>
                  </thead>
                  <tbody>
                      @foreach($users as $user)
                    <tr>
                        <td>{{ $user->full_name }}</td>
                        <td>
                          @if($user->image)
                            <img src="{{ asset('storage/' . $user->image) }}" alt="User Image" style="width: 50px; height: 50px; object-fit: cover;">
                          @else
                            N/A
                          @endif
                        </td>
                        <td>{{ $user->user_name}}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone }}</td>           
                        <td>{{ Str::limit($user->address, 30, '...') }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td>
                          <a href="{{ route('admin.user.detail', ['id' => $user->id]) }}" class="btn btn-info btn-sm">Chi tiết</a>
                          <a href="{{ route('admin.user.edit', ['id' => $user->id]) }}" class="btn btn-primary btn-sm">Sửa</a>
                          <a href="{{ route('admin.user.delete', ['id' => $user->id]) }}" class="btn btn-danger btn-sm" onclick="return confirm('{{ __('content.user.message.delete.before_question_delete') }}')">Xoá</a>
                        </td>
                    </tr>
                      @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Họ và tên</th>
                    <th>Hình ảnh</th>
                    <th>Tên đăng nhập</th>
                    <th>Email</th>        
                    <th>Số điện thoại</th>
                    <th>Địa chỉ</th>
                    <th>Ngày tạo</th>
                    <th>Hành động</th>
                  </tr>
                  </tfoot>
                </table>
                <div class="d-flex justify-content-between mt-2">
                  {{ $users->links('admin.layout.paginate') }} <!-- Hiển thị phân trang -->
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
