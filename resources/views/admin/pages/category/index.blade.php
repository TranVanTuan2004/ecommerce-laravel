<style>
    td {
        text-align: start;
    }
</style>

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
                <div class="ibox-title d-flex justify-content-between align-items-center"
                    style="display: flex; align-items: center; justify-content: space-between;">
                    <div class="d-flex align-items-center gap-2">
                        <a href="{{ route('category.create') }}" class="btn btn-success">
                            <i class="fa fa-plus"></i> Thêm danh mục
                        </a>
                    </div>
                    <form method="GET" action="{{ route('category.index') }}" class="form-inline mb-3">
                        <input type="text" name="search" class="form-control mr-sm-2" placeholder="Tìm danh mục..."
                            style="width: 400px;" value="{{ request()->get('search') }}">
                        <button type="submit" class="btn btn-outline-primary">
                            <i class="fas fa-search"></i> Tìm
                        </button>
                    </form>
                </div>

                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered align-middle text-center">
                            <thead class="thead-light">
                                <tr>
                                    <th style="text-align: center; vertical-align: middle;"><input type="checkbox" id="checkAll"></th>
                                    <th style="text-align: center; vertical-align: middle;">Tên danh mục</th>
                                    <th style="text-align: center; vertical-align: middle;">Mô tả</th>
                                    <th style="text-align: center; vertical-align: middle;" class="text-center">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($categories) && count($categories) > 0)
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td style="text-align: center; vertical-align: middle;"><input type="checkbox" class="checkBoxItem"></td>
                                            <td style="text-align: center; vertical-align: middle;">{{ $category->name }}</td>
                                            <td style="text-align: center; vertical-align: middle;">{{ $category->description }}</td>
                                            <td style="text-align:center; vertical-align: middle;">
                                                <a href="{{ route('category.edit', $category->id) }}" class="btn btn-sm btn-success">
                                                    <i class="fa fa-edit"></i>
                                                </a>

                                                <button class="btn-sm btn-danger" data-toggle="modal" data-target="#confirmDeleteModal-{{ $category->id }}">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- Modal xác nhận xóa -->
                                        <div class="modal fade" id="confirmDeleteModal-{{ $category->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content border-0 shadow-lg rounded-lg">
                                                    <form method="POST" action="{{ route('category.destroy', $category->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="modal-body text-center">
                                                            <p class="font-weight-bold mb-3" style="font-size: 18px">
                                                                Bạn có chắc chắn muốn xoá danh mục
                                                                <span class="text-danger">"{{ $category->name }}"</span> không?
                                                            </p>
                                                            <i class="fas fa-trash fa-3x text-danger mb-3"></i>
                                                        </div>

                                                        <div class="modal-footer justify-content-center">
                                                            <button type="button" class="btn btn-secondary px-4" data-dismiss="modal">
                                                                <i class="fas fa-times"></i> Huỷ
                                                            </button>
                                                            <button type="submit" class="btn btn-danger px-4">
                                                                <i class="fas fa-check"></i> Xác nhận xoá
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
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
                        {{ $categories->appends(request()->all())->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDeleteCategory(url) {
            const form = document.getElementById('deleteCategoryForm');
            form.setAttribute('action', url);
            $('#confirmDeleteModal').modal('show');
        }

        $('#confirmDeleteModal').on('hidden.bs.modal', function() {
            document.getElementById('deleteCategoryForm').removeAttribute('action');
        });
    </script>
@endsection
