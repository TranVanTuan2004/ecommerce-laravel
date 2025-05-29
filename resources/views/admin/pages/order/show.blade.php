@extends('admin.master')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading mb-4">
        <div class="col-lg-8">
            <h2 class="mt-2">Chi tiết đơn hàng #{{ $order->id }}</h2>
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li><a href="{{ route('order.index') }}">Đơn hàng</a></li>
                <li class="active"><strong>Chi tiết</strong></li>
            </ol>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title d-flex justify-content-between align-items-center bg-light p-3 rounded-top">
                    <h5 class="mb-0">Cập nhật trạng thái đơn hàng</h5>
                    <form action="{{ route('order.updateStatus', $order->id) }}" method="POST" class="d-flex">
                        @csrf
                        @method('PUT')
                        <select name="status" class="form-select form-select-sm me-2" onchange="this.form.submit()">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Chờ xác nhận
                            </option>
                            <option value="shipping" {{ $order->status == 'shipping' ? 'selected' : '' }}>Đã xác nhận
                            </option>
                            <option value="delivering" {{ $order->status == 'delivering' ? 'selected' : '' }}>Đang giao
                            </option>
                            <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Đã giao</option>
                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Hủy đơn hàng
                            </option>
                        </select>

                    </form>
                </div>

                <div class="ibox-content p-4">

                    {{-- Thông tin đơn hàng --}}
                    <h5 class="mb-3">Thông tin đơn hàng</h5>
                    <table class="table table-bordered w-50">
                        <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $order->id }}</td>
                            </tr>
                            <tr>
                                <th>Trạng thái</th>
                                <td>
                                    <span
                                        class="badge 
                                        @if ($order->status == 'pending') bg-warning
                                        @elseif($order->status == 'confirmed') bg-secondary
                                        @elseif($order->status == 'shipping') bg-info
                                        @elseif($order->status == 'delivering') bg-primary
                                        @elseif($order->status == 'delivered') bg-success
                                        @elseif($order->status == 'cancelled') bg-danger @endif
                                        text-white">{{ $order->status_label }}</span>

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
                                <td class="text-danger fw-bold">{{ number_format($order->total_price, 0, ',', '.') }}đ</td>
                            </tr>
                        </tbody>
                    </table>

                    {{-- Thông tin khách hàng --}}
                    <h5 class="mt-4 mb-3">Thông tin khách hàng</h5>
                    <table class="table table-bordered w-50">
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
                                <td>{{ $order->user->phone }}</td>
                            </tr>
                            <tr>
                                <th>Địa chỉ giao hàng</th>
                                <td>{{ $order->shipping_address }}</td>
                            </tr>
                        </tbody>
                    </table>

                    {{-- Danh sách sản phẩm --}}
                    <h5 class="mt-4 mb-3">Danh sách sản phẩm</h5>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered text-center">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th class="text-start">Sản phẩm</th>
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
                                                    <img src="{{ asset($item->product->image) }}" alt="image"
                                                        style="width: 40px; height: 40px; object-fit: cover;">
                                                @endif
                                                <div>
                                                    <strong>{{ $item->product->name }}</strong><br>
                                                    @if ($item->variant)
                                                        <small class="text-muted">Phân loại: {{ $item->variant }}</small>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ number_format($item->price, 0, ',', '.') }}đ</td>
                                        <td class="text-danger fw-bold">
                                            {{ number_format($item->price * $item->quantity, 0, ',', '.') }}đ</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Tổng đơn hàng --}}
                    <div class="text-end fw-bold fs-5 mt-3">
                        Tổng đơn hàng: <span
                            class="text-danger">{{ number_format($order->total_price, 0, ',', '.') }}đ</span>
                    </div>

                    {{-- Nút điều hướng --}}
                    <div class="mt-4">
                        <!-- Các nút chỉnh sửa, hủy đơn, quay lại ở đây -->
                        <a href="{{ route('order.edit', $order->id) }}" class="btn btn-warning">Chỉnh sửa</a>
                        <form action="{{ route('order.cancel', $order->id) }}" method="POST"
                            style="display:inline-block;">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Bạn có chắc muốn hủy đơn này?')">Hủy đơn</button>
                        </form>
                        <a href="{{ route('order.index') }}" class="btn btn-secondary">Quay lại</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
