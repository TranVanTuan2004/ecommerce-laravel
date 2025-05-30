@extends('client.master')

@section('title', 'Đặt lại mật khẩu')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Đặt lại mật khẩu</h2>

    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif

    <form action="{{ route('password.update') }}" method="POST">
        @csrf

        {{-- Hidden token --}}
        <input type="hidden" name="token" value="{{ $token }}">

        {{-- Trường email --}}
        <div class="mb-3">
            <label for="email" class="form-label">Địa chỉ Email</label>
            <input type="email" name="email" id="email"
                class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email', $email ?? '') }}" required autofocus>

            @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Mật khẩu mới --}}
        <div class="mb-3">
            <label for="password" class="form-label">Mật khẩu mới</label>
            <input type="password" name="password" id="password"
                class="form-control @error('password') is-invalid @enderror"
                >

            @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Xác nhận mật khẩu --}}
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Xác nhận mật khẩu mới</label>
            <input type="password" name="password_confirmation" id="password_confirmation"
                class="form-control @if ($errors->has('password') && str_contains($errors->first('password'), 'khớp')) is-invalid @endif"
                >

            @if ($errors->has('password') && str_contains($errors->first('password'), 'khớp'))
            <div class="invalid-feedback">{{ $errors->first('password') }}</div>
            @endif
        </div>

        <button type="submit" class="btn btn-success">Đặt lại mật khẩu</button>
    </form>
</div>
@endsection