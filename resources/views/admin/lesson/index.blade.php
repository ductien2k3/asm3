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
                <h3 class="card-title">Danh sách danh mục</h3> 
                <a href="{{ route('admin.lessons.create')}}" class=" d-flex justify-content-end text-primary">Thêm Mới</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Course</th>
                    <th>title</th>
                    <th>content</th>
                    <th>Created_at</th>
                    <th>Updated_at</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($lessons as $lesson)
                  <tr>
                    <td>{{  Str::limit($lesson->course ? $lesson->course->title : 'N/A', 30, '...') }}</td>
                        <td>{{ Str::limit($lesson->title, 30, '...') }}</td>
                        <td>{{ Str::limit($lesson->content, 50, '...') }}</td>
                        <td>{{ $lesson->created_at }}</td>
                        <td>{{ $lesson->updated_at }}</td>
                        <td>
                        <a href="{{ route('admin.lessons.detail', ['id' => $lesson->id]) }}" class="btn btn-info btn-sm">Detail</a>
                        <a href="{{ route('admin.lessons.edit', ['id' => $lesson->id]) }}" class="btn btn-primary btn-sm">Edit</a>
                        <a href="{{ route('admin.lessons.delete', ['id' => $lesson->id]) }}" class="btn btn-danger btn-sm" onclick="return confirm('{{ __('content.lesson.message.delete.before_question_delete') }}')">Delete</a>
                    </td>
                  </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Course</th>
                    <th>title</th>
                    <th>content</th>
                    <th>Created_at</th>
                    <th>Updated_at</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
                <div class="d-flex justify-content-between mt-2">
                  {{ $lessons->links('admin.layout.paginate') }}
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
