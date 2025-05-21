@extends('admin.master')

@section('content')
    <style>
        .voucher-card {
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
        <div class="card voucher-card w-100" style="min-width: 900px; padding: 30px;">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0" style="padding: 15px"><i class="fa fa-ticket"></i> Sửa Voucher</h4>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('voucher.update', $voucher->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group mb-3">
                        <label for="code">Mã Voucher</label>
                        <input type="text" name="code" id="code" class="form-control"
                            @error('code') is-invalid @enderror value="{{ old('code', $voucher->code) }}"
                            placeholder="Nhập mã voucher...">
                        @error('code')
                            <div class="alert alert-danger" style="margin-top: 8px">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="discount">Giảm Giá (%)</label>
                        <input type="number" name="discount" id="discount" class="form-control"
                            @error('discount') is-invalid @enderror value="{{ old('discount', $voucher->discount) }}"
                            placeholder="Nhập phần trăm giảm giá">
                        @error('discount')
                            <div class="alert alert-danger" style="margin-top: 8px">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="expiration_date">Ngày Kết Thúc</label>
                        <input type="date" name="expiration_date" id="expiration_date" class="form-control"
                            @error('expiration_date') is-invalid @enderror
                            value="{{ old('expiration_date', $voucher->expiration_date ? \Carbon\Carbon::parse($voucher->expiration_date)->format('Y-m-d') : '') }}">
                        @error('expiration_date')
                            <div class="alert alert-danger" style="margin-top: 8px">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <a href="{{ route('voucher.index') }}" class="btn btn-secondary me-2">Quay lại</a>
                        <button type="submit" class="btn btn-success">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
