@extends('admin.master')

@section('content')
    <style>
        .brand-card {
            box-shadow: 0 0 20px rgba(0, 0, 255, 0.2);
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
        <div class="card brand-card w-100" style="min-width: 800px; padding: 40px;">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0" style="padding: 20px"><i class="fa fa-plus-circle"></i> Thêm Brand Mới</h4>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('brand.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="name">Tên Brand</label>
                        <input type="text" name="name" class="form-control" id="name"
                            placeholder="Nhập tên brand">
                    </div>

                    <div class="form-group mb-3">
                        <label for="description">Mô tả</label>
                        <input type="text" name="description" class="form-control" id="description"
                            placeholder="Nhập mô tả">
                    </div>

                    <div class="form-group mb-4">
                        <label for="logo">Logo</label>
                        <input type="file" name="logo" class="form-control" id="logo">
                    </div>

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('brand.index') }}" class="btn btn-secondary me-2">Quay lại</a>
                        <button type="submit" class="btn btn-success">Thêm Brand</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
