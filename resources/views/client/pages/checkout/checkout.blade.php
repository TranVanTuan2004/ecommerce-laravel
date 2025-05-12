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

            <div class="d-flex flex-wrap align-items-center">
                <div class="me-2">
                    <strong>{{ $user->name }}</strong> (<strong>(+84) {{ $user->phone }}</strong>)
                </div>
                <div class="me-2">
                    {{ $user->address }}
                </div>
                <span class="badge bg-light text-danger border border-danger me-2">Mặc Định</span>
                <a href="#" class="text-primary">Thay Đổi</a>
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

            @foreach ($products as $product)
                @php
                    $totalProduct += $product->quantity;
                    $totalPrice += $product->price * $product->quantity;
                @endphp
                <div class="d-flex mb-2 align-products-start border-bottom pb-2">
                    <img src="https://via.placeholder.com/40" class="product-img me-2"
                        style="width: 80px; height: 80px; object-fit: cover;" alt="Sữa rửa mặt">
                    <div class="flex-grow-1">
                        <div>{{ $product->name }}</div>
                        <div class="text-small text-muted">₫{{ number_format($product->price, 3) }}</div>
                    </div>
                    <div class="me-3">{{ $product->quantity }}</div>
                    <div class="ms-3" style="min-width: 100px">
                        {{ number_format($product->price * $product->quantity, 3) }}</div>
                </div>
            @endforeach

            <!-- Giao hàng và voucher -->
            <div class="row g-3 align-items-center border-top pt-3">
                <div class="col-md-6">
                    <span>Phương thức vận chuyển:</span><br>
                    <span class="text-success">🚚 Nhanh</span> <a href="#" class="ms-2 text-primary">Thay
                        Đổi</a><br>
                    <small class="text-muted">Đảm bảo nhận hàng từ 13 - 15 Tháng 5</small><br>
                    <small class="text-muted">+ ₫16.500</small>
                </div>
                <div class="col-md-6 text-end">
                    <strong>Tổng số tiền ({{ $totalProduct }} sản phẩm):</strong><br>
                    <span class="fs-5 text-danger">₫{{ number_format($totalPrice, 3) }}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="container border rounded p-4 my-4">

        <!-- Shopee Voucher -->
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
                <button type="button" class="btn btn-outline-secondary">Thẻ Tín dụng/Ghi nợ</button>
                <button type="button" class="btn btn-outline-danger active">Thanh toán khi nhận hàng</button>
            </div>
            <div class="text-muted">
                Thanh toán khi nhận hàng &nbsp; | &nbsp; Phí thu hộ: ₫0 VND. Ưu đãi về phí vận chuyển (nếu có) áp dụng
                cả
                với phí thu hộ.
            </div>
        </div>

        <!-- Tổng tiền -->
        <div class="text-end">
            <div class="mb-1">Tổng tiền hàng: <strong>₫607.700</strong></div>
            <div class="mb-1">Tổng tiền phí vận chuyển: <strong>₫124.600</strong></div>
            <div class="h5 text-danger">Tổng thanh toán: <strong>₫732.300</strong></div>
        </div>

        <!-- Ghi chú và nút đặt hàng -->
        <div class="d-flex justify-content-between align-items-center mt-3">
            <small class="text-muted">
                Khi nhấn 'Đặt hàng', bạn xác nhận rằng bạn đồng ý với
                <a href="#" class="text-primary">Điều khoản</a> của chúng tôi.
            </small>
            <button class="btn btn-danger px-4">Đặt hàng</button>
        </div>

    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('open-voucher-modal').addEventListener('click', function(e) {
                e.preventDefault();

                // Gửi AJAX tới route Laravel để lấy danh sách voucher
                fetch('/vouchers/list')
                    .then(response => response.text())
                    .then(html => {
                        document.getElementById('voucher-list').innerHTML = html;

                        // Khởi động modal Bootstrap
                        const modal = new bootstrap.Modal(document.getElementById('voucherModal'));
                        modal.show();

                        // Gắn sự kiện click cho các nút chọn voucher
                        document.querySelectorAll('.select-voucher').forEach(btn => {
                            btn.addEventListener('click', function() {
                                const code = this.getAttribute('data-code');
                                const name = this.getAttribute('data-name');

                                // Gán vào input hidden để submit form
                                document.getElementById('selected-voucher-code').value =
                                    code;

                                // Gán hiển thị tên voucher (tùy chọn)
                                document.querySelector('span#selected-voucher-name')
                                    ?.remove();
                                this.insertAdjacentHTML('afterend',
                                    `<span id="selected-voucher-name" class="text-success ms-2">${name}</span>`
                                );

                                modal.hide();
                            });
                        });
                    });
            });
        });
    </script>
@endsection
