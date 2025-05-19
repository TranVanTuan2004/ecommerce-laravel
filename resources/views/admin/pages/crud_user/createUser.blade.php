@extends('admin.master')

@section('content')
    <form method="post" action={{ route('users.store') }} enctype="multipart/form-data"
        style="max-width: 800px; box-shadow: 0 3px 10px rgb(0 0 0 / 0.2); margin-top: 80px; padding: 40px;"
        class="container">
        @csrf

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <h1 class="text-center text-primary">Thêm User</h1>
        <div class="mb-3" style="margin-top: 12px">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" id="name">
        </div>
        <div class="mb-3" style="margin-top: 12px">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="email">
        </div>
        <div class="mb-3" style="margin-top: 12px">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="password">
        </div>
        <div class="mb-3" style="margin-top: 12px">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control" id="phone">
        </div>
        <div class="mb-3" style="margin-top: 12px">
            <label for="address" class="form-label">Address</label>
            <input type="text" name="address" class="form-control" id="address">
        </div>
        <div class="mb-3" style="margin-top: 12px">
            <label for="avatar" class="form-label">Choose file:</label>
            <input type="file" name="avatar" class="form-control" id="avatar">
        </div>
        <button type="submit" class="btn btn-primary" style="display: block; margin: 20px auto 0 auto;">Thêm</button>
    </form>
@endsection