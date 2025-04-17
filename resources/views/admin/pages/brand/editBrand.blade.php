<form method="post" action={{ route('brand.update', $brand->id) }} enctype="multipart/form-data"
    style="max-width: 800px; box-shadow: 0 3px 10px rgb(0 0 0 / 0.2); margin-top: 80px; padding: 40px;" class="container">
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
    <h1 class="text-center text-primary">Sửa Brand</h1>
    <div class="mb-3" style="margin-top: 12px">
        <label for="name" class="form-label">Name</label>
        <input type="text" name="name" class="form-control" value="{{ $brand->name }}" id="name">
    </div>
    <div class="mb-3" style="margin-top: 12px">
        <label for="description" class="form-label">Description</label>
        <input type="text" name="description" class="form-control" value="{{ $brand->description }}"
            id="description">
    </div>

    <div class="mb-3" style="margin-top: 12px">
        <label for="logo" class="form-label">Logo</label>
        <input type="file" name="logo" class="form-control" id="logo">
        <img src="{{ asset('storage/' . $brand->logo) }}"
            style="margin-top: 12px; width:100px; height:100px; object-fit: cover; border-radius: 6px" alt="Not found">
    </div>

    <button type="submit" class="btn btn-primary" style="display: block; margin: 20px auto 0 auto;">Cập nhật</button>
</form>
