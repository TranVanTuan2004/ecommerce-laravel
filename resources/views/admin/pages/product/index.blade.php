@extends('admin.master')

@section('title', 'Quản lý Sản phẩm')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Danh sách Sản phẩm</h4>
        <a href="" class="btn btn-success">+ Thêm Sản phẩm</a>
    </div>

    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <form method="GET" action="{{ route('product.index') }}">
                <div style="display: flex; justify-content: space-between">
                    <div class="input-group">
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                            style="display: block; width: 300px;" placeholder="Tìm theo tên sản phẩm">
                        <button class="btn btn-primary ms-2" type="submit">Tìm kiếm</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="ibox-content">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên sản phẩm</th>
                        <th>Ảnh</th>
                        <th>Giá</th>
                        <th>Danh mục</th>
                        <th>Thương hiệu</th>
                        <th>Ngày tạo</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $key => $product)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $product->name }}</td>
                        <td>
                            @if ($product->image)
                            <img src="{{ asset($product->image) }}" alt="Ảnh sản phẩm" width="80">
                            @else
                            <span class="text-muted">Không có ảnh</span>
                            @endif
                        </td>
                        <td>{{ number_format($product->price, 0, ',', '.') }} đ</td>
                        <td>{{ $product->category->name ?? 'Không rõ' }}</td>
                        <td>{{ $product->brand->name ?? 'Không rõ' }}</td>
                        <td>{{ $product->created_at->format('d/m/Y') }}</td>
                        <td style="display: flex; flex-direction: column; align-items: center; justify-content: center;">
                            <a href="" class="btn btn-primary mb-1">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form action="" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Bạn có chắc muốn xóa không?')">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center">Không có sản phẩm nào.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-3">
                {{ $products->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

