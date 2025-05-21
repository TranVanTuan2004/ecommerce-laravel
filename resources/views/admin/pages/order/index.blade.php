<style>
    td {
        text-align: start;
    }
</style>

@extends('admin.master')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading mb-3">
        <div class="col-lg-8">
            <h2 class="mt-2">Quản lý đơn hàng</h2>
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="active"><strong>Đơn hàng</strong></li>
            </ol>
        </div>
    </div>

    <div class="row mb-4 mt-4">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered align-middle text-center">
                            <thead class="thead-light">
                                <tr>
                                    <th><input type="checkbox" id="checkAll"></th>
                                    <th>Khách hàng</th>
                                    <th>Sản phẩm</th>
                                    <th>Tổng tiền</th>
                                    <th>Thao tác</th>
                                    <th>Trạng thái</th>
                                    <th>Phương thức thanh toán</th>
                                    <th>Ngày đặt</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as $order)
                                <tr>
                                    <td><input type="checkbox" class="checkBoxItem"></td>
                                    <td>{{ $order->user->name ?? 'Khách vãng lai' }}</td>
                                    <td>
                                        <!-- hiển thị sản phẩm -->
                                    </td>
                                    <td>{{ number_format($order->total_price, 0, ',', '.') }}đ</td>
                                    <td>
                                        <form action="{{ route('order.updateStatus', $order->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <select name="status" class="form-control form-control-sm" onchange="this.form.submit()">
                                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Chờ xác nhận</option>
                                                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Đang xử lý</option>
                                                <option value="shipping" {{ $order->status == 'shipping' ? 'selected' : '' }}>Đang giao</option>
                                                <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Đã giao</option>
                                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Đã huỷ</option>
                                            </select>
                                        </form>
                                    </td>
                                    <td>
                                        <span class="badge 
                                            @if($order->status == 'pending') badge-warning 
                                            @elseif($order->status == 'processing') badge-info 
                                            @elseif($order->status == 'shipping') badge-primary 
                                            @elseif($order->status == 'delivered') badge-success 
                                            @elseif($order->status == 'cancelled') badge-danger 
                                            @else badge-secondary
                                            @endif">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td>{{ ucfirst($order->payment_method) }}</td>
                                    <td>{{ \Carbon\Carbon::parse($order->ordered_at)->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <!-- các nút thao tác -->
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8">Không có đơn hàng nào.</td>
                                </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center mt-3">
                        {{ $orders->appends(request()->all())->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
