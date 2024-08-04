@extends('admin.layout.master_layout')

@section('content')
    
<div class="wrapper mt-3">
    <div class="content-wrapper p-2">
        <div class="card ">
            <div class="card-header">
                <h3 class="card-title">Chi tiết danh mục : {{ $category->name }} </h3>
            </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Tên danh mục</label>
                        <input type="text" class="form-control" id="" placeholder="Nhập Tên danh mục" name="name" value="{{ $category->name }}" disabled>
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Miêu tả danh mục</label>
                        <input type="text" class="form-control" id="" placeholder="Nhập miêu tả " name="description" value=" {{ $category->description }}" disabled>
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection
