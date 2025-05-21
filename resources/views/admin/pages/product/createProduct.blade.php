@extends('admin.master')

@section('content')
<form method="post" action="{{ route('product.store') }}" enctype="multipart/form-data"
    style="max-width: 800px; box-shadow: 0 3px 10px rgb(0 0 0 / 0.2); margin-top: 80px; padding: 40px;" class="container">
    @csrf

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <h1 class="text-center text-primary">Thêm Sản Phẩm</h1>

    <div class="mb-3">
        <label for="name" class="form-label">Tên sản phẩm</label>
        <input type="text" name="name" class="form-control" id="name" required>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Mô tả</label>
        <textarea name="description" class="form-control" id="description" rows="3"></textarea>
    </div>

    <div class="mb-3">
        <label for="price" class="form-label">Giá</label>
        <input type="number" step="0.01" name="price" class="form-control" id="price" required>
    </div>

    <div class="mb-3">
        <label for="category_id" class="form-label">Danh mục</label>
        <select name="category_id" class="form-control" required>
            <option value="">-- Chọn danh mục --</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="brand_id" class="form-label">Thương hiệu</label>
        <select name="brand_id" class="form-control" required>
            <option value="">-- Chọn thương hiệu --</option>
            @foreach ($brands as $brand)
                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- <div class="mb-3">
        <label for="slide_id" class="form-label">Slide ID (nếu có)</label>
        <input type="number" name="slide_id" class="form-control" id="slide_id">
    </div> -->

    <div class="mb-3">
        <label for="image" class="form-label">Ảnh sản phẩm</label>
        <input type="file" name="image" class="form-control" id="image">
    </div>

    <button type="submit" class="btn btn-primary" style="display: block; margin: 20px auto 0 auto;">Thêm Sản Phẩm</button>
</form>
@endsection
