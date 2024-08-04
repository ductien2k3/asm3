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
                <a href="{{ route('admin.category.create')}}" class=" d-flex justify-content-end text-primary">Thêm Mới</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Created_at</th>
                    <th>Updated_at</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($categories as $category)
                  <tr>
                    <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ Str::limit($category->description, 50, '...') }}</td>
                        <td>{{ $category->created_at->format('d/m/Y H:i:s') }}</td>
                        <td>{{ $category->updated_at->format('d/m/Y H:i:s') }}</td>
                        <td>
                        <a href="{{ route('admin.category.detail', ['id' => $category->id]) }}" class="btn btn-info btn-sm">Detail</a>
                        <a href="{{ route('admin.category.edit', ['id' => $category->id]) }}" class="btn btn-primary btn-sm">Edit</a>
                        <a href="{{ route('admin.category.delete', ['id' => $category->id]) }}" class="btn btn-danger btn-sm" onclick="return confirm('{{ __('content.category.message.delete.before_question_delete') }}')">Delete</a>
                    </td>
                  </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Created_at</th>
                    <th>Updated_at</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
                <div class="d-flex justify-content-between mt-2">
                  {{ $categories->links('admin.layout.paginate') }}
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
