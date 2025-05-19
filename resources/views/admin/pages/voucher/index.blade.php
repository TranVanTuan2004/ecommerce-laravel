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
                <div class="ibox-title d-flex justify-content-between align-items-center"
                    style="display: flex; align-items: center; justify-content: space-between;">
                    <div class="d-flex align-items-center gap-2">
                        <a href="{{ route('voucher.create') }}" class="btn btn-success">
                            <i class="fa fa-plus"></i>
                            Thêm voucher
                        </a>
                    </div>
                    <form method="GET" action="{{ route('voucher.index') }}" class="form-inline mb-3">
                        <input type="text" name="search" class="form-control mr-sm-2" placeholder="Tìm voucher..."
                            style="width: 400px;" value="{{ old('search', $search) }}">
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
                                    <th style="text-align: center; vertical-align: middle;"><input type="checkbox"
                                            id="checkAll"></th>
                                    <th style="text-align: center; vertical-align: middle;">Mã voucher</th>
                                    <th style="text-align: center; vertical-align: middle;">Giảm giá</th>
                                    <th style="text-align: center; vertical-align: middle;">Giá trị đơn hàng tối thiểu</th>
                                    <th style="text-align: center; vertical-align: middle;">Ngày hết hạn</th>
                                    <th style="text-align: center; vertical-align: middle;" class="text-center">Thao tác
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($vouchers) && is_object($vouchers))
                                    @foreach ($vouchers as $voucher)
                                        <tr>
                                            <td style="text-align: center; vertical-align: middle;"><input type="checkbox"
                                                    class="checkBoxItem"></td>
                                            <td style="text-align: center; vertical-align: middle;">{{ $voucher->code }}
                                            </td>
                                            <td style="text-align: center; vertical-align: middle;">
                                                {{ $voucher->discount }}%</td>
                                            <td style="text-align: center; vertical-align: middle;">
                                                đ{{ number_format($voucher->min_order_value, 3) }}</td>
                                            <td style="text-align: center; vertical-align: middle;">
                                                {{ $voucher->expiration_date }}</td>
                                            <td style="text-align:center; vertical-align: middle;">
                                                <a href="{{ route('voucher.edit', $voucher->id) }}"
                                                    class="btn btn-sm btn-success">
                                                    <i class="fa fa-edit"></i>
                                                </a>

                                                <button class="btn-sm btn-danger" data-toggle="modal"
                                                    data-target="#confirmDeleteModal-{{ $voucher->id }}">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="confirmDeleteModal-{{ $voucher->id }}" tabindex="-1"
                                            role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content border-0 shadow-lg rounded-lg">
                                                    <form method="POST"
                                                        action="{{ route('voucher.destroy', $voucher->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="modal-body text-center">
                                                            <p class="font-weight-bold mb-3" style="font-size: 18px">Bạn có
                                                                chắc chắn muốn
                                                                xoá voucher <span
                                                                    class="text-danger">"{{ $voucher->code }}"</span>
                                                                không?</p>
                                                            <i class="fas fa-trash fa-3x text-danger mb-3"></i>
                                                        </div>

                                                        <div class="modal-footer justify-content-center">
                                                            <button type="button" class="btn btn-secondary px-4"
                                                                data-dismiss="modal">
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
                                        <td colspan="6">Không có dữ liệu người dùng.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center mt-3">
                        {{ $vouchers->appends(request()->all())->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Ví dụ script để mở modal và set action cho form -->
    <script>
        function confirmDeleteVoucher(url) {
            const form = document.getElementById('deleteVoucherForm');
            form.setAttribute('action', url); // đặt lại action mỗi lần mở modal
            $('#confirmDeleteModal').modal('show');
        }

        // Sau khi modal đóng, xóa action cũ đi để tránh xóa nhầm
        $('#confirmDeleteModal').on('hidden.bs.modal', function() {
            document.getElementById('deleteVoucherForm').removeAttribute('action');
        });
    </script>
@endsection
