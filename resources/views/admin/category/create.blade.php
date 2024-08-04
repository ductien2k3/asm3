@extends('admin.layout.master_layout')

@section('content')
    
<div class="wrapper mt-3">
    <div class="content-wrapper p-2">
        <div class="card ">
            <div class="card-header">
                <h3 class="card-title">Thêm mới danh mục</h3>
            </div>
            <form action="{{ route('admin.category.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Tên danh mục</label>
                        <input type="text" class="form-control" id="" placeholder="Nhập Tên danh mục" name="name" value="{{ old('name')}}" >
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Miêu tả danh mục</label>
                        <input type="text" class="form-control" id="" placeholder="Nhập miêu tả " name="description" value="{{ old('description')}}">
                        @error('description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
