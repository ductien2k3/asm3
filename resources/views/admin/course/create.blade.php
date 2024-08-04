@extends('admin.layout.master_layout')
@push('style')
    <link rel="stylesheet" href="{{ asset('admin/course/select2Custom.css') }}">
@endpush
@section('content')
<div class="wrapper mt-3">
    <div class="content-wrapper p-2">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Thêm mới khoá học</h3>
            </div>
            <form action="{{ route('admin.courses.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="category">Danh mục</label>
                        <select class="form-control select2" name="category_id" id="category_id">
                            <option value="" disabled selected>Vui lòng chọn danh mục</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="title">Tiêu đề</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="" value="{{ old('title')}}" >
                        @error('title')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="image">Ảnh</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" name="image" value="{{ old('image')}}">
                                <label class="custom-file-label" for="image">Chọn tệp</label>
                            </div>
                    </div>
                    <div class="mt-3">
                        <img id="preview-image" src="#" alt="Ảnh sẽ hiển thị ở đây" style="display: none; max-width: 300px; max-height: 300px;" />
                    </div>
                    @error('image')
                            <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label for="description">Mô tả</label>
                        <textarea class="form-control" id="description" name="description" placeholder=" vui lòng nhập">{{ old('description')}}</textarea>
                    </div>
                    @error('description')
                            <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label for="price">Giá</label>
                        <input type="text" class="form-control" id="price" name="price" placeholder="" value="{{ old('price')}} ">
                        @error('price')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="location">Địa điểm</label>
                        <input type="text" class="form-control" id="location" name="location" placeholder="" value="{{ old('location')}} ">
                        @error('location')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="schedule">Lịch học</label>
                        <select class="form-control select2" name="schedule" id="schedule">
                            <option value="" disabled selected>Vui lòng chọn lịch học</option>
                            <option value="1" {{ old('schedule') == '1' ? 'selected' : '' }}>1</option>
                            <option value="2" {{ old('schedule') == '2' ? 'selected' : '' }}>2</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="start_date">Thời gian bắt đầu</label>
                        <input type="datetime-local" class="form-control" id="start_date" name="start_date" value="{{ DateTimeHelper::formatForDateTimeLocal(old('start_date')) }}">
                        @error('start_date')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="end_date">Thời gian kết thúc</label>
                        <input type="datetime-local" class="form-control" id="end_date" name="end_date" value="{{ DateTimeHelper::formatForDateTimeLocal(old('end_date')) }}">
                        @error('end_date')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        $('#category_id, #schedule').select2();

        $('#image').change(function(event) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#preview-image').attr('src', e.target.result);
                $('#preview-image').show();
            };
            reader.readAsDataURL(event.target.files[0]);
        });
    });
</script>
@endpush