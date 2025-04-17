@extends('layouts.app') {{-- hoặc admin.master nếu bạn đang dùng giao diện admin --}}
@section('content')
<div class="container py-4">
    <h2>Chi tiết đơn hàng #{{ $order->id }}</h2>

    <div class="mb-4">
        <strong>Ngày đặt:</strong> {{ $order->created_at->format('d/m/Y H:i') }}<br>
        <strong>Trạng thái:</strong>
        <span class="badge bg-primary">{{ ucfirst($order->status) }}</span><br>
        <strong>Phương thức thanh toán:</strong> {{ $order->payment_method }}<br>
        <strong>Tổng tiền:</strong> {{ number_format($order->total_price, 0, ',', '.') }}đ
    </div>

    {{-- Thông tin giao hàng --}}
    @if($order->shipping)
    <div class="mb-4">
        <h5>Thông tin giao hàng:</h5>
        <p>
            <strong>Người nhận:</strong> {{ $order->shipping->recipient_name }}<br>
            <strong>SĐT:</strong> {{ $order->shipping->phone }}<br>
            <strong>Địa chỉ:</strong> {{ $order->shipping->address }}
        </p>
    </div>
    @endif

    {{-- Danh sách sản phẩm --}}
    <h5>Sản phẩm trong đơn hàng:</h5>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Sản phẩm</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Tổng</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->orderDetails as $detail)
            <tr>
                <td>{{ $detail->product->name }}</td>
                <td>{{ $detail->quantity }}</td>
                <td>{{ number_format($detail->price, 0, ',', '.') }}đ</td>
                <td>{{ number_format($detail->quantity * $detail->price, 0, ',', '.') }}đ</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Thanh toán (nếu có nhiều lần thanh toán) --}}
    @if($order->payments && $order->payments->count())
    <div class="mt-4">
        <h5>Lịch sử thanh toán:</h5>
        <ul>
            @foreach($order->payments as $payment)
            <li>
                <strong>Số tiền:</strong> {{ number_format($payment->amount, 0, ',', '.') }}đ -
                <strong>Thời gian:</strong> {{ $payment->created_at->format('d/m/Y H:i') }}
            </li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- Nút quay lại --}}
    <div class="mt-4">
        <a href="{{ route('orders.tracking') }}" class="btn btn-secondary">← Quay lại danh sách đơn hàng</a>
    </div>
</div>
@endsection