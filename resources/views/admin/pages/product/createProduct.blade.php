@extends('admin.master')

@section('content')
<form method="post" action="{{ route('product.store') }}" enctype="multipart/form-data"
    style="max-width: 800px; box-shadow: 0 3px 10px rgb(0 0 0 / 0.2); margin-top: 30px; padding: 40px;" class="container">
    @csrf

    <h1 class="text-center text-primary">Thêm Sản Phẩm</h1>

    <div class="mb-3">
        <label for="name" class="form-label">Tên sản phẩm</label>
        <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}">
        @error('name')
    <div class="text-danger">{{ $message }}</div>
    @enderror
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Mô tả</label>
        <textarea name="description" class="form-control" value="{{ old('description') }}" id="description" rows="3"></textarea>
        @error('description')
    <div class="text-danger">{{ $message }}</div>
    @enderror
    </div>

    <div class="mb-3">
        <label for="price" class="form-label">Giá</label>
        <input type="number" step="0.01" name="price"  class="form-control" value="{{ old('price') }}" id="price">
        @error('price')
    <div class="text-danger">{{ $message }}</div>
    @enderror
    </div>

    <div class="mb-3">
        <label for="category_id" class="form-label">Danh mục</label>
        <select name="category_id" class="form-control">
            <option value="">-- Chọn danh mục --</option>
            @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        @error('category_id')
    <div class="text-danger">{{ $message }}</div>
    @enderror
    </div>

    <div class="mb-3">
        <label for="brand_id" class="form-label">Thương hiệu</label>
        <select name="brand_id" class="form-control">
            <option value="">-- Chọn thương hiệu --</option>
            @foreach ($brands as $brand)
            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
            @endforeach
        </select>
        @error('brand_id')
    <div class="text-danger">{{ $message }}</div>
    @enderror
    </div>

    <!-- <div class="mb-3">
        <label for="slide_id" class="form-label">Slide ID (nếu có)</label>
        <input type="number" name="slide_id" class="form-control" id="slide_id">
    </div> -->

    <div class="mb-3">
        <label for="image" class="form-label">Ảnh sản phẩm</label>
        <input type="file" name="image" class="form-control" id="image">
        @error('image')
    <div class="text-danger">{{ $message }}</div>
    @enderror
    </div>

    <button type="submit" class="btn btn-primary" style="display: block; margin: 20px auto 0 auto;">Thêm Sản Phẩm</button>
</form>
@endsection