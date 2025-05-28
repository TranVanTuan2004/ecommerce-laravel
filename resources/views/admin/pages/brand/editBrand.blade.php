@extends('admin.master')

@section('content')
    <style>
        .voucher-card {
            box-shadow: 0 0 20px rgba(0, 123, 255, 0.3);
            border-radius: 12px;
        }

        .center-wrapper {
            height: auto;
            padding: 40px 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>

    <div class="container center-wrapper">
        <div class="card voucher-card w-100" style="min-width: 900px; padding: 30px;">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0" style="padding: 15px"><i class="fa fa-pencil"></i> Sửa Brand</h4>
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

                <form method="POST" id="brand-form" action="{{ route('brand.update', $brand->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="updated_at" value="{{ $brand->updated_at }}">
                    <div class="form-group mb-3">
                        <label for="name">Tên Brand</label>
                        <input type="text" name="name" id="name" class="form-control"
                            value="{{ old('name', $brand->name) }}" placeholder="Nhập tên brand...">
                    </div>

                    <div class="form-group mb-3">
                        <label for="description">Mô tả</label>
                        <input type="text" name="description" id="description" class="form-control"
                            value="{{ old('description', $brand->description) }}" placeholder="Nhập mô tả...">
                    </div>

                    <div class="form-group mb-3">
                        <label for="logo">Logo</label>
                        <input type="file" name="logo" id="logo" class="form-control">
                        @if ($brand->logo)
                            <div class="mt-3">
                                <img src="{{ asset('storage/' . $brand->logo) }}" alt="Logo"
                                    style="width: 100px; height: 100px; object-fit: cover; border-radius: 6px;">
                            </div>
                        @endif
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <a href="{{ route('brand.index') }}" class="btn btn-secondary me-2">Quay lại</a>
                        <button type="submit" id="submit-btn" class="btn btn-success">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('brand-form').addEventListener('submit', function(e) {
            const btn = document.getElementById('submit-btn');
            btn.disabled = true;
            btn.innerText = 'Đang xử lý...';
        });
    </script>
@endsection
