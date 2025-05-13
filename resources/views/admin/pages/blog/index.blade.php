@extends('admin.master')

@section('title', 'Quản lý Blog')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Danh sách Blog</h4>
        <a href="{{ route('blog.create') }}" class="btn btn-success">+ Thêm Blog</a>
    </div>

    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <div style="display: flex; justify-content: space-between">
                <div class="input-group">
                    <input type="text" class="form-control" style="display: block; width: 300px;" placeholder="Tìm kiếm">
                </div>
            </div>
        </div>

        <div class="ibox-content">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tiêu đề</th>
                        <th>Ảnh</th>
                        <th>Tác giả</th>
                        <th>Ngày tạo</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($blogs as $key => $blog)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $blog->title }}</td>
                        <td>
                            @if ($blog->image)
                            <img src="{{ asset($blog->image) }}" alt="Ảnh blog" width="80">
                            @else
                            <span class="text-muted">Không có ảnh</span>
                            @endif
                        </td>
                        <td>{{ $blog->user->name ?? 'Admin' }}</td>
                        <td>{{ $blog->created_at->format('d/m/Y') }}</td>
                        <td style="display: flex; flex-direction: column; align-items: center; justify-content: center;">
                            <a href="{{ route('blog.edit', $blog->id) }}" class="btn btn-primary">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form action="{{ route('blog.destroy', $blog->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa không')">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">Không có blog nào.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-3">
                {{ $blogs->links() }} {{-- Phân trang --}}
            </div>
        </div>
    </div>
</div>
@endsection