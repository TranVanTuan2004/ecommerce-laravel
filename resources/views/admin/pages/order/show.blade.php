@extends('admin.master')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading mb-3">
        <div class="col-lg-8">
            <h2 class="mt-2">Chi tiết đơn hàng #{{ $order->id }}</h2>
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li><a href="{{ route('admin.order.index') }}">Đơn hàng</a></li>
                <li class="active"><strong>Chi tiết</strong></li>
            </ol>
        </div>
    </div>

    <div class="row mb-4 mt-4">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title d-flex justify-content-between align-items-center">
                    <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
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
                </div>

                <div class="ibox-content">

                    {{-- Thông tin đơn hàng --}}
                    <h5>Thông tin đơn hàng</h5>
                    <table class="table table-bordered" style="max-width: 600px;">
                        <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $order->id }}</td>
                            </tr>
                            <tr>
                                <th>Trạng thái</th>
                                <td>
                                    <span class="badge badge-info">{{ $order->status_label }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th>Phương thức thanh toán</th>
                                <td>{{ ucfirst($order->payment_method) }}</td>
                            </tr>
                            <tr>
                                <th>Ngày đặt</th>
                                <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                            <tr>
                                <th>Tổng tiền</th>
                                <td>{{ number_format($order->total_price, 0, ',', '.') }}đ</td>
                            </tr>
                        </tbody>
                    </table>

                    {{-- Thông tin khách hàng --}}
                    <h5>Thông tin khách hàng</h5>
                    <table class="table table-bordered" style="max-width: 600px;">
                        <tbody>
                            <tr>
                                <th>Họ tên</th>
                                <td>{{ $order->user->name ?? 'Khách vãng lai' }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $order->user->email ?? '---' }}</td>
                            </tr>
                            <tr>
                                <th>SĐT</th>
                                <td>{{ $order->user->phone ?? 'Chưa cung cấp' }}</td>
                            </tr>
                            <tr>
                                <th>Địa chỉ giao hàng</th>
                                <td>{{ $order->shipping_address ?? 'Chưa có địa chỉ' }}</td>
                            </tr>
                        </tbody>
                    </table>

                    {{-- Danh sách sản phẩm --}}
                    <h5>Danh sách sản phẩm</h5>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered align-middle text-center">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Đơn giá</th>
                                    <th>Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->orderItems as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td class="text-start">
                                            <div class="d-flex align-items-center gap-2">
                                                @if ($item->product->image)
                                                    <img src="{{ $item->product->image }}" alt="image"
                                                        style="width: 40px; height: 40px; object-fit: cover;">
                                                @endif
                                                <div>
                                                    <strong>{{ $item->product->name }}</strong><br>
                                                    @if ($item->variant)
                                                        <small>Phân loại: {{ $item->variant }}</small>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ number_format($item->price, 0, ',', '.') }}đ</td>
                                        <td>{{ number_format($item->price * $item->quantity, 0, ',', '.') }}đ</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Tổng đơn hàng --}}
                    <div class="text-end font-weight-bold" style="font-size: 18px;">
                        Tổng đơn hàng: {{ number_format($order->total_price, 0, ',', '.') }}đ
                    </div>

                    {{-- Nút điều hướng --}}
                    <div class="mt-4">
                        <a href="{{ route('admin.order.index') }}" class="btn btn-secondary">
                            <i class="fa fa-arrow-left"></i> Quay lại
                        </a>
                        <a href="{{ route('admin.order.edit', $order->id) }}" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Chỉnh sửa
                        </a>
                        <form action="{{ route('admin.order.destroy', $order->id) }}" method="POST"
                            style="display: inline-block;" onsubmit="return confirm('Bạn có chắc chắn muốn xoá đơn hàng này?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash-alt"></i> Xoá
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
