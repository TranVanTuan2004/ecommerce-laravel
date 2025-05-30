@extends('admin.master')

@section('content')
<h2>Chỉnh sửa sản phẩm: {{ $product->name }}</h2>
<form method="POST" action="{{ route('product.update', $product->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <label>Tên:</label>
    <input type="text" name="name" value="{{ old('name', $product->name) }}" class="form-control">
    @error('name')
    <div class="text-danger">{{ $message }}</div>
    @enderror

    <label>Mô tả:</label>
    <textarea name="description" class="form-control">{{ old('description', $product->description) }}</textarea>
    @error('description')
    <div class="text-danger">{{ $message }}</div>
    @enderror

    <label>Giá:</label>
    <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" class="form-control">
    @error('price')
    <div class="text-danger">{{ $message }}</div>
    @enderror

    <label>Danh mục:</label>
    <select name="category_id" class="form-control">
        <option value="">-- Chọn danh mục --</option>
        @foreach ($categories as $category)
        <option value="{{ $category->id }}" {{ (old('category_id', $product->category_id) == $category->id) ? 'selected' : '' }}>
            {{ $category->name }}
        </option>
        @endforeach
    </select>
    @error('category_id')
    <div class="text-danger">{{ $message }}</div>
    @enderror

    <label>Thương hiệu:</label>
    <select name="brand_id" class="form-control">
        <option value="">-- Chọn thương hiệu --</option>
        @foreach ($brands as $brand)
        <option value="{{ $brand->id }}" {{ (old('brand_id', $product->brand_id) == $brand->id) ? 'selected' : '' }}>
            {{ $brand->name }}
        </option>
        @endforeach
    </select>
    @error('brand_id')
    <div class="text-danger">{{ $message }}</div>
    @enderror

    <!-- <label>Slide ID (nếu có):</label>
        <input type="number" name="slide_id" value="{{ old('slide_id', $product->slide_id) }}" class="form-control"> -->

    <label>Ảnh hiện tại:</label>
    <div class="mb-2">
        @if ($product->image)
        <img src="{{ asset($product->image) }}" alt="Ảnh" width="50">
        @else
        Không có ảnh
        @endif
    </div>

    <label>Thay ảnh mới:</label>
    <input type="file" name="image" class="form-control">
    @error('image')
    <div class="text-danger">{{ $message }}</div>
    @enderror
    <button type="submit" class="btn btn-primary mt-3">Cập nhật</button>
</form>
@endsection