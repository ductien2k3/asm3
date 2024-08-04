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
                <a href="{{ route('admin.courses.create')}}" class=" d-flex justify-content-end text-primary">Thêm Mới</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>category</th>
                    <th>title</th>
                    <th>image</th>
                    <th>price</th>
                    <th>location</th>
                    <th>start_date</th>
                    <th>end_date</th>
                    <th>ACtion</th>
                  </tr>
                  </thead>
                  <tbody>
                      @foreach($courses as $course)
                    <tr>
                        <td>{{ $course->category ? $course->category->name : 'N/A' }}</td>
                        <td>{{ Str::limit($course->title, 30, '...') }}</td>
                        <td><img src="{{ asset('storage/' . $course->image) }}" width="50" height="50"></td>
                        <td>{{ $course->price }}</td>
                        <td>{{ Str::limit($course->location, 30, '...') }}</td>
                        <td>{{ $course->start_date }}</td>
                        <td>{{ $course->end_date }}</td>
                        <td>
                          <a href="" class="btn btn-info btn-sm">Detail</a>
                          <a href="{{ route('admin.courses.edit', ['id' => $course->id]) }}" class="btn btn-primary btn-sm">Edit</a>
                          <a href="{{ route('admin.courses.delete', ['id' => $course->id]) }}" class="btn btn-danger btn-sm" onclick="return confirm('{{ __('content.course.message.delete.before_question_delete') }}')">Delete</a>
                        </td>
                    </tr>
                      @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>category_id</th>
                    <th>title</th>
                    <th>price</th>
                    <th>location</th>
                    <th>schedule</th>
                    <th>start_date</th>
                    <th>end_date</th>
                  </tr>
                  </tfoot>
                </table>
                <div class="d-flex justify-content-between mt-2">
                  {{ $courses->links('admin.layout.paginate') }}
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
