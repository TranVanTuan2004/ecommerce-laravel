@extends('admin.master')

@section('content')
    <style>
        .voucher-card {
            box-shadow: 0 0 20px rgba(255, 0, 0, 0.3);
            /* Red shadow */
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
        <div class="card voucher-card w-100" style="min-width: 1200px; padding: 50px;">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0" style="padding: 20px"><i class="fa fa-ticket"></i> Tạo Voucher Mới</h4>
            </div>
            <div class="card-body">
                @if (session('error'))
                    <div class="alert alert-danger mt-3">
                        {{ session('error') }}
                    </div>
                @endif
                <form action="{{ route('voucher.store') }}" id="voucher-form" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label>Mã Voucher</label>
                        <input type="text" name="code" class="form-control @error('code') is-invalid @enderror"
                            value="{{ old('code') }}" placeholder="Nhập mã voucher...">
                        @error('code')
                            <div class="alert alert-danger" style="margin-top: 8px">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label>Giảm Giá (%)</label>
                        <input type="number" name="discount" class="form-control @error('discount') is-invalid @enderror"
                            value="{{ old('discount') }}" placeholder="Nhập phần trăm giảm giá">
                        @error('discount')
                            <div class="alert alert-danger" style="margin-top: 8px">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label>Ngày Kết Thúc</label>
                        <input type="date" name="expiration_date"
                            class="form-control @error('expiration_date') is-invalid @enderror"
                            value="{{ old('expiration_date') }}">
                        @error('expiration_date')
                            <div class="alert alert-danger" style="margin-top: 8px">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="d-flex justify-content-end">
                        <a href={{ route('voucher.index') }} class="btn btn-secondary me-2">Quay lại</a>
                        <button type="submit" id="submit-btn" class="btn btn-success">Tạo Voucher</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('voucher-form').addEventListener('submit', function(e) {
            const btn = document.getElementById('submit-btn');
            btn.disabled = true;
            btn.innerText = 'Đang xử lý...';
        });
    </script>
@endsection
