@extends('admin.master')

@section('content')
<form method="post" action="{{ route('category.store') }}" enctype="multipart/form-data"
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

    <h1 class="text-center text-primary">Thêm Danh Mục</h1>

    <div class="mb-3" style="margin-top: 12px">
        <label for="name" class="form-label">Tên danh mục</label>
        <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}">
    </div>

    <div class="mb-3" style="margin-top: 12px">
        <label for="description" class="form-label">Mô tả</label>
        <textarea name="description" class="form-control" id="description" rows="4">{{ old('description') }}</textarea>
    </div>

    <button type="submit" class="btn btn-primary" style="display: block; margin: 20px auto 0 auto;">Thêm</button>
</form>
@endsection