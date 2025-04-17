<form method="post" action={{ route('brand.store') }} enctype="multipart/form-data"
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
    <h1 class="text-center text-primary">Thêm Brand</h1>
    <div class="mb-3" style="margin-top: 12px">
        <label for="name" class="form-label">Name</label>
        <input type="text" name="name" class="form-control" id="name">
    </div>
    <div class="mb-3" style="margin-top: 12px">
        <label for="description" class="form-label">Description</label>
        <input type="text" name="description" class="form-control" id="description">
    </div>

    <div class="mb-3" style="margin-top: 12px">
        <label for="logo" class="form-label">Logo</label>
        <input type="file" name="logo" class="form-control" id="logo">
    </div>

    <button type="submit" class="btn btn-primary" style="display: block; margin: 20px auto 0 auto;">Thêm</button>
</form>
