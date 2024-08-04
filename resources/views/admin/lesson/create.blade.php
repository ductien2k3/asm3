@extends('admin.layout.master_layout')

@push('style')
    <link rel="stylesheet" href="{{ asset('admin/course/select2Custom.css') }}">
@endpush

@section('content')
<div class="wrapper mt-3">
    <div class="content-wrapper p-2">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Thêm mới Bài học</h3>
            </div>
            <form action="{{ route('admin.lessons.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="course_id">Khoá học</label>
                        <select class="form-control select2" name="course_id" id="course_id">
                            <option value="" disabled selected>Vui lòng chọn Khoá học</option>
                            @foreach ($courses as $course)
                                <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>{{ $course->title }}</option>
                            @endforeach
                        </select>
                        @error('course_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="title">Tiêu đề</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Vui lòng nhập tiêu đề" value="{{ old('title') }}">
                        @error('title')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="content">Nội dung</label>
                        <input type="text" class="form-control" id="content" name="content" placeholder="Vui lòng nhập nội dung" value="{{ old('content') }}">
                        @error('content')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="video_type">Loại Video</label>
                        <select class="form-control" id="video_type" name="video_type">
                            <option value="" disabled selected>Chọn loại video</option>
                            <option value="url">URL Video</option>
                            <option value="file">Tệp Video</option>
                        </select>
                    </div>

                    <div id="video_url_container" class="form-group d-none">
                        <label for="video_url">Video URL</label>
                        <input type="text" class="form-control" id="video_url" name="video_url" placeholder="Nhập URL video (YouTube)" value="{{ old('video_url') }}">
                        @error('video_url')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <!-- Phần xem trước video YouTube -->
                        <div id="video_url_preview_container" class="mt-3 d-none">
                            <iframe id="video_url_preview" width="100%" height="400px" src="" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    </div>

                    <div id="video_file_container" class="form-group d-none">
                        <label for="video_file">Video File</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="video_file" name="video_file" accept="video/*">
                                <label class="custom-file-label" for="video_file">Chọn tệp video</label>
                            </div>
                        </div>
                        @error('video_file')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <!-- Phần xem trước video -->
                        <div id="video_file_preview_container" class="mt-3 d-none">
                            <video id="video_file_preview" controls style="width: 100%; max-height: 400px;">
                                Your browser does not support the video tag.
                            </video>
                        </div>
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
        $('#course_id').select2();

        $('#video_type').change(function() {
            var selectedType = $(this).val();
            
            // Làm sạch trường và phần xem trước
            $('#video_url').val('');
            $('#video_file').val('');
            $('#video_url_preview').attr('src', '');
            $('#video_file_preview').attr('src', '');
            $('#video_url_preview_container').addClass('d-none');
            $('#video_file_preview_container').addClass('d-none');
            
            if (selectedType == 'url') {
                $('#video_url_container').removeClass('d-none');
                $('#video_file_container').addClass('d-none');
            } else if (selectedType == 'file') {
                $('#video_file_container').removeClass('d-none');
                $('#video_url_container').addClass('d-none');
            } else {
                $('#video_url_container').addClass('d-none');
                $('#video_file_container').addClass('d-none');
            }
        });

        // Xem trước video tệp khi được chọn
        $('#video_file').change(function(event) {
            var file = event.target.files[0];
            var fileURL = URL.createObjectURL(file);

            $('#video_file_preview').attr('src', fileURL);
            $('#video_file_preview_container').removeClass('d-none');
        });

        // Cập nhật xem trước video YouTube khi URL thay đổi
        $('#video_url').on('input', function() {
            var url = $(this).val();
            var youtubeRegex = /(?:https?:\/\/)?(?:www\.)?youtube\.com\/(?:[^\/\n\s]+\/\S+\/|v\/|embed\/|watch\?v=|watch\?.+&v=)?([^"&?\/\s]{11})/;
            var match = url.match(youtubeRegex);

            if (match) {
                var videoId = match[1];
                var videoURL = 'https://www.youtube.com/embed/' + videoId;
                $('#video_url_preview').attr('src', videoURL);
                $('#video_url_preview_container').removeClass('d-none');
            } else {
                $('#video_url_preview_container').addClass('d-none');
            }
        });
    });
</script>
@endpush
