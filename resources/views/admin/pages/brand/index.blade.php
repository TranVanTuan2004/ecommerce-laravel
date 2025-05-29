@extends('admin.master')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading mb-3">
        <div class="col-lg-8">
            <h2 class="mt-2">Quản lý Brand</h2>
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="active"><strong>Brand</strong></li>
            </ol>
        </div>
    </div>

    <div class="row mb-4 mt-4">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title d-flex justify-content-between align-items-center"
                    style="display: flex; align-items: center; justify-content: space-between;">
                    <div class="d-flex align-items-center gap-2">
                        <a href="{{ route('brand.create') }}" class="btn btn-success">
                            <i class="fa fa-plus"></i>
                            Thêm Brand
                        </a>
                    </div>
                    <form method="GET" action="{{ route('brand.index') }}" class="form-inline mb-3">
                        <input type="text" name="search" class="form-control mr-sm-2" placeholder="Tìm Brand..."
                            style="width: 400px;" value="{{ old('search', $search) }}">
                        <button type="submit" class="btn btn-outline-primary">
                            <i class="fas fa-search"></i> Tìm
                        </button>
                    </form>
                </div>

                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered align-middle text-center">
                            <colgroup>
                                <col style="width: 10%;">
                                <col style="width: 25%;">
                                <col style="width: 20%;">
                                <col style="width: 35%;">
                                <col style="width: 10%;">

                            </colgroup>
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-center">STT
                                    </th>
                                    <th class="text-center">Tên Brand</th>
                                    <th class="text-center" width="200px">Logo</th>
                                    <th class="text-center">Mô tả</th>
                                    <th class="text-center" width="120px">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($brands) && is_object($brands))
                                    @php
                                        $start = ($brands->currentPage() - 1) * $brands->perPage();
                                    @endphp
                                    @foreach ($brands as $brand)
                                        <tr>
                                            <td style="vertical-align: middle;">{{ $start + $loop->iteration }}</td>
                                            <td style="vertical-align: middle;">{{ $brand->name }}</td>
                                            <td style="vertical-align: middle;">
                                                <img src={{ asset('storage/' . $brand->logo) }}
                                                    style="width: 120px; height: 100px; object-fit: contain; border-radius: 6px"
                                                    alt="Not found">
                                            </td>
                                            <td style="vertical-align: middle;">{{ $brand->description }}</td>
                                            <td style="vertical-align: middle;">
                                                <a href="{{ route('brand.edit', $brand->id) }}"
                                                    class="btn btn-sm btn-success">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <form action="{{ route('brand.destroy', $brand->id) }}" method="POST"
                                                    style="display:block; margin-top: 10px">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Bạn có chắc muốn xóa không?')">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6">Không có dữ liệu brand.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center mt-3">
                        {{ $brands->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('brand-form').addEventListener('submit', function(e) {
            const btn = document.getElementById('submit-btn');
            btn.disabled = true;
            btn.innerText = 'Đang xử lý...';
        });
    </script>
@endsection
