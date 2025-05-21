@extends('client.master')

@section('content')
    <style>
        .cart-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            padding: 2rem 0;
            gap: 2rem;
        }

        .cart-items {
            flex: 1;
            min-width: 60%;
        }

        .cart-summary {
            flex-basis: 35%;
            padding: 1rem;
            border: 1px solid #ccc;
            border-radius: 8px;
            height: fit-content;
        }

        .cart-summary h4 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .cart-summary p {
            font-size: 1.2rem;
        }

        .progress {
            display: flex;
            justify-content: center;
            margin: 20px 0 5px;
            gap: 20px;
            font-weight: 600;
        }

        .step {
            color: #aaa;
        }

        .step.active {
            color: #000;
        }

        .timer {
            text-align: center;
            font-size: 14px;
            color: #d84315;
            margin-bottom: 20px;
        }

        .checkout-btn,
        .continue-btn {
            display: block;
            width: 100%;
            padding: 0.75rem;
            margin-top: 1rem;
            text-align: center;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
        }

        .continue-btn a {
            color: white;
            text-decoration: none;
        }

        .clear-btn {
            background: none;
            border: none;
            color: red;
            font-size: 0.9rem;
            margin-top: 10px;
        }

        .continue-btn-sm {
            background: white;
            border: 1px solid black;
        }

        .payment-icons img {
            height: 30px;
            margin: 0 8px;
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
        <td>{{ $item->product->name }}</td>
        <td>{{ number_format($item->product->price, 3) }} VND</td>
        <td>
            <div class="d-flex align-items-center gap-2">
                <form action="{{ route('cart.decrease', $item->product->id) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="  " class="btn btn-outline-secondary btn-sm">−</button>
                </form>
                <span class="mx-2">{{ $item->quantity }}</span>
                <form action="{{ route('cart.increase', $item->product->id) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-outline-secondary btn-sm">+</button>
                </form>
            </div>
        </td>
        <td>{{ number_format($item->product->price * $item->quantity, 3) }} VND</td>
        <td style="text-align: center">
            <form action="{{ route('cart.destroy', $item->product->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">
                    <i class="fa fa-trash"></i>
                </button>
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
        <p>Tổng tiền: <span class="total">0</span></p>
        <button type="submit" class="checkout-btn">Tiến hành thanh toán</button>
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

        function formatCurrency(num) {
            return new Intl.NumberFormat('vi-VN', {
                style: 'currency',
                currency: 'VND',
                minimumFractionDigits: 3
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
