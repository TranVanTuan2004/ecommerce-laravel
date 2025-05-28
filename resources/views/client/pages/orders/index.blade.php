<style>
    .star {
        font-size: 28px;
        cursor: pointer;
        color: transparent;
        /* ẩn màu fill mặc định */
        -webkit-text-stroke: 1.5px gold;
        /* viền ngoài vàng */
        transition: color 0.3s, -webkit-text-stroke-color 0.3s;
    }

    /* Khi active (đã được chọn) */
    .star.fas {
        color: gold;
        /* fill vàng */
        -webkit-text-stroke: 0;
        /* bỏ viền */
    }

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
        background-color: #6366f1;
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

        .container>div.w-25 ul li a.active-sidebar {
            background-color: #6366f1;
            color: #fff;
        }




    }
</style>

@extends('client.master')

@section('content')
    {{-- THÔNG BÁO --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="container d-flex">
        {{-- Sidebar trái --}}
        <div class="w-25 p-3 border-end">
            <h5>{{ auth()->user() ? auth()->user()->name : 'Khách' }}</h5>
            <ul class="list-unstyled">
                <li><a href="#"><i class="ri-notification-3-line"></i> Thông báo</a></li>
                <li><a href="#"><i class="ri-account-circle-line"></i> Tài khoản Của Tôi</a></li>
                <li><a href="{{ route('orders.index') }}"
                        class="{{ request()->routeIs('orders.*') ? 'active-sidebar' : '' }}"><i class="ri-store-line"></i>
                        Đơn Mua</a></li>

            </ul>
        </div>

        {{-- Nội dung chính --}}
        <div class="w-75 p-3">
            {{-- Tabs trạng thái --}}
            <ul class="nav nav-tabs mb-3">
                @php
                    $statuses = [
                        'all' => 'Tất cả',
                        'pending' => 'Chờ xác nhận',
                        'confirmed' => 'Đã xác nhận',
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
                            <strong>Happy
                                {{ optional(optional($order->orderProducts->first())->product)->shop_name ?? 'Shop' }}</strong>
                        </div>

                        <div class="text-end">
                            @php
                                $statusColors = [
                                    'pending' => 'warning',
                                    'confirmed' => 'secondary',
                                    'shipping' => 'info',
                                    'delivering' => 'primary',
                                    'delivered' => 'success',
                                    'cancelled' => 'danger',
                                ];
                                $color = $statusColors[$order->status] ?? 'secondary';
                            @endphp
                            <span id="order-status-{{ $order->id }}" data-status="{{ $order->status }}"
                                class="badge rounded-pill px-3 py-2 bg-{{ $color }} text-white text-capitalize shadow-sm"
                                style="font-size: 0.875rem;">
                                {{ $order->status_label }}
                            </span>


                        </div>
                    </div>

                    {{-- Danh sách sản phẩm --}}
                    @foreach ($order->orderProducts as $item)
                        <div class="d-flex border-top pt-3 gap-3">
                            <img src="{{ asset($item->product->image) }}" width="80" height="80" class="border rounded"
                                alt="Product Image">
                            <div class="flex-grow-1">
                                <p>
                                    <strong>
                                        <a href="{{ route('productDetail', $item->product->id) }}"
                                            class="text-dark fw-bold text-decoration-none">
                                            {{ $item->product->name }}
                                        </a>
                                    </strong>
                                </p>
                                <p class="mb-1">Phân loại hàng: {{ $item->variant ?? 'N/A' }}</p>
                                <p class="mb-1">Số lượng: x{{ $item->quantity }}</p>
                                <p class="mb-0">
                                    Thành tiền:
                                    <strong class="text-danger">
                                        ₫{{ number_format($item->quantity * $item->product->price, 0, ',', '.') }}
                                    </strong>
                                </p>
                            </div>
                            <div class="text-end">
                                @if ($item->product->old_price)
                                    <span
                                        class="text-decoration-line-through text-muted d-block">₫{{ number_format($item->product->old_price, 0, ',', '.') }}</span>
                                @endif
                                <span
                                    class="text-success fw-bold d-block">₫{{ number_format($item->product->price, 0, ',', '.') }}</span>
                            </div>
                        </div>
                        @if ($order->status === 'delivered')
                            <div class="text-end mt-2">
                                <button class="btn btn-sm btn-outline-primary px-3 py-1 mb-10"
                                    onclick="openReviewForm({{ $item->product->id }})">
                                    Đánh giá
                                </button>
                            </div>
                        @endif
                    @endforeach

                    {{-- Thành tiền + nút --}}
                    <div class="border-top pt-3 d-flex justify-content-between align-items-center mt-3">
                        <div>
                            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-outline-success"
                                style="display:inline-block;">Xem chi
                                tiết</a>
                            @if (!in_array($order->status, ['delivered', 'cancelled']))
                                <form method="POST" action="{{ route('orders.cancel', $order->id) }}"
                                    onsubmit="return confirm('Bạn có chắc muốn hủy đơn hàng này không?');"
                                    style="display:inline-block;">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-sm btn-outline-danger">Hủy đơn hàng</button>
                                </form>
                            @endif
                        </div>
                        <div class="text-end border-top pt-3">
                            @php
                                $originalTotal = $order->orderProducts->sum(
                                    fn($item) => $item->quantity * $item->price,
                                );
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
                                <p><strong>Số tiền giảm giá:</strong> -₫{{ number_format($discountAmount, 0, ',', '.') }}
                                </p>
                            @endif

                            <p class="text-danger fs-5 fw-bold">Tổng thanh toán:
                                ₫{{ number_format($order->price, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <p>Không có đơn hàng nào.</p>
            @endforelse

            {{-- Pagination --}}
            <div class="mt-4">
                {{ $orders->links() }}
            </div>
        </div>
    </div>

    {{-- SCRIPT cập nhật trạng thái --}}
    <script>
        const orderIds = @json($orders->pluck('id'));

        const statusLabels = {
            pending: 'Chờ xác nhận',
            confirmed: 'Đã xác nhận',
            shipping: 'Vận chuyển',
            delivering: 'Chờ giao hàng',
            delivered: 'Hoàn thành',
            cancelled: 'Đã hủy',
        };

        function getStatusBadgeClass(statusKey) {
            switch (statusKey) {
                case 'pending':
                    return 'badge bg-warning';
                case 'confirmed':
                    return 'badge bg-secondary';
                case 'shipping':
                    return 'badge bg-info';
                case 'delivering':
                    return 'badge bg-primary';
                case 'delivered':
                    return 'badge bg-success';
                case 'cancelled':
                    return 'badge bg-danger';
                default:
                    return 'badge bg-secondary';
            }
        }

        function checkAllOrderStatuses() {
            orderIds.forEach(id => {
                fetch(`/api/order-status/${id}`)
                    .then(res => res.json())
                    .then(data => {
                        const el = document.getElementById(`order-status-${id}`);
                        if (el && el.dataset.status !== data.status) {
                            el.textContent = statusLabels[data.status] || 'Không xác định';
                            el.className = getStatusBadgeClass(data.status) +
                                ' rounded-pill px-3 py-2 text-white text-capitalize shadow-sm';
                            el.dataset.status = data.status; // cập nhật data-status
                        }
                    })
                    .catch(err => console.error('Lỗi trạng thái đơn hàng:', err));
            });
        }

        setInterval(checkAllOrderStatuses, 10000); // 10 giây cập nhật 1 lần

        // Thông báo tự động ẩn sau 4 giây 
        setTimeout(() => {
            document.querySelectorAll('.alert').forEach(alert => {
                alert.style.transition = 'opacity 0.5s';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            });
        }, 4000); // 4 giây
    </script>
@endsection

<div id="reviewModal" class="modal"
    style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background-color:rgba(0,0,0,0.4); z-index:9999;">
    <div class="modal-content"
        style="background:#fff; margin:10% auto; padding:20px; border-radius:8px; width:90%; max-width:500px; position:relative;">
        <span class="close" onclick="closeReviewForm()"
            style="position:absolute; top:10px; right:15px; font-size:24px; cursor:pointer;">&times;</span>
        <form id="reviewForm" method="POST" action="">
            @csrf
            <input type="hidden" name="product_id" id="reviewProductId">
            <div class="user-info mb-2">
                <strong>{{ Auth::check() ? Auth::user()->name : 'Khách' }}</strong>
                <span class="badge bg-secondary">{{ Auth::check() ? Auth::user()->role : 'Unknown' }}</span>
            </div>
            <div class="mb-2">
                <textarea name="review_text" rows="4" placeholder="Viết đánh giá của bạn..." required
                    class="form-control"></textarea>
            </div>
            <input type="hidden" name="rating" id="ratingInput" value="0">
            <div class="rating" id="starContainer">
                <i class="far fa-star star" data-value="1"></i>
                <i class="far fa-star star" data-value="2"></i>
                <i class="far fa-star star" data-value="3"></i>
                <i class="far fa-star star" data-value="4"></i>
                <i class="far fa-star star" data-value="5"></i>
            </div>
            <button type="submit" class="btn btn-primary w-100">Gửi đánh giá</button>
        </form>
    </div>
</div>


<script>
    function openReviewForm(productId) {
        const form = document.getElementById('reviewForm');
        form.action = `/order/comment/${productId}`; // hoặc dùng route nếu muốn: "{{ route('review.store', ':id') }}".replace(':id', productId)
        document.getElementById('reviewProductId').value = productId;
        document.getElementById('reviewModal').style.display = 'block';
    }

    function closeReviewForm() {
        document.getElementById('reviewModal').style.display = 'none';
        document.getElementById('reviewForm').reset();
        document.querySelectorAll('.star').forEach(star => {
            star.classList.remove('fas');
            star.classList.add('far');
        });
        document.getElementById('ratingInput').value = 0;
    }

    document.querySelectorAll('.star').forEach(star => {
        star.addEventListener('click', function () {
            const value = this.getAttribute('data-value');
            document.getElementById('ratingInput').value = value;

            document.querySelectorAll('.star').forEach(s => {
                s.classList.remove('fas');
                s.classList.add('far');
            });

            for (let i = 1; i <= value; i++) {
                document.querySelector(`.star[data-value="${i}"]`).classList.add('fas');
                document.querySelector(`.star[data-value="${i}"]`).classList.remove('far');
            }
        });
    });

    // Đóng khi click ngoài modal
    window.addEventListener('click', function (e) {
        const modal = document.getElementById('reviewModal');
        if (e.target === modal) {
            closeReviewForm();
        }
    });
</script>