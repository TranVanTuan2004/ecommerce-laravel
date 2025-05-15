@extends('client.pages.orders.layout')

@section('content')
<div class="container d-flex">
    {{-- Sidebar trái --}}
    <div class="w-25 p-3 border-end">
        <h5>{{ auth()->user() ? auth()->user()->name : 'Khách' }}</h5>

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
        {{-- Tabs trạng thái --}}
        <ul class="nav nav-tabs mb-3">
            @php
            $statuses = ['all' => 'Tất cả', 'pending' => 'Chờ thanh toán', 'shipping' => 'Vận chuyển', 'delivering' => 'Chờ giao hàng', 'delivered' => 'Hoàn thành', 'cancelled' => 'Đã hủy'];
            @endphp
            @foreach($statuses as $key => $label)
            <li class="nav-item">
                <a class="nav-link {{ request('status') == $key || (request('status') == null && $key == 'all') ? 'active' : '' }}"
                    href="{{ route('orders.index', ['status' => $key]) }}">
                    {{ $label }}
                </a>
            </li>
            @endforeach
        </ul>

        {{-- Danh sách đơn hàng --}}
        @forelse ($orders as $order)
        <div class="d-flex justify-content-between">
            <strong>Đơn hàng #{{ $order->id }}</strong>
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
            <span class="badge bg-{{ $color }} text-white px-3 py-1">
                {{ ucfirst($order->status_for_bar) }}
            </span>
            @endif

            <span class="badge bg-success">{{ $order->status_label }}</span>
        </div>

        <div class="d-flex mt-2">
            <div style="max-height: 120px; overflow-y: auto;">
                @foreach ($order->orderProducts as $item)
                <div class="d-flex mb-2">
                    <img src="{{ $item->product->image_url ?? 'https://via.placeholder.com/100' }}" width="80" class="me-2" />
                    <div>
                        <p class="mb-1"><strong>{{ $item->product->name }}</strong></p>
                        <p class="mb-0">Phân loại: {{ $item->variant ?? 'N/A' }}</p>
                        <p class="mb-0">x{{ $item->quantity }}</p>
                    </div>
                </div>
                @endforeach
            </div>


            <div class="ms-auto text-end">
                <p><strong>Thành tiền:</strong></p>
                <p class="text-danger fw-bold">₫{{ number_format($order->total_price, 0, ',', '.') }}</p>

                {{-- Nút hành động --}}
                @if($order->status == 'delivered')
                <a href="{{ route('orders.review', $order) }}" class="btn btn-outline-primary btn-sm">Đánh giá</a>
                @elseif($order->status == 'cancelled')
                <span class="text-muted">Đã hủy</span>
                @else
                <a href="#" class="btn btn-outline-secondary btn-sm">Liên hệ Người Bán</a>
                @endif
            </div>
        </div>
    </div>
    @empty
    <p>Không có đơn hàng nào.</p>
    @endforelse
</div>
</div>
@endsection