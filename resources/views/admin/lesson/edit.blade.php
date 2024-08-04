@extends('admin.layout.master_layout')

@push('style')
    <link rel="stylesheet" href="{{ asset('admin/course/select2Custom.css') }}">
@endpush

@section('content')
<div class="wrapper mt-3">
    <div class="content-wrapper p-2">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Chỉnh sửa Bài học</h3>
            </div>
            <form action="{{ route('admin.lessons.update', $lesson->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="course_id">Khoá học</label>
                        <select class="form-control select2" name="course_id" id="course_id">
                            <option value="" disabled>Vui lòng chọn Khoá học</option>
                            @foreach ($courses as $course)
                                <option value="{{ $course->id }}" {{ $lesson->course_id == $course->id ? 'selected' : '' }}>{{ $course->title }}</option>
                            @endforeach
                        </select>
                        @error('course_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="title">Tiêu đề</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Vui lòng nhập tiêu đề" value="{{ old('title', $lesson->title) }}">
                        @error('title')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="content">Nội dung</label>
                        <input type="text" class="form-control" id="content" name="content" placeholder="Vui lòng nhập nội dung" value="{{ old('content', $lesson->content) }}">
                        @error('content')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="video_type">Loại Video</label>
                        <select class="form-control" id="video_type" name="video_type">
                            <option value="" disabled>Chọn loại video</option>
                            <option value="url" {{ $lesson->video_url && !str_contains($lesson->video_url, 'storage') ? 'selected' : '' }}>URL Video</option>
                            <option value="file" {{ $lesson->video_url && str_contains($lesson->video_url, 'storage') ? 'selected' : '' }}>Tệp Video</option>
                        </select>
                    </div>
                    <div id="video_url_container" class="form-group {{ $lesson->video_url && !str_contains($lesson->video_url, 'storage') ? '' : 'd-none' }}">
                        <label for="video_url">Video URL</label>
                        <input type="text" class="form-control" id="video_url" name="video_url" placeholder="Nhập URL video (YouTube)" value="{{ old('video_url', $lesson->video_url) }}">
                        @error('video_url')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div id="video_url_preview_container" class="mt-3 {{ $lesson->video_url && !str_contains($lesson->video_url, 'storage') ? '' : 'd-none' }}">
                            <iframe id="video_url_preview" width="100%" height="315" src=""></iframe>
                        </div>
                    </div>
                    <div id="video_file_container" class="form-group {{ $lesson->video_url && str_contains($lesson->video_url, 'storage') ? '' : 'd-none' }}">
                        <label for="video_file">Video File</label>
                        <div class="input-group">
                            <input type="file" class="custom-file-input" id="video_file" name="video_file" accept="video/*">
                            <label class="custom-file-label" for="video_file">Chọn tệp video</label>
                        </div>
                        @error('video_file')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div id="video_file_preview_container" class="mt-3 {{ $lesson->video_url && str_contains($lesson->video_url, 'storage') ? '' : 'd-none' }}">
                            <video id="video_file_preview" width="100%" height="315" controls>
                                <source src="{{ Storage::url($lesson->video_url) }}" type="video/mp4">
                            </video>
                        </div>
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
    $('#course_id').select2();

    function updateVideoContainers() {
        var selectedType = $('#video_type').val();
        // Ẩn tất cả các phần tử video và reset giá trị
        $('#video_url_container, #video_file_container').addClass('d-none');
        $('#video_url').val('');
        $('#video_file').val('');
        $('#video_url_preview').attr('src', '');
        $('#video_file_preview').removeAttr('src'); // Loại bỏ src cho video preview
        $('#video_url_preview_container').addClass('d-none');
        $('#video_file_preview_container').addClass('d-none');

        // Hiển thị phần tử phù hợp dựa trên loại video được chọn
        if (selectedType === 'url') {
            $('#video_url_container').removeClass('d-none');
        } else if (selectedType === 'file') {
            $('#video_file_container').removeClass('d-none');
        }
    }

    $('#video_type').change(function() {
        updateVideoContainers();
    });

    $('#video_file').change(function(event) {
        var file = event.target.files[0];
        if (file) {
            var fileURL = URL.createObjectURL(file);
            $('#video_file_preview').attr('src', fileURL);
            $('#video_file_preview').attr('controls', 'controls'); // Thêm thuộc tính controls cho video
            $('#video_file_preview_container').removeClass('d-none');
            $('#video_url_preview_container').addClass('d-none'); // Ẩn phần xem trước URL video nếu có
        } else {
            $('#video_file_preview_container').addClass('d-none');
        }
    });

    $('#video_url').on('input', function() {
        var url = $(this).val();
        var youtubeRegex = /(?:https?:\/\/)?(?:www\.)?youtube\.com\/(?:[^\/\n\s]+\/\S+\/|v\/|embed\/|watch\?v=|watch\?.+&v=)?([^"&?\/\s]{11})/;
        var match = url.match(youtubeRegex);

        if (match) {
            var videoId = match[1];
            var videoURL = 'https://www.youtube.com/embed/' + videoId;
            $('#video_url_preview').attr('src', videoURL);
            $('#video_url_preview_container').removeClass('d-none');
            $('#video_file_preview_container').addClass('d-none'); // Ẩn phần xem trước tệp video nếu có
        } else {
            $('#video_url_preview_container').addClass('d-none');
        }
    });

    // Khởi tạo trạng thái ban đầu của form
    var videoUrl = "{{  Storage::url($lesson->video_url) }} "; 

    var videoYtb = "{{ ($lesson->video_url) }} ";

    if (videoUrl) {
        // Nếu video là file lưu trong storage
        if (videoUrl.includes('storage')) {
            $('#video_type').val('file').change(); // Thay đổi chọn 'file'
            $('#video_file_preview').attr('src', "{{ Storage::url($lesson->video_url) }}");
            $('#video_file_preview').attr('controls', 'controls'); // Thêm thuộc tính controls cho video
            $('#video_file_preview_container').removeClass('d-none');
            $('#video_url_preview_container').addClass('d-none'); // Ẩn phần xem trước URL video nếu có
        }
        // Nếu video là URL YouTube
        if (videoYtb.includes('youtube.com')) {
            $('#video_type').val('url').change(); // Thay đổi chọn 'url'
            $('#video_url').val(videoYtb).trigger('input'); // Cập nhật và kích hoạt input event
        } 
        // Xử lý các đường dẫn video khác nếu cần
        else {
            $('#video_type').val('file').change();
            $('#video_file_preview').attr('src', videoUrl);
            $('#video_file_preview').attr('controls', 'controls'); // Thêm thuộc tính controls cho video
            $('#video_file_preview_container').removeClass('d-none');
            $('#video_url_preview_container').addClass('d-none'); // Ẩn phần xem trước URL video nếu có
        }
    } else {
        // Khi không có videoUrl, ẩn tất cả các phần tử video
        $('#video_url_container, #video_file_container').addClass('d-none');
    }
});

</script>
@endpush
