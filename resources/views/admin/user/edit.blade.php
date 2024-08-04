@extends('admin.layout.master_layout')
@section('content')
<div class="wrapper mt-3">
    <div class="content-wrapper p-2">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Chỉnh sửa người dùng</h3>
            </div>
            <form action="{{ route('admin.user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="user_name">Tên người dùng</label>
                        <input type="text" class="form-control" id="user_name" name="user_name" placeholder="Nhập tên người dùng" value="{{ old('user_name', $user->user_name) }}">
                        @error('user_name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email" value="{{ old('email', $user->email) }}">
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Mật khẩu</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu">
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="full_name">Họ và tên</label>
                        <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Nhập họ và tên" value="{{ old('full_name', $user->full_name) }}">
                        @error('full_name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="gender">Giới tính</label>
                        <select class="form-control" id="gender" name="gender">
                            <option value="" disabled>Chọn giới tính</option>
                            <option value="1" {{ old('gender', $user->gender) == '1' ? 'selected' : '' }}>Nam</option>
                            <option value="0" {{ old('gender', $user->gender) == '0' ? 'selected' : '' }}>Nữ</option>
                        </select>
                        @error('gender')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="phone">Số điện thoại</label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Nhập số điện thoại" value="{{ old('phone', $user->phone) }}">
                        @error('phone')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                   <div class="form-group">
                        <label for="image">Ảnh</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" name="image" value="{{ old('price', $user->image) }} " >
                                <label class="custom-file-label" for="image">Chọn tệp</label>
                            </div>
                        </div>
                        <div class="mt-3">
                            @if($user->image)
                                <img id="preview-image" src="{{ asset('storage/' . $user->image) }}" alt="Ảnh khóa học" style="max-width: 300px; max-height: 300px;" />
                            @else
                                <img id="preview-image" src="#" alt="Ảnh sẽ hiển thị ở đây" style="display: none; max-width: 300px; max-height: 300px;" />
                            @endif
                        </div>
                        @error('image')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="address">Địa chỉ</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="Nhập địa chỉ" value="{{ old('address', $user->address) }}">
                        @error('address')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Mô tả</label>
                        <textarea class="form-control" id="description" name="description" placeholder="Nhập mô tả">{{ old('description', $user->description) }}</textarea>
                        @error('description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="gender">Quyền</label>
                        <select class="form-control" id="role_id" name="role_id">
                            <option value="" disabled>Chọn quyền</option>
                            <option value="1" {{ old('role_id', $user->role_id) == '1' ? 'selected' : '' }}>User</option>
                            <option value="2" {{ old('role_id', $user->role_id) == '2' ? 'selected' : '' }}>User_admin</option>
                            <option value="3" {{ old('role_id', $user->role_id) == '3' ? 'selected' : '' }}>System_admin</option>
                            <option value="4" {{ old('role_id', $user->role_id) == '4' ? 'selected' : '' }}>Super_admin</option>
                        </select>
                        @error('gender')
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
