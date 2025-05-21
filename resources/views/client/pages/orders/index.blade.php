@extends('client.master')

@section('content')
<<<<<<< HEAD
<div class="container d-flex">
    {{-- Sidebar trái --}}
    <div class="w-25 p-3 border-end">
        <h5>{{ auth()->user() ? auth()->user()->name : 'Khách' }}</h5>
        <ul class="list-unstyled">
            <li><a href="#"><i class="ri-notification-3-line"></i> Thông báo</a></li>
            <li><a href="#"><i class="ri-account-circle-line"></i> Tài khoản Của Tôi</a></li>
            <li><a href="{{ route('orders.index') }}"><i class="ri-store-line"></i> Đơn Mua</a></li>
        </ul>
    </div>

    {{-- Nội dung chính --}}
    <div class="w-75 p-3">
        {{-- Tabs trạng thái --}}
        <ul class="nav nav-tabs mb-3">
            @php
            $statuses = [
            'all' => 'Tất cả',
            'pending' => 'Chờ thanh toán',
            'shipping' => 'Vận chuyển',
            'delivering' => 'Chờ giao hàng',
            'delivered' => 'Hoàn thành',
            'cancelled' => 'Đã hủy',
            ];
            @endphp
            @foreach ($statuses as $key => $label)
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
        <div class="card mb-4 p-3">
            {{-- Header đơn hàng --}}
            <div class="d-flex justify-content-between align-items-center mb-2">
                <div class="d-flex align-items-center gap-2">
                    <img src="https://via.placeholder.com/28x18?text=Mall" alt="mall" height="18">
                    <strong>Shop {{ $order->orderProducts->first()->product->shop_name ?? 'Official Store' }}</strong>
                </div>

                <div class="text-end">
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
                    <span class="text-{{ $color }} fw-bold">{{ strtoupper($order->status_label) }}</span>
                </div>
            </div>

            {{-- Danh sách sản phẩm --}}
            @foreach ($order->orderProducts as $item)
            <div class="d-flex border-top pt-3 gap-3">
                <img src="{{ $item->product->image_url ?? 'https://via.placeholder.com/80' }}"
                    width="80" height="80" class="border rounded" alt="Product Image">
                <div class="flex-grow-1">
                    <p class="mb-1 fw-bold">{{ $item->product->name }}</p>
                    <p class="mb-1">Phân loại hàng: {{ $item->variant ?? 'N/A' }}</p>
                    <p class="mb-0">x{{ $item->quantity }}</p>
                </div>
                <div class="text-end">
                    @if($item->product->old_price)
                    <span class="text-decoration-line-through text-muted">₫{{ number_format($item->product->old_price, 0, ',', '.') }}</span><br>
                    @endif
                    <span class="text-danger fw-bold">₫{{ number_format($item->product->price, 0, ',', '.') }}</span>
                </div>
            </div>
            @endforeach

            {{-- Thành tiền + nút --}}
            <div class="border-top pt-3 d-flex justify-content-between align-items-center mt-3">
                <div></div>
                <div class="text-end">
                    <p class="mb-1">Thành tiền:</p>
                    <p class="text-danger fw-bold fs-5">₫{{ number_format($order->total_price, 0, ',', '.') }}</p>

                    <div class="d-flex justify-content-end gap-2 mt-2">
                        <a href="#" class="btn btn-outline-secondary btn-sm">Liên Hệ Người Bán</a>
                        @if ($order->status == 'delivered')
                        <a href="{{ route('orders.review', $order) }}" class="btn btn-outline-primary btn-sm">Đánh Giá</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @empty
        <p>Không có đơn hàng nào.</p>
        @endforelse
    </div>
</div>
@endsection
=======
    <div class="container d-flex">
        {{-- Sidebar trái --}}
        <div class="w-25 p-3 border-end">
            <h5>{{ auth()->user() ? auth()->user()->name : 'Khách' }}</h5>

            <ul class="list-unstyled">
                <li><a href="#"><i class="ri-notification-3-line"></i> Thông báo</a></li>
                <li><a href="#"><i class="ri-account-circle-line"></i> Tài khoản Của Tôi</a></li>
                <li><a href="{{ route('orders.index') }}"><i class="ri-store-line"></i> Đơn Mua</a></li>
            </ul>
        </div>

        {{-- Nội dung chính --}}
        <div class="w-75 p-3">
            {{-- Tabs trạng thái --}}
            <ul class="nav nav-tabs mb-3">
                @php
                    $statuses = [
                        'all' => 'Tất cả',
                        'pending' => 'Chờ thanh toán',
                        'shipping' => 'Vận chuyển',
                        'delivering' => 'Chờ giao hàng',
                        'delivered' => 'Hoàn thành',
                        'cancelled' => 'Đã hủy',
                    ];
                @endphp
                @foreach ($statuses as $key => $label)
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
                    @if ($order->status_for_bar)
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
                                <img src="{{ $item->product->image_url ?? 'https://via.placeholder.com/100' }}"
                                    width="80" class="me-2" />
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
                        @if ($order->status == 'delivered')
                            <a href="{{ route('orders.review', $order) }}" class="btn btn-outline-primary btn-sm">Đánh
                                giá</a>
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
>>>>>>> origin/main
