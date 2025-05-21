@extends('admin.master')

@section('content')
    <style>
        .category-card {
            box-shadow: 0 0 20px rgba(0, 123, 255, 0.3); /* Red shadow */
            border-radius: 12px;
        }

        .center-wrapper {
            height: 80vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>

    <div class="container center-wrapper">
        <div class="card category-card w-100" style="min-width: 1200px; padding: 50px;">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0" style="padding: 20px"><i class="fa fa-folder-plus"></i> Thêm Danh Mục Mới</h4>
            </div>

            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger mt-3">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('category.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="name">Tên danh mục</label>
                        <input type="text" name="name" id="name"
                               class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name') }}" placeholder="Nhập tên danh mục...">
                        @error('name')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="description">Mô tả</label>
                        <textarea name="description" id="description" rows="4"
                                  class="form-control @error('description') is-invalid @enderror"
                                  placeholder="Nhập mô tả danh mục...">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('category.index') }}" class="btn btn-secondary me-2">Quay lại</a>
                        <button type="submit" class="btn btn-primary">Thêm Danh Mục</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
