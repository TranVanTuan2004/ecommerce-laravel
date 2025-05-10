<style>
    .cart-count {
        background: black;
        color: white;
        padding: 2px 6px;
        font-size: 12px;
        border-radius: 50%;
        margin-left: 4px;
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

    .cart-container {
        display: flex;
        margin: auto;
        gap: 40px;
        margin-top: 50px;
        margin-bottom: 50px;
    }

    .cart-items {
        flex: 2;
    }

    .cart-items h3 {
        margin-bottom: 10px;
    }

    .cart-row {
        display: flex;
        align-items: center;
        border-bottom: 1px solid #ccc;
        padding-bottom: 10px;
        margin-bottom: 20px;
        gap: 20px;
    }

    .cart-row img {
        width: 60px;
    }

    .details {
        flex: 1;
    }

    .price,
    .sku,
    .subtotal {
        width: 100px;
        text-align: center;
    }

    .qty {
        width: 60px;
        padding: 5px;
    }

    .coupon {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .coupon input {
        padding: 8px;
        width: 200px;
    }

    .clear-btn {
        margin-left: auto;
        padding: 8px 16px;
        border: 1px solid #aaa;
        background: white;
        cursor: pointer;
    }

    .cart-summary {
        flex: 1;
        border: 1px solid #ccc;
        padding: 20px;
        height: fit-content;
        align-self: flex-start;
    }

    .cart-summary h4 {
        margin-bottom: 15px;
    }

    .cart-summary p {
        display: flex;
        justify-content: space-between;
        margin: 10px 0;
    }

    .total {
        font-weight: bold;
        font-size: 16px;
        margin-top: 20px;
    }

    .checkout-btn,
    .continue-btn {
        font-size: 14px;
        width: 100%;
        padding: 12px;
        margin-top: 10px;
        font-weight: bold;
        cursor: pointer;
        border: none;
    }

    .checkout-btn {
        background: black;
        color: white;
    }

    .continue-btn {
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

    thead tr {
        border-bottom: 1px solid #9fa7a7 !important;
    }

    th {
        padding: 12px 0 !important;
    }

    td {
        padding: 12px 0 !important;
        border: none !important;
    }
</style>


@extends('client.master')

@section('content')
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

    <div class="cart-container container">
        <div class="cart-items">
            <table class="table w-100">
                <colgroup>
                    <col style="width: 10%;">
                    <col style="width: 35%;">
                    <col style="width: 15%;">
                    <col style="width: 10%;">
                    <col style="width: 15%;">
                    <col style="width: 15%;">
                </colgroup>
                <thead>
                    <tr>
                        <th>Select</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>SKU</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cart->items as $item)
                        <tr>
                            <td class="">
                                <input type="checkbox">
                            </td>
                            <td class="d-flex gap-2">
                                <img style="width: 80px; height: 100px;" class="" src="https://via.placeholder.com/60"
                                    alt="Product" />
                                <div class="fw-semibold" style="margin-right: 12px !important">
                                    {{ $item->product->name }}</div>
                            </td>
                            <td class="">
                                ${{ number_format($item->product->price, 2) }}
                            </td>
                            <td class="text-muted">
                                {{ $item->product->id }}
                            </td>
                            <td>
                                <div class="d-flex align-items-center justify-content-start">
                                    <form action="{{ route('cart.decrease', $item->product->id) }}" method="POST"
                                        class="m-0">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-secondary btn-sm">−</button>
                                    </form>
                                    <span class="px-2">{{ $item->quantity }}</span>
                                    <form action="{{ route('cart.increase', $item->product->id) }}" method="POST"
                                        class="m-0">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-secondary btn-sm">+</button>
                                    </form>
                                </div>

                            </td>
                            <td class="fw-bold ">
                                ${{ number_format($item->product->price * $item->quantity, 2) }}
                            </td>
                            <td class="text-center">
                                <form action={{ route('cart.destroy', $item->product->id) }} method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        style="outline: none; border: none; background-color: transparent;">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="coupon">
                <input type="text" placeholder="Coupon code" />
                <button>OK</button>
                <form action="{{ route('cart.clearAllCart') }}" method="POST" class="m-0">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="clear-btn">🗑 Clear Shopping Cart</button>
                </form>
            </div>
        </div>

        <section class="cart-summary">
            <h4>Cart Totals</h4>
            <p>Subtotal: <span>$99.99</span></p>
            <p class="total">TOTAL: <strong>$99.99</strong></p>
            <button class="checkout-btn">PROCEED TO CHECKOUT</button>
            <button class="continue-btn">CONTINUE SHOPPING</button>
        </section>
    </div>
@endsection
