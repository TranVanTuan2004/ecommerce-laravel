@extends('admin.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading mb-3">
    <div class="col-lg-8">
        <h2 class="mt-2">Quản lý danh mục</h2>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="active"><strong>Categories</strong></li>
        </ol>
    </div>
</div>

<div class="row mb-4 mt-4">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-title d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-2">
                    <a href="{{ route('category.create') }}" class="btn btn-success">
                        <i class="fa fa-plus"></i> Thêm danh mục
                    </a>
                </div>
            </div>

            <div class="ibox-content">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle text-center ">
                        <thead class="thead-light">
                            <tr>
                                <th><input type="checkbox" id="checkAll"></th>
                                <th>Tên danh mục</th>
                                <th>Mô tả</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($categories) && count($categories) > 0)
                            @foreach ($categories as $category)
                            <tr>
                                <td><input type="checkbox" class="checkBoxItem"></td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->description }}</td>
                                <td>
                                    <div class="btn-group d-flex align-items-center justify-evenly"
                                        role="group">
                                        <a href="{{ route('category.edit', $category->id) }}"
                                            class="btn btn-sm btn-success">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form action="{{ route('category.destroy', $category->id) }}" method="post"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Bạn có chắc muốn xóa không?')">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="4">Không có danh mục nào.</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center mt-3">
                    {{ $categories->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection