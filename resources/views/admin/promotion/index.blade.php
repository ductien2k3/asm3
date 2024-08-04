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
                <h3 class="card-title">Danh sách khuyến mãi</h3> 
                <a href="{{ route('admin.promotion.create')}}" class="d-flex justify-content-end text-primary">Thêm Mới</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Mã khuyến mãi</th>
                    <th>Mô tả</th>
                    <th>Phần trăm giảm giá</th>
                    <th>Ngày bắt đầu</th>
                    <th>Ngày kết thúc</th>
                    <th>Ngày tạo</th>
                    <th>Hành động</th>
                  </tr>
                  </thead>
                  <tbody>
                      @foreach($promotions as $promotion)
                    <tr>
                        <td>{{ Str::limit($promotion->code, 30, '...') }}</td>
                        <td>{{ Str::limit($promotion->description, 30, '...') }}</td>
                        <td>{{ $promotion->discount_percentage }}%</td>
                        <td>{{ $promotion->start_date }}</td>
                        <td>{{ $promotion->end_date }}</td>
                        <td>{{ $promotion->created_at }}</td>
                        <td>
                          <a href="{{ route('admin.promotion.detail', ['id' => $promotion->id]) }}" class="btn btn-info btn-sm">Chi tiết</a>
                          <a href="{{ route('admin.promotion.edit', ['id' => $promotion->id]) }}" class="btn btn-primary btn-sm">Sửa</a>
                          <a href="{{ route('admin.promotion.delete', ['id' => $promotion->id]) }}" class="btn btn-danger btn-sm" onclick="return confirm('{{ __('content.promotion.message.delete.before_question_delete') }}')">Xoá</a>
                        </td>
                    </tr>
                      @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Mã khuyến mãi</th>
                    <th>Mô tả</th>
                    <th>Phần trăm giảm giá</th>
                    <th>Ngày bắt đầu</th>
                    <th>Ngày kết thúc</th>
                    <th>Ngày tạo</th>
                    <th>Hành động</th>
                  </tr>
                  </tfoot>
                </table>
                <div class="d-flex justify-content-between mt-2">
                  {{ $promotions->links('admin.layout.paginate') }} <!-- Hiển thị phân trang -->
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
