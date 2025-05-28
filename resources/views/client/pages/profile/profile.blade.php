@extends('client.master')

@section('content')

<style>
    .profile-section {
        display: flex;
        gap: 40px;
        align-items: flex-start;
        margin-top: 30px;
    }

    /* Bên trái: Ảnh đại diện */
    .avatar-upload {
        flex: 1;
        max-width: 300px;
        text-align: center;
        background-color: #f9f9f9;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
    }

    .avatar-upload img.profile-pic {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 10px;
        border: 3px solid #3498db;
    }

    .avatar-upload p {
        font-size: 13px;
        color: #777;
        margin-bottom: 10px;
    }

    /* Bên phải: Thông tin tài khoản */
    .account-info {
        flex: 2;
        background-color: #fff;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
    }

    .avatar-upload button {
        display: block;
        width: 100%;
        margin-top: 10px;
    }

    .avatar-upload .btn-warning {
        margin-top: 10px;
    }


    /* Các form dùng chung */
    form label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
        color: #333;
    }

    form input[type="text"],
    form input[type="email"],
    form input[type="password"],
    form input[type="file"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 14px;
    }

    form input:focus {
        border-color: #3498db;
        outline: none;
    }

    form button {
        padding: 10px 16px;
        border: none;
        border-radius: 6px;
        font-size: 15px;
        font-weight: 500;
        cursor: pointer;
    }

    .btn-success {
        background-color: #2ecc71;
        color: #fff;

    }

    .btn-success:hover {
        background-color: #27ae60;
    }

    .btn-warning {
        background-color: #f39c12;
        color: white;
    }

    .btn-warning:hover {
        background-color: #e67e22;
    }

    /* Đổi mật khẩu */
    #passwordForm {
        margin-top: 30px;
        padding: 20px;
        background-color: #fdfdfd;
        border: 1px solid #eee;
        border-radius: 10px;
    }

    /* Responsive cho mobile */
    @media (max-width: 768px) {
        .profile-section {
            flex-direction: column;
        }

        .avatar-upload,
        .account-info {
            max-width: 100%;
        }
    }
</style>


<div class="container">
    <h2>Thông tin tài khoản</h2>

    <div class="profile-section">
        <div class="avatar-upload text-center">

            {{-- Hiển thị ảnh đại diện --}}
            <img src="{{ asset($user->avatar ?? 'images/default-avatar.png') }}"
                alt="Ảnh đại diện"
                class="profile-pic mb-2"
                style="width: 160px; height: 160px; object-fit: cover; border-radius: 50%; border: 2px solid #ccc;"><br>

            {{-- Hiển thị lỗi nếu có --}}
            @if ($errors->has('avatar'))
            <div class="alert alert-danger mt-1">{{ $errors->first('avatar') }}</div>
            @endif

            {{-- Hiển thị thông báo thành công nếu có --}}
            @if (session('success'))
            <div class="alert alert-success mt-1">{{ session('success') }}</div>
            @endif

            {{-- Form tải ảnh --}}
            <form method="POST" action="{{ route('auth.profile.uploadAvatar') }}" enctype="multipart/form-data" class="mt-2">
                @csrf
                <input type="file" name="avatar" accept="image/*" class="form-control mb-2" required>
                <button type="submit" class="btn btn-success">Tải ảnh lên</button>
            </form>

            <button id="changePasswordBtn" class="btn btn-warning mt-2">Đổi mật khẩu</button>

        </div>


        <div class="account-info">
            <form method="POST" action="{{ route('auth.profile.update') }}">
                @csrf
                @method('PUT')

                <label for="name">Họ và tên:</label>
                <input type="text" id="name" name="name" value="{{ old('name', Auth::user()->name) }}">
                @error('name')
                <p class="text-danger">{{ $message }}</p>
                @enderror

                <label for="address">Địa chỉ:</label>
                <input type="text" id="address" name="address" value="{{ old('address', Auth::user()->address) }}">
                @error('address')
                <p class="text-danger">{{ $message }}</p>
                @enderror

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="{{ Auth::user()->email }}" readonly class="form-control text-muted">
                @error('email')
                <p class="text-danger">{{ $message }}</p>
                @enderror

                <label for="phone">Số điện thoại:</label>
                <input type="text" id="phone" name="phone" value="{{ old('phone', Auth::user()->phone) }}">
                @error('phone')
                <p class="text-danger">{{ $message }}</p>
                @enderror

                <button type="submit" class="btn btn-success">Cập nhật thông tin</button>
            </form>

        </div>
    </div>

    <hr>

    <form method="POST" action="{{ route('auth.profile.changePassword') }}" id="passwordForm" style="display: none;">
        @csrf
        @method('PUT')

        <label for="old_password">Mật khẩu cũ:</label>
        <input type="password" id="old_password" name="old_password">
        @error('old_password')
        <span class="text-danger">{{ $message }}</span>
        @enderror

        <label for="new_password">Mật khẩu mới:</label>
        <input type="password" id="new_password" name="new_password">
        @error('new_password')
        <span class="text-danger">{{ $message }}</span>
        @enderror

        <button type="submit" style="display: block;" class="btn btn-success">Thay đổi</button>
    </form>

</div>

<script>
    document.getElementById('changePasswordBtn').addEventListener('click', function() {
        const form = document.getElementById('passwordForm');
        form.style.display = form.style.display === 'none' ? 'block' : 'none';
    });

    // Luôn giữ form mở nếu có lỗi nhập liệu
    window.onload = function() {
        if (document.querySelector('.text-danger')) {
            document.getElementById('passwordForm').style.display = 'block';
        } else if (document.querySelector('.alert-success')) {
            setTimeout(() => {
                document.getElementById('passwordForm').style.display = 'none';
            }, 3000);
        }
    };
</script>

@endsection