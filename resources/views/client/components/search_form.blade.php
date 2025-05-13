<div class="container my-4">
    <div class="row align-items-center">
        <form action="{{ route('product.shop') }}" method="GET" class="row g-3 align-items-center mb-4">
            <div class="col-md-3">
                <input type="text" name="keyword" class="form-control" placeholder="Tìm theo tên, mô tả..." value="{{ request()->keyword }}">
            </div>
            <div class="col-md-2">
                <input type="number" name="min_price" class="form-control" placeholder="Giá từ" value="{{ request()->min_price }}">
            </div>
            <div class="col-md-2">
                <input type="number" name="max_price" class="form-control" placeholder="Giá đến" value="{{ request()->max_price }}">
            </div>
            <div class="col-md-2">
                <select name="category_id" class="form-select">
                    <option value="">Chọn danh mục</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ request()->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select name="brand_id" class="form-select">
                    <option value="">Chọn thương hiệu</option>
                    @foreach ($brands as $brand)
                    <option value="{{ $brand->id }}" {{ request()->brand_id == $brand->id ? 'selected' : '' }}>
                        {{ $brand->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Tìm kiếm</button>
            </div>
        </form>
    </div>
</div>