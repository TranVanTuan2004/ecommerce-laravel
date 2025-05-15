@extends('client.pages.orders.layout')


@section('content')
<div class="container d-flex">
    {{-- Sidebar trái --}}
    <div class="w-25 p-3 border-end">
        <h5>{{ auth()->user()->name }}</h5>
        <ul class="list-unstyled">
            <li><a href="#">🔔 Thông báo</a></li>
            <li><a href="#">👤 Tài khoản Của Tôi</a></li>
            <li><a href="{{ route('orders.index') }}">📦 Đơn Mua</a></li>
            <li><a href="#">🎟️ Kho Voucher</a></li>
            <li><a href="#">💰 Shopee Xu</a></li>
        </ul>
    </div>

    {{-- Nội dung chính --}}
    <div class="w-75 p-3">
        <h4>Chi tiết Đơn hàng #{{ $order->id }}</h4>

        {{-- Thanh trạng thái --}}
        @if($order->status_for_bar)
        @php
        $statusColors = [
        'pending' => 'warning',
        'shipping' => 'info',
        'delivering' => 'primary',
        'delivered' => 'success',
        'cancelled' => 'danger',
        ];
        $color = $statusColors[$order->status_for_bar] ?? 'secondary';
        @endphp
        <span class="badge bg-{{ $color }} text-white px-3 py-1 mb-3 d-inline-block">
            {{ ucfirst($order->status_for_bar) }}
        </span>
        @endif


        {{-- Thông tin chung đơn hàng --}}
        <div class="my-3">
            <strong>Trạng thái: </strong>
            <span class="badge bg-success">{{ $order->status_label }}</span>
        </div>

        {{-- Thông tin sản phẩm --}}
        <div class="mb-3">
            <h5>Sản phẩm trong đơn hàng</h5>

            @if($order->orderProducts->count() > 0)
            @foreach($order->orderProducts as $item)
            <div class="d-flex border p-3 mb-3 align-items-center">
                <img src="{{ $item->product->image_url ?? 'https://via.placeholder.com/150' }}" width="150" class="me-4" />

                <div>
                    <p><strong>{{ $item->product->name }}</strong></p>
                    <p>Phân loại: {{ $item->variant ?? 'Chưa có' }}</p>
                    <p>Số lượng: {{ $item->quantity }}</p>
                    <p>Đơn giá: ₫{{ number_format($item->price, 0, ',', '.') }}</p>
                    <p class="fw-bold text-danger">Thành tiền: ₫{{ number_format($item->quantity * $item->price, 0, ',', '.') }}</p>
                </div>
            </div>
            @endforeach
            @else
            <p>Đơn hàng chưa có sản phẩm.</p>
            @endif
        </div>


        {{-- Nút hành động --}}
        <div>
            @if($order->status == 'delivered')
            <a href="{{ route('orders.review', $order) }}" class="btn btn-outline-primary">Đánh giá sản phẩm</a>
            @elseif($order->status == 'cancelled')
            <span class="text-muted">Đơn hàng đã hủy</span>
            @else
            <a href="#" class="btn btn-outline-secondary">Liên hệ Người Bán</a>
            @endif
        </div>
    </div>
</div>
@endsection