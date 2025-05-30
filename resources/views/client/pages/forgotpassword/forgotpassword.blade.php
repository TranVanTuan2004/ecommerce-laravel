@extends('client.master')

@section('title', 'Quên mật khẩu')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Quên mật khẩu</h2>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form action="{{ route('password.email') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Địa chỉ Email</label>
            <input type="email" name="email" id="email"
                   class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email') }}" required autofocus>

            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Gửi liên kết đặt lại mật khẩu</button>
    </form>
</div>
@endsection
