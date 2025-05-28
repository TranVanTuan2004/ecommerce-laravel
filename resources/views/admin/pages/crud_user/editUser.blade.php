@extends('admin.master')

@section('content')
    <form method="post" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data"
        style="max-width: 800px; box-shadow: 0 3px 10px rgb(0 0 0 / 0.2); margin-top: 80px; padding: 40px;"
        class="container">
        @csrf
        @method('PUT')

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <h1 class="text-center text-primary">Sửa User</h1>

        <div class="mb-3" style="margin-top: 12px">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $user->name) }}">
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3" style="margin-top: 12px">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="email" value="{{ old('email', $user->email) }}">
            @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3" style="margin-top: 12px">
            <label for="password" class="form-label">Password (để trống nếu không đổi)</label>
            <input type="password" name="password" class="form-control" id="password" value="">
            @error('password')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3" style="margin-top: 12px">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control" id="phone" value="{{ old('phone', $user->phone) }}">
            @error('phone')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3" style="margin-top: 12px">
            <label for="address" class="form-label">Address</label>
            <input type="text" name="address" class="form-control" id="address"
                value="{{ old('address', $user->address) }}">
            @error('address')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3" style="margin-top: 12px">
            <label class="form-label">Ảnh đại diện hiện tại:</label><br>
            <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('images/default-avatar.png') }}"
                alt="Avatar" width="150" height="150" style="object-fit: cover; border-radius: 8px; margin-bottom: 10px;">

            <div>
                <label for="avatar" class="form-label">Chọn ảnh mới:</label>
                <input type="file" name="avatar" class="form-control" id="avatar">
                @error('avatar')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-check mt-2">
                <input class="form-check-input" type="checkbox" name="remove_avatar" value="1" id="remove_avatar">
                <label class="form-check-label" for="remove_avatar">
                    Xóa ảnh đại diện hiện tại
                </label>
            </div>
        </div>

        <input type="hidden" name="updated_at" value="{{ $user->updated_at->toIso8601String() }}">

        <button type="submit" class="btn btn-primary" style="display: block; margin: 20px auto 0 auto;">Cập nhật</button>
    </form>
@endsection