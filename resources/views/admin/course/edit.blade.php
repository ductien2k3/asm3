@extends('admin.layout.master_layout')
@push('style')
    <link rel="stylesheet" href="{{ asset('admin/course/select2Custom.css') }}">
@endpush
@section('content')
<div class="wrapper mt-3">
    <div class="content-wrapper p-2">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Chỉnh sửa khoá học</h3>
            </div>
            <form action="{{ route('admin.courses.update', $course->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <!-- Danh mục -->
                    <div class="form-group">
                        <label for="category">Danh mục</label>
                        <select class="form-control select2" name="category_id" id="category_id">
                            <option value="" disabled selected>Vui lòng chọn danh mục</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $course->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Tiêu đề -->
                    <div class="form-group">
                        <label for="title">Tiêu đề</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $course->title) }}">
                        @error('title')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Ảnh -->
                    <div class="form-group">
                        <label for="image">Ảnh</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" name="image" value="{{ old('price', $course->image) }} " >
                                <label class="custom-file-label" for="image">Chọn tệp</label>
                            </div>
                        </div>
                        <div class="mt-3">
                            @if($course->image)
                                <img id="preview-image" src="{{ asset('storage/' . $course->image) }}" alt="Ảnh khóa học" style="max-width: 300px; max-height: 300px;" />
                            @else
                                <img id="preview-image" src="#" alt="Ảnh sẽ hiển thị ở đây" style="display: none; max-width: 300px; max-height: 300px;" />
                            @endif
                        </div>
                        @error('image')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Mô tả -->
                    <div class="form-group">
                        <label for="description">Mô tả</label>
                        <textarea class="form-control" id="description" name="description">{{ old('description', $course->description) }}</textarea>
                    </div>
                    <!-- Giá -->
                    <div class="form-group">
                        <label for="price">Giá</label>
                        <input type="text" class="form-control" id="price" name="price" value="{{ old('price', $course->price) }}">
                        @error('price')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Địa điểm -->
                    <div class="form-group">
                        <label for="location">Địa điểm</label>
                        <input type="text" class="form-control" id="location" name="location" value="{{ old('location', $course->location) }}">
                        @error('location')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Lịch học -->
                    <div class="form-group">
                        <label for="schedule">Lịch học</label>
                        <select class="form-control select2" name="schedule" id="schedule">
                            <option value="" disabled selected>Vui lòng chọn lịch học</option>
                            <option value="1" {{ old('schedule', $course->schedule) == '1' ? 'selected' : '' }}>1</option>
                            <option value="2" {{ old('schedule', $course->schedule) == '2' ? 'selected' : '' }}>2</option>
                        </select>
                    </div>
                    <!-- Thời gian bắt đầu -->
                    <div class="form-group">
                        <label for="start_date">Thời gian bắt đầu</label>
                        <input type="datetime-local" class="form-control" id="start_date" name="start_date" value="{{ old('start_date', \App\Helpers\DateTimeHelper::formatForDateTimeLocal($course->start_date)) }}">
                        @error('start_date')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Thời gian kết thúc -->
                    <div class="form-group">
                        <label for="end_date">Thời gian kết thúc</label>
                        <input type="datetime-local" class="form-control" id="end_date" name="end_date" value="{{ old('end_date', \App\Helpers\DateTimeHelper::formatForDateTimeLocal($course->end_date)) }}">
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
                $('#preview-image').attr('src', e.target.result).show();
            };
            reader.readAsDataURL(event.target.files[0]);
        });
    });
</script>
@endpush
