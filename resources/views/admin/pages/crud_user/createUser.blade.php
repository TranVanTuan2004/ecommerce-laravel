@extends('admin.master')

@section('content')
    <form method="post" action="{{ route('users.store') }}" enctype="multipart/form-data"
        style="max-width: 800px; box-shadow: 0 3px 10px rgb(0 0 0 / 0.2); margin-top: 80px; padding: 40px;"
        class="container">
        @csrf

        <h1 class="text-center text-primary">Thêm User</h1>

        <div class="mb-3" style="margin-top: 12px">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}">
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3" style="margin-top: 12px">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}">
            @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3" style="margin-top: 12px">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="password">
            @error('password')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3" style="margin-top: 12px">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control" id="phone" value="{{ old('phone') }}">
            @error('phone')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3" style="margin-top: 12px">
            <label for="address" class="form-label">Address</label>
            <input type="text" name="address" class="form-control" id="address" value="{{ old('address') }}">
            @error('address')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3" style="margin-top: 12px">
            <label for="avatar" class="form-label">Choose file:</label>
            <input type="file" name="avatar" class="form-control" id="avatar">
            @error('avatar')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" id="submitBtn" class="btn btn-primary"
            style="display: block; margin: 20px auto 0 auto;">Thêm</button>
    </form>
@endsection
<script>
    const form = document.querySelector('form');
    const btn = document.getElementById('submitBtn');

    form.addEventListener('submit', () => {
        btn.disabled = true;
    });
</script>