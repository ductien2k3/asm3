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
                <h3 class="card-title">Danh sách khoá học</h3> 
                <a href="{{ route('admin.class.create')}}" class="d-flex justify-content-end text-primary">Thêm Mới</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>course</th>
                    <th>title</th>
                    <th>schedule</th>
                    <th>location</th>
                    <th>created_at</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                      @foreach($classes as $class)
                    <tr>
                        <td>{{ Str::limit($class->course ? $class->course->title : 'N/A', 30, '...') }}</td>
                        <td>{{ Str::limit($class->title, 30, '...') }}</td>
                        <td>{{ Str::limit($class->schedule, 30, '...') }}</td>
                        <td>{{ Str::limit($class->location, 30, '...') }}</td>
                        <td>{{ $class->created_at }}</td>
                        <td>
                          <a href="" class="btn btn-info btn-sm">Detail</a>
                          <a href="{{ route('admin.class.edit', ['id' => $class->id]) }}" class="btn btn-primary btn-sm">Edit</a>
                          <a href="{{ route('admin.class.delete', ['id' => $class->id]) }}" class="btn btn-danger btn-sm" onclick="return confirm('{{ __('content.class.message.delete.before_question_delete') }}')">Delete</a>
                        </td>
                    </tr>
                      @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>course</th>
                    <th>title</th>
                    <th>schedule</th>
                    <th>location</th>
                    <th>created_at</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
                <div class="d-flex justify-content-between mt-2">
                  {{ $classes->links('admin.layout.paginate') }} <!-- Hiển thị phân trang -->
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
