<style>
    .product-img {
        width: 40px;
        height: auto;
    }

    .text-small {
        font-size: 0.9rem;
        color: #555;
    }

    .border-bottom-dashed {
        border-bottom: 1px dashed #ccc;
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
@extends('client.master')

@section('content')
    <div class="checkout-steps py-5 bg-light">
        <div class="d-flex justify-content-center align-items-center gap-3 mb-2">
            <!-- Step 1 -->
            <div class="d-flex gap-2 align-items-center text-center step">
                <div class="circle">1</div>
                <div class="label">SHOPPING CART</div>
            </div>
            <div class="line"></div>
            <!-- Step 2 -->
            <div class="d-flex gap-2 align-items-center text-center step active ">
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
        <div class="text-center fw-light font-monospace text-secondary">
            🔥 Hurry up, these products are limited, checkout within <strong id="countdown">03:00</strong>
        </div>
    </div>
    <div class="container my-4">
        <div class=" border rounded p-3">
            <div class="d-flex align-items-center mb-2">
                <span class="text-danger me-2">📍</span>
                <strong class="text-danger">Địa Chỉ Nhận Hàng</strong>
            </div>

            <div class="">
                <div class="me-2">
                    Tên: <strong>{{ $user->name }}</strong> <br> Số điện thoại: <strong>
                        {{ $user->phone }}</strong>
                </div>
                <div class="me-2">
                    Địa chỉ: <strong>{{ $user->address }}</strong>
                </div>
                <div class="mt-2">
                    <a href={{ route('auth.profile') }}
                        class="btn btn-adn outline-amber-700 badge bg-light text-danger border border-danger me-2"
                        style="color: #ee4d2d; text-decoration: none">Thay Đổi</a>
                </div>

            </div>
        </div>
    </div>

    <div class="container my-4">
        <h5>Sản phẩm</h5>
        <div class="border rounded p-3 mb-5">
            @php
                $totalProduct = 0;
                $totalPrice = 0;
            @endphp
            <form action="{{ route('checkout.store') }}" method="POST">
                @csrf
                @if (isset($product))
                    @php
                        $totalProduct += $product->quantity;
                        $totalPrice += $product->price * $product->quantity;
                    @endphp
                    <input hidden type="text" name="product_id" value="{{ $product->id }}">
                    <input hidden type="text" name="quantity" value="{{ $quantity }}">
                    <div class="d-flex mb-2 align-products-start border-bottom pb-2">
                        <img src={{ asset($product->image) }} class="product-img me-2"
                            style="width: 80px; height: 80px; object-fit: cover;" alt="Sữa rửa mặt">
                        <div class="flex-grow-1">
                            <div>{{ $product->name }}</div>
                            <div class="text-small text-muted">₫{{ number_format($product->price, 0) }}</div>
                        </div>
                        <div class="me-3">{{ $product->quantity }}</div>
                        <div class="ms-3" style="min-width: 100px">
                            {{ number_format($product->price * $product->quantity, 0) }}</div>
                    </div>
                @else
                    @foreach ($products as $product)
                        <input hidden type="checkbox" name="product_ids[]" value="{{ $product->id }}" checked>
                        @php
                            $totalProduct += $product->quantity;
                            $totalPrice += $product->price * $product->quantity;
                        @endphp
                        <div class="d-flex mb-2 align-products-start border-bottom pb-2">
                            <img src={{ asset($product->image) }} class="product-img me-2"
                                style="width: 80px; height: 80px; object-fit: cover;" alt="Sữa rửa mặt">
                            <div class="flex-grow-1">
                                <div>{{ $product->name }}</div>
                                <div class="text-small text-muted">₫{{ number_format($product->price, 0) }}</div>
                            </div>
                            <div class="me-3">{{ $product->quantity }}</div>
                            <div class="ms-3" style="min-width: 100px">
                                {{ number_format($product->price * $product->quantity, 0) }}</div>
                        </div>
                    @endforeach
                @endif


                <!-- Giao hàng và voucher -->
                <div class="row g-3 align-items-center border-top pt-3">
                    <div class="col-md-6">
                        <span>Phương thức vận chuyển:</span><br>
                        <span class="text-success">🚚 Nhanh</span>
                    </div>
                    <div class="col-md-6 text-end">
                        <strong>Tổng số tiền ({{ $totalProduct }} sản phẩm):</strong><br>
                        <span class="fs-5 text-danger">₫{{ number_format($totalPrice, 0) }}</span>
                    </div>
                </div>
        </div>
        <div class="container border rounded p-4 my-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <i class="bi bi-ticket-perforated text-danger me-2"></i>
                    <strong>Voucher</strong>
                </div>
                <div>
                    <a href="#" id="open-voucher-modal" class="text-primary">Chọn Voucher</a>
                </div>
            </div>

            <!-- Hidden input để gửi mã voucher khi submit form -->
            <input type="hidden" name="voucher_code" id="selected-voucher-code">

            <!-- Modal -->
            <div class="modal fade" id="voucherModal" tabindex="-1" aria-labelledby="voucherModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable" style="max-width: 600px;">
                    <div class="modal-content" style="max-height: 500px;">
                        <div class="modal-header">
                            <h5 class="modal-title">Chọn Voucher</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body" id="voucher-list">
                            <!-- AJAX sẽ load danh sách voucher ở đây -->
                        </div>
                    </div>
                </div>
            </div>


            <!-- Phương thức thanh toán -->
            <div class="border-top border-bottom py-3 mb-3">
                <h6>Phương thức thanh toán</h6>
                <div class="btn-group mb-2" role="group">
                    <button onclick="return message()" type="button" class="btn btn-outline-secondary">Thẻ Tín dụng/Ghi
                        nợ</button>
                    <button type="button" class="btn btn-outline-danger active">Thanh toán khi nhận hàng</button>
                </div>
            </div>

            <!-- Tổng tiền -->
            <div class="text-end">
                <div class="mb-1">Tổng tiền hàng: <strong>đ{{ number_format($totalPrice, 0) }}</strong></div>
                <div class="mb-1 discount">Giảm giá: <strong>₫0</strong></div>
                <div class="h5 text-danger total">Tổng thanh toán:
                    <strong>₫{{ number_format($totalPrice, 0) }}</strong>
                </div>
            </div>

            <!-- Ghi chú và nút đặt hàng -->
            <div class="d-flex justify-content-end align-items-center mt-3">
                <button type="submit" class="btn btn-danger px-4">Đặt hàng</button>
            </div>
            </form>
        </div>
    </div>

    <script>
        const formatCurrencyVN = (number) => {
            return new Intl.NumberFormat('vi-VN', {
                style: 'currency',
                currency: 'VND',
                minimumFractionDigits: 0
            }).format(number);
        };

        const message = () => {
            confirm('Tính năng đang phát triển');
        }
        document.addEventListener('DOMContentLoaded', function() {
            const modalElement = document.getElementById('voucherModal');
            const modal = new bootstrap.Modal(modalElement);

            let originalTotal = {{ $totalPrice }}; // tổng tiền sản phẩm từ backend

            document.getElementById('open-voucher-modal').addEventListener('click', function(e) {
                e.preventDefault();

                fetch('/checkout/getAllVouchers')
                    .then(response => response.text())
                    .then(html => {
                        document.getElementById('voucher-list').innerHTML = html;
                        modal.show();

                        document.querySelectorAll('.select-voucher').forEach(btn => {
                            btn.addEventListener('click', function() {
                                const code = this.dataset.code;
                                const name = this.dataset.name;
                                const percent = parseFloat(this.dataset.percent);

                                // Tính số tiền giảm
                                const discountAmount = Math.round(originalTotal * (
                                    percent / 100));

                                const newPrice = originalTotal - discountAmount;

                                // Gán vào input hidden
                                document.getElementById('selected-voucher-code').value =
                                    code;

                                // Hiển thị tên voucher
                                document.querySelector('#selected-voucher-name')
                                    ?.remove();
                                this.insertAdjacentHTML('afterend',
                                    `<span id="selected-voucher-name" class="text-success ms-2">${name}</span>`
                                );

                                // Hiển thị giảm giá
                                if (!document.querySelector('#voucher-discount-line')) {
                                    const newLine = document.createElement('div');
                                    newLine.id = 'voucher-discount-line';
                                    newLine.className = 'mb-1 text-end';
                                    newLine.innerHTML =
                                        `Giảm giá (${Math.round(percent)}%): <strong class="text-success">₫${formatCurrencyVN(discountAmount)}</strong>`;
                                    document.querySelector('.text-end').insertBefore(
                                        newLine, document.querySelector('.text-end')
                                        .children[2]);
                                } else {
                                    document.querySelector('#voucher-discount-line')
                                        .innerHTML =
                                        `Giảm giá (${Math.round(percent)}%): <strong class="text-success">₫${formatCurrencyVN(discountAmount)}</strong>`;
                                }

                                // Cập nhật tổng thanh toán
                                document.querySelector('.discount strong')
                                    .textContent =
                                    `₫${formatCurrencyVN(discountAmount)}`;
                                document.querySelector('.total strong')
                                    .textContent = `₫${formatCurrencyVN(newPrice)}`;
                                modal.hide();
                            });
                        });
                    });
            });
        });
    </script>
@endsection
