@extends('admin.master')

@section('content')
    <style>
        .category-card {
            box-shadow: 0 0 20px rgba(0, 123, 255, 0.3);
            border-radius: 12px;
        }

        .center-wrapper {
            height: 80vh;
            padding: 40px 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>

    <div class="container center-wrapper">
        <div class="card category-card w-100" style="min-width: 900px; padding: 30px;">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0" style="padding: 15px"><i class="fa fa-folder"></i> Sửa Danh Mục</h4>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('category.update', $category->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group mb-3">
                        <label for="name">Tên danh mục</label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name', $category->name) }}" placeholder="Nhập tên danh mục...">
                        @error('name')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="description">Mô tả</label>
                        <textarea name="description" id="description" rows="4"
                                  class="form-control @error('description') is-invalid @enderror"
                                  placeholder="Nhập mô tả danh mục...">{{ old('description', $category->description) }}</textarea>
                        @error('description')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <a href="{{ route('category.index') }}" class="btn btn-secondary me-2">Quay lại</a>
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
