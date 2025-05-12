<style>
    td {
        text-align: start;
    }
</style>
@extends('admin.master')


@section('content')
    <div class="row wrapper border-bottom white-bg page-heading mb-3">
        <div class="col-lg-8">
            <h2 class="mt-2">Quản lý voucher</h2>
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="active"><strong>Voucher</strong></li>
            </ol>
        </div>
    </div>

    <div class="row mb-4 mt-4">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-2">
                        <a href="{{ route('voucher.create') }}" class="btn btn-success">
                            <i class="fa fa-plus"></i>
                            Thêm voucher
                        </a>
                    </div>
                </div>

                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered align-middle text-center">
                            <thead class="thead-light">
                                <tr>
                                    <th><input type="checkbox" id="checkAll"></th>
                                    <th>Mã voucher</th>
                                    <th>Giảm giá</th>
                                    <th>Giá trị đơn hàng tối thiểu</th>
                                    <th>Ngày hết hạn</th>
                                    <th class="text-center">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($vouchers) && is_object($vouchers))
                                    @foreach ($vouchers as $voucher)
                                        <tr>
                                            <td><input type="checkbox" class="checkBoxItem"></td>
                                            <td>{{ $voucher->code }}</td>
                                            <td>{{ $voucher->discount }}</td>
                                            <td>{{ $voucher->min_order_value }}</td>
                                            <td>{{ $voucher->expiration_date }}</td>
                                            <td class="text-center">Delete</td>
                                            <td>
                                                <div class="btn-group d-flex align-items-center justify-evenly"
                                                    role="group">
                                                    {{-- <a href="{{ route('users.edit', $user->id) }}"
                                                        class="btn btn-sm btn-success">
                                                        <i class="fa fa-edit"></i>
                                                    </a> --}}
                                                    {{-- <form action="{{ route('users.destroy', $user->id) }}" method="post"
                                                        style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Bạn có chắc muốn xóa không?')">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form> --}}
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6">Không có dữ liệu người dùng.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center mt-3">
                        {{ $vouchers->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
