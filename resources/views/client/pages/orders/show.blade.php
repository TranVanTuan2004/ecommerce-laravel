<style>
    /* === Toàn bộ layout container === */
    .container.d-flex {
        min-height: 100vh;
        background-color: #fff;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: #333;
    }

    /* === Sidebar trái === */
    .container>div.w-25 {
        background-color: #f9fafb;
        /* nền xám nhẹ */
        border-right: 1px solid #e5e7eb;
        /* viền phân cách */
        min-height: 100vh;
        position: sticky;
        top: 0;
        padding: 2rem 1.5rem;
    }

    .container>div.w-25 h5 {
        font-weight: 700;
        font-size: 1.3rem;
        color: #111827;
        margin-bottom: 1.5rem;
        border-bottom: 1px solid #e5e7eb;
        padding-bottom: 0.7rem;
    }

    .container>div.w-25 ul {
        padding-left: 0;
        list-style: none;
    }

    .container>div.w-25 ul li {
        margin-bottom: 1.2rem;
    }

    .container>div.w-25 ul li a {
        font-weight: 600;
        font-size: 1rem;
        color: #374151;
        text-decoration: none;
        padding: 0.4rem 0.6rem;
        border-radius: 5px;
        display: block;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .container>div.w-25 ul li a:hover {
        background-color: #7fcad2;
        /* tím chủ đạo */
        color: #fff;
    }

    /* === Nội dung chính === */
    .container>div.w-75 {
        padding: 2rem 2.5rem;
        background-color: #fff;
    }

    /* Tiêu đề đơn hàng */
    h4 {
        font-weight: 700;
        font-size: 1.5rem;
        color: #1f2937;
        margin-bottom: 1.8rem;
    }

    /* === Badge trạng thái === */
    .badge {
        letter-spacing: 0.5px;
        font-weight: 600;
        text-shadow: 0 0 1px rgba(0, 0, 0, 0.07);
        font-size: 0.875rem;
        border-radius: 12px;
        padding: 0.35rem 1rem;
        display: inline-block;
    }

    .badge.bg-warning {
        background-color: #f59e0b !important;
        /* vàng */
        color: white;
    }

    .badge.bg-info {
        background-color: #3b82f6 !important;
        /* xanh biển */
        color: white;
    }

    .badge.bg-primary {
        background-color: #6366f1 !important;
        /* tím */
        color: white;
    }

    .badge.bg-success {
        background-color: #10b981 !important;
        /* xanh lá */
        color: white;
    }

    .badge.bg-danger {
        background-color: #ef4444 !important;
        /* đỏ */
        color: white;
    }

    .badge.bg-secondary {
        background-color: #6b7280 !important;
        /* xám */
        color: white;
    }

    /* Badge trạng thái lớn */
    .badge.rounded-pill {
        font-size: 1rem;
        padding: 0.5rem 1.4rem;
        box-shadow: 0 2px 6px rgb(0 0 0 / 0.1);
    }

    /* === Sản phẩm trong đơn hàng === */
    .mb-3>h5 {
        font-weight: 700;
        font-size: 1.25rem;
        color: #111827;
        margin-bottom: 1.2rem;
    }

    .d-flex.border.p-3.mb-3.align-items-center {
        background-color: #f9fafb;
        border-radius: 8px;
        box-shadow: 0 1px 3px rgb(0 0 0 / 0.05);
        transition: box-shadow 0.3s ease;
    }

    .d-flex.border.p-3.mb-3.align-items-center:hover {
        box-shadow: 0 4px 10px rgb(0 0 0 / 0.1);
    }

    .d-flex.border.p-3.mb-3.align-items-center img {
        border-radius: 6px;
        object-fit: cover;
    }

    .d-flex.border.p-3.mb-3.align-items-center p {
        margin: 0.15rem 0;
        font-size: 0.95rem;
        color: #374151;
    }

    .d-flex.border.p-3.mb-3.align-items-center p strong {
        color: #111827;
    }

    /* Thành tiền nổi bật */
    .fw-bold.text-danger {
        font-weight: 700 !important;
        color: #dc2626 !important;
        font-size: 1rem;
    }

    /* === Tổng tiền & giảm giá === */
    .text-end.border-top.pt-3 {
        border-color: #e5e7eb !important;
        margin-top: 2rem;
        font-size: 1rem;
        color: #374151;
    }

    .text-end.border-top.pt-3 p {
        margin: 0.4rem 0;
    }

    .text-end.border-top.pt-3 p strong {
        font-weight: 600;
        color: #111827;
    }

    .text-danger.fs-5.fw-bold {
        font-size: 1.4rem;
        font-weight: 700;
    }

    /* === Nút hành động === */
    .mt-4 {
        margin-top: 2rem !important;
    }

    .btn-outline-primary {
        color: #4f46e5;
        border-color: #4f46e5;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-outline-primary:hover {
        background-color: #4f46e5;
        color: white;
    }

    .btn-outline-secondary {
        color: #6b7280;
        border-color: #6b7280;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-outline-secondary:hover {
        background-color: #6b7280;
        color: white;
    }

    /* Text trạng thái đơn hàng đã hủy */
    .text-muted {
        color: #6b7280 !important;
        font-weight: 600;
        font-size: 1rem;
    }

    /* === Responsive nhỏ hơn 768px (tablet trở xuống) === */
    @media (max-width: 767px) {
        .container.d-flex {
            flex-direction: column;
        }

        .container>div.w-25,
        .container>div.w-75 {
            min-height: auto;
            width: 100% !important;
            position: relative !important;
            border-right: none;
            padding: 1.5rem 1rem;
        }

        .container>div.w-25 {
            border-bottom: 1px solid #e5e7eb;
        }
    }
</style>

@extends('client.master')

@section('content')
    <div class="container d-flex">
        {{-- Sidebar trái --}}
        <div class="w-25 p-3 border-end">
            <h5>{{ auth()->user()->name }}</h5>
            <ul class="list-unstyled">
                <li><a href="#">Thông báo</a></li>
                <li><a href="#">Tài khoản Của Tôi</a></li>
                <li><a href="{{ route('orders.index') }}">Đơn Mua</a></li>
            </ul>
        </div>

        {{-- Nội dung chính --}}
        <div class="w-75 p-3">
            <h4>Chi tiết Đơn hàng #{{ $order->id }}</h4>

            {{-- Thanh trạng thái --}}
            @if ($order->status)
                @php
                    $statusColors = [
                        'pending' => 'warning',
                        'shipping' => 'info',
                        'delivering' => 'primary',
                        'delivered' => 'success',
                        'cancelled' => 'danger',
                    ];
                    $color = $statusColors[$order->status] ?? 'secondary';
                @endphp
                <span class="badge bg-{{ $color }} text-white px-3 py-1 mb-3 d-inline-block">
                    {{ ucfirst($order->status) }}
                </span>
            @endif

            {{-- Trạng thái đơn hàng chính --}}
            <div class="my-3">
                <strong>Trạng thái: </strong>
                <span id="order-status-text"
                    class="badge rounded-pill px-3 py-2 bg-{{ $color }} text-white text-capitalize shadow-sm"
                    style="font-size: 0.875rem;">
                    {{ $order->status_label }}
                </span>

            </div>

            {{-- Thông tin sản phẩm --}}
            <div class="mb-3">
                <h5>Sản phẩm trong đơn hàng</h5>

                @if ($order->orderProducts->count() > 0)
                    @foreach ($order->orderProducts as $item)
                        <div class="d-flex border p-3 mb-3 align-items-center">
                            <img src="{{ asset($item->product->image) }}" width="150" class="me-4"
                                alt="Ảnh sản phẩm" />

                            <div>
                                <p>
                                    <strong>
                                        <a href="{{ route('productDetail', $item->product->id) }}"
                                            class="text-dark fw-bold text-decoration-none">
                                            {{ $item->product->name }}
                                        </a>
                                    </strong>
                                </p>

                                <p>Phân loại: {{ $item->variant ?? 'Chưa có' }}</p>
                                <p>Số lượng: {{ $item->quantity }}</p>
                                <p>Đơn giá: ₫{{ number_format($item->price ?? 0, 0, ',', '.') }}</p>
                                <p class="fw-bold text-success">Thành tiền:
                                    ₫{{ number_format($item->quantity * ($item->price ?? 0), 0, ',', '.') }}</p>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>Đơn hàng chưa có sản phẩm.</p>
                @endif
            </div>

            {{-- Tổng tiền và giảm giá --}}
            <div class="text-end border-top pt-3">
                @php
                    $originalTotal = $order->orderProducts->sum(fn($item) => $item->quantity * $item->price);
                    $discountAmount = max(0, $originalTotal - $order->price);
                @endphp

                <p>
                    <strong>Tổng tạm tính:</strong>
                    ₫{{ number_format($originalTotal, 0, ',', '.') }}
                </p>

                @php
                    $voucher = optional($order->voucher);
                @endphp

                @if ($voucher->code)
                    <p><strong>Voucher:</strong> {{ $voucher->code }} (-{{ $voucher->discount }}%)</p>
                @endif


                @if ($discountAmount > 0)
                    <p><strong>Số tiền giảm giá:</strong> -₫{{ number_format($discountAmount, 0, ',', '.') }}</p>
                @endif

                <p class="text-danger fs-5 fw-bold">Tổng thanh toán: ₫{{ number_format($order->price, 0, ',', '.') }}</p>
            </div>


            {{-- Nút hành động --}}
            <div class="mt-4">
                @if ($order->status == 'delivered')
                    <a href="{{ route('orders.review', $order) }}" class="btn btn-outline-primary">Đánh giá sản phẩm</a>
                @elseif($order->status == 'cancelled')
                    <span class="text-muted">Đơn hàng đã hủy</span>
                @endif
            </div>
        </div>
    </div>
    <script>
        function getStatusColor(statusText) {
            switch (statusText) {
                case 'Chờ xử lý':
                case 'Chờ thanh toán':
                    return 'bg-warning';
                case 'Đang vận chuyển':
                case 'Vận chuyển':
                    return 'bg-info';
                case 'Chờ giao hàng':
                    return 'bg-primary';
                case 'Đã giao':
                case 'Hoàn thành':
                    return 'bg-success';
                case 'Đã hủy':
                    return 'bg-danger';
                default:
                    return 'bg-secondary';
            }
        }

        function updateOrderStatus() {
            fetch(`/api/order-status/{{ $order->id }}`)
                .then(response => response.json())
                .then(data => {
                    const el = document.getElementById('order-status-text');
                    if (el && el.textContent.trim() !== data.status) {
                        el.textContent = data.status;
                        el.className = 'badge text-white ' + getStatusColor(data.status);
                    }
                })
                .catch(err => console.error('Lỗi cập nhật trạng thái:', err));
        }

        setInterval(updateOrderStatus, 10000); // cập nhật mỗi 10 giây
    </script>

@endsection
