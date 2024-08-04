@extends('admin.layout.master_layout')
@section('content')
<div class="wrapper mt-3">
    <div class="content-wrapper p-2">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Thêm mới khuyến mãi</h3>
            </div>
            <form action="{{ route('admin.promotion.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="code">Mã khuyến mãi</label>
                        <input type="text" class="form-control" id="code" name="code" placeholder="Nhập mã khuyến mãi" value="{{ old('code', $randomCode) }}" readonly  >
                        @error('code')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Mô tả</label>
                        <textarea class="form-control" id="description" name="description" placeholder="Nhập mô tả">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="discount_percentage">Phần trăm giảm giá</label>
                        <input type="number" class="form-control" id="discount_percentage" name="discount_percentage" placeholder="Nhập phần trăm giảm giá" value="{{ old('discount_percentage') }}">
                        @error('discount_percentage')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="start_date">Ngày bắt đầu</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" value="{{ old('start_date') }}">
                        @error('start_date')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="end_date">Ngày kết thúc</label>
                        <input type="date" class="form-control" id="end_date" name="end_date" value="{{ old('end_date') }}">
                        @error('end_date')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Thêm mới</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

