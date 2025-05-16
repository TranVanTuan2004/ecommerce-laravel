@extends('admin.master')

@section('content')
<form method="post" action="{{ route('blog.store') }}" enctype="multipart/form-data"
    style="max-width: 800px; box-shadow: 0 3px 10px rgb(0 0 0 / 0.2); margin-top: 80px; padding: 40px;" class="container">
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

    <h1 class="text-center text-primary">Thêm Blog</h1>

    <div class="mb-3" style="margin-top: 12px">
        <label for="title" class="form-label">Tiêu đề</label>
        <input type="text" name="title" class="form-control" id="title" required>
    </div>

    <div class="mb-3" style="margin-top: 12px">
        <label for="content" class="form-label">Nội dung</label>
        <textarea name="content" class="form-control" id="content" required></textarea>
    </div>

    <div class="mb-3" style="margin-top: 12px">
        <label for="image" class="form-label">Ảnh minh họa</label>
        <input type="file" name="image" class="form-control" id="image">
    </div>

    <button type="submit" class="btn btn-primary" style="display: block; margin: 20px auto 0 auto;">Thêm Blog</button>
</form>
@endsection