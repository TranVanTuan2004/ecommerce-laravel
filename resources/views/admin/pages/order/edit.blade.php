@extends('admin.master')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading mb-3">
        <div class="col-lg-8">
            <h2 class="mt-2">Chỉnh sửa đơn hàng #{{ $order->id }}</h2>
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li><a href="{{ route('order.index') }}">Đơn hàng</a></li>
                <li class="active"><strong>Chỉnh sửa</strong></li>
            </ol>
        </div>php
    </div>

    <div class="row mb-4 mt-4">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-content">
                    <form action="{{ route('order.update', $order->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="user_name" class="form-label">Khách hàng</label>
                            <input type="text" id="user_name" class="form-control" value="{{ $order->user->name }}"
                                disabled>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Sản phẩm</label>
                            <ul class="list-unstyled border rounded p-2" style="max-height: 150px; overflow-y: auto;">
                                @foreach ($order->orderProducts as $orderProduct)
                                    <li>
                                        <strong>{{ $orderProduct->product->name }}</strong> - SL:
                                        {{ $orderProduct->quantity }}, Giá:
                                        {{ number_format($orderProduct->price, 0, ',', '.') }}đ
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="mb-3">
                            <label for="shipping_address" class="form-label">Địa chỉ giao hàng</label>
                            <textarea id="shipping_address" name="shipping_address" class="form-control" rows="3" required>{{ old('shipping_address', $order->shipping_address) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="total_price" class="form-label">Tổng tiền (VNĐ)</label>
                            <input type="number" id="total_price" name="total_price" class="form-control"
                                value="{{ old('total_price', $order->price) }}" required min="0" step="1000">
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Trạng thái</label>
                            <select id="status" name="status" class="form-control" required>
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Chờ xác nhận
                                </option>
                                <option value="confirmed" {{ $order->status == 'confirmed' ? 'selected' : '' }}>Đã xác nhận
                                </option>
                                <option value="shipping" {{ $order->status == 'shipping' ? 'selected' : '' }}>Đang giao
                                </option>
                                <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Đã giao
                                </option>
                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Hủy đơn
                                    hàng</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="payment_method" class="form-label">Phương thức thanh toán</label>
                            <select id="payment_method" name="payment_method" class="form-control" required>
                                <option value="cod" {{ $order->payment_method == 'cod' ? 'selected' : '' }}>Thanh toán
                                    khi nhận hàng</option>
                                <option value="bank" {{ $order->payment_method == 'bank' ? 'selected' : '' }}>Chuyển
                                    khoản</option>
                                <option value="online" {{ $order->payment_method == 'online' ? 'selected' : '' }}>Thanh
                                    toán online</option>
                            </select>
                        </div>

                        <div class="d-flex justify-content-between" style="max-width: 320px; margin: 30px auto 0 auto;">
                            <a href="{{ route('order.index') }}" class="btn btn-secondary flex-fill me-2">Hủy</a>
                            <button type="submit" class="btn btn-primary flex-fill ms-2">Lưu thay đổi</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
