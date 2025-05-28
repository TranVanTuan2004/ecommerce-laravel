@extends('client.master')

@section('content')
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f5f7fa;
        }

        .step .circle {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            line-height: 28px;
            font-size: 14px;
            font-weight: bold;
            display: inline-block;
            text-align: center;
            border: 1px solid #ccc;
            color: #999;
            background-color: #f8f9fa;
        }

        .step.active .circle {
            background-color: #111;
            color: white;
            border-color: #111;
        }

        .step .label {
            font-size: 14px;
            margin-top: 4px;
            color: #999;
            letter-spacing: 0.5px;
        }

        .step.active .label {
            color: #111;
            font-weight: 500 !important;
        }

        .line {
            width: 120px;
            height: 1px;
            background-color: #ccc;
        }

        .checkout-steps {
            border-bottom: 1px solid #eee;
        }

        .cart-container {
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
            padding: 1rem 0;
        }

        .cart-items {
            flex: 2;
            background-color: #fff;
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .cart-items table {
            width: 100%;
            border-collapse: collapse;
        }

        .cart-items th,
        .cart-items td {
            padding: 1rem;
            border-bottom: 1px solid #eee;
            text-align: center;
        }

        .cart-items th {
            background-color: #f0f0f0;
            color: #333;
        }

        .cart-summary {
            flex: 1;
            background-color: #fff;
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            height: fit-content;
        }

        .cart-summary h4 {
            margin-bottom: 1rem;
            font-weight: 600;
            color: #333;
        }

        .cart-summary p {
            font-size: 1.2rem;
            font-weight: bold;
            color: #007bff;
        }

        .checkout-btn {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 0.75rem;
            border-radius: 5px;
            width: 100%;
            margin-top: 1rem;
        }

        .continue-btn {
            border: 1px solid #007bff;
            color: #007bff;
            background-color: transparent;
            padding: 0.75rem;
            border-radius: 5px;
            width: 100%;
            text-align: center;
            margin-top: 0.5rem;
            text-decoration: none;
            display: inline-block;
        }

        .continue-btn a {
            color: inherit;
            text-decoration: none;
        }

        .clear-btn {
            background: none;
            border: none;
            color: red;
            font-size: 0.9rem;
            margin-top: 1rem;
            cursor: pointer;
        }

        .timer {
            font-size: 14px;
            color: #e53935;
            margin-top: 10px;
        }

        .quantity-controls button {
            padding: 0.25rem 0.5rem;
            font-size: 14px;
        }

        .badge {
            font-size: 11px;
            padding: 2px 6px;
            border-radius: 3px;
        }

        @media (max-width: 768px) {
            .cart-container {
                flex-direction: column;
            }

            .line {
                display: none;
            }
        }
    </style>

    <div class="checkout-steps py-5 bg-light">
        <div class="d-flex justify-content-center align-items-center gap-3 mb-2">
            <!-- Step 1 -->
            <div class="d-flex gap-2 align-items-center text-center step active">
                <div class="circle">1</div>
                <div class="label">SHOPPING CART</div>
            </div>
            <div class="line"></div>
            <!-- Step 2 -->
            <div class="d-flex gap-2 align-items-center text-center step">
                <div class="circle">2</div>
                <div class="label">CHECKOUT</div>
            </div>
            <div class="line"></div>
            <!-- Step 3 -->
            <div class="d-flex gap-2 align-items-center text-center step">
                <div class="circle">3</div>
                <div class="label">ORDER STATUS</div>
            </div>
        </div>

        <!-- Countdown -->
        <div class="text-center fw-light font-monospace text-secondary">
            🔥 Hurry up, these products are limited, checkout within <strong id="countdown">03:00</strong>
        </div>
    </div>
    {{-- Modal xác nhận xóa toàn bộ --}}
    <form id="clearAllCart" action="{{ route('cart.clearAllCart') }}" method="POST">@csrf @method('DELETE')</form>
    <div class="modal fade" id="confirmClearModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Xác nhận xoá giỏ hàng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">Bạn có chắc muốn xoá toàn bộ giỏ hàng?</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Huỷ</button>
                    <button type="submit" form="clearAllCart" class="btn btn-danger">Xoá</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Form chính: chọn sản phẩm và thanh toán --}}
    <div>
        <form action="{{ route('checkout.index') }}" method="POST" class="cart-container container">
            @csrf

            <div class="cart-items">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th><input type="checkbox" class="checked-all"></th>
                            <th>Sản phẩm</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cart->items as $item)
                            <tr>
                                <td>
                                    <input type="checkbox" name="products[]" value="{{ $item->product->id }}"
                                        class="cart-item-checkbox"
                                        data-price="{{ $item->product->price * $item->quantity }}">
                                </td>
        </form>
        <td>
            <div class="d-flex gap-3 align-items-center">
                <img src="{{ asset($item->product->image) }}" alt="{{ $item->product->name }}"
                    style="width: 60px; height: 60px; object-fit: cover; border-radius: 4px;">
                <div>
                    <div style="font-weight: 500; color: #333; max-width: 300px;">
                        {{ \Illuminate\Support\Str::limit($item->product->name, 25) }}</div>
                </div>
            </div>
        </td>
        <td class="text-center align-middle">
            <div style="font-weight: 600; color: #111;">
                {{ number_format($item->product->price, 0) }}₫
            </div>
        </td>
        <td class="text-center align-middle">
            <div class="d-flex justify-content-center align-items-center border rounded" style="width: 110px;">
                <form action="{{ route('cart.decrease', $item->product->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-sm border-0">−</button>
                </form>
                <span style="margin: 0 10px;">{{ $item->quantity }}</span>
                <form action="{{ route('cart.increase', $item->product->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-sm border-0">+</button>
                </form>
            </div>
        </td>
        <td class="text-center align-middle" style="color: #ee4d2d; font-weight: 600;">
            {{ number_format($item->product->price * $item->quantity, 0) }}₫
        </td>
        <td class="text-center align-middle" class="text-center">
            <form action="{{ route('cart.destroy', $item->product->id) }}" method="POST" onsubmit="return confirmDelete()"
                style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" style="background-color: #ee4d2d" class="btn text-white">🗑</button>
            </form>
        </td>
        </tr>
        @endforeach
        </tbody>
        </table>

        <button type="button" class="clear-btn" data-bs-toggle="modal" data-bs-target="#confirmClearModal">
            🗑 Xoá toàn bộ giỏ hàng
        </button>
    </div>

    <div class="cart-summary">
        <h4>Tổng đơn hàng</h4>
        <p style="color: #ee4d2d; font-weight: bold;">Tổng tiền: <span class="total">0</span></p>
        <button type="submit" class="checkout-btn" style="background-color: #ee4d2d">Tiến hành thanh toán</button>
        <button class="continue-btn" style="background-color: white !important; outline: 1px solid black !important; ">
            <a href="{{ route('homePage') }}" style="color:black !important;">Tiếp tục mua hàng</a>
        </button>
    </div>
    </div>
@endsection

@section('scripts')
    <script>
        const checkboxes = document.querySelectorAll('.cart-item-checkbox');
        const checkedAll = document.querySelector('.checked-all');
        const totalSpan = document.querySelector('.total');

        function confirmDelete() {
            return confirm('Bạn có chắc chắn muốn xóa không?');
        }

        function formatCurrency(num) {
            return new Intl.NumberFormat('vi-VN', {
                style: 'currency',
                currency: 'VND',
                minimumFractionDigits: 0
            }).format(num);
        }

        function updateTotal() {
            let total = 0;
            checkboxes.forEach(cb => {
                if (cb.checked) {
                    total += parseFloat(cb.dataset.price);
                }
            });
            totalSpan.textContent = formatCurrency(total);
        }

        checkboxes.forEach(cb => {
            cb.addEventListener('change', () => {
                checkedAll.checked = false;
                updateTotal();
            });
        });

        checkedAll.addEventListener('change', () => {
            checkboxes.forEach(cb => cb.checked = checkedAll.checked);
            updateTotal();
        });
    </script>
@endsection
