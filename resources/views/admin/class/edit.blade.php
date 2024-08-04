@extends('admin.layout.master_layout')
@push('style')
    <link rel="stylesheet" href="{{ asset('admin/course/select2Custom.css') }}">
@endpush
@section('content')
<div class="wrapper mt-3">
    <div class="content-wrapper p-2">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Cập nhật lớp học</h3>
            </div>
            <form action="{{ route('admin.class.update', $class->id) }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="course_id">Khoá học</label>
                        <select class="form-control select2" name="course_id" id="course_id">
                            <option value="" disabled selected>Vui lòng chọn khoá học</option>
                            @foreach ($courses as $course)
                                <option value="{{ $course->id }}" {{ old('course_id', $class->course_id) == $course->id ? 'selected' : '' }}>{{ $course->title }}</option>
                            @endforeach
                        </select>
                        @error('course_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="title">Tiêu đề</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Nhập tiêu đề" value="{{ old('title', $class->title) }}">
                        @error('title')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="schedule">Lịch học</label>
                        <select class="form-control select2" name="schedule" id="schedule">
                            <option value="" disabled selected>Vui lòng chọn lịch học</option>
                            <option value="1" {{ old('schedule', $class->schedule) == '1' ? 'selected' : '' }}>1</option>
                            <option value="2" {{ old('schedule', $class->schedule) == '2' ? 'selected' : '' }}>2</option>
                        </select>
                        @error('schedule')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="location">Địa điểm</label>
                        <input type="text" class="form-control" id="location" name="location" placeholder="Nhập địa điểm" value="{{ old('location', $class->location) }}">
                        @error('location')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#course_id, #schedule').select2();
    });
</script>
@endpush
