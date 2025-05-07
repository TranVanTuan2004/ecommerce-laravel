<style>
    body {
        font-family: 'Courier New', Courier, monospace;
        margin: 0;
        padding: 0;
        background: #fff;
        color: #111;
    }

    a {
        text-decoration: none;
        color: inherit;
    }

    header {
        border-bottom: 1px solid #ddd;
        padding: 20px 40px;
    }

    .top-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .logo {
        font-size: 22px;
        font-weight: bold;
    }

    .logo span {
        font-size: 12px;
        color: #888;
    }

    nav a {
        margin: 0 12px;
        font-size: 14px;
    }

    .actions {
        display: flex;
        align-items: center;
        gap: 15px;
    }

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

    main.cart-container {
        display: flex;
        max-width: 1200px;
        margin: auto;
        padding: 20px 40px;
        gap: 40px;
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

    footer {
        background: #f9f9f9;
        text-align: center;
        padding: 30px;
        margin-top: 40px;
    }

    .payment-icons img {
        height: 30px;
        margin: 0 8px;
    }
</style>

@extends('client.master')

@section('content')
    <main class="cart-container">
        <section class="cart-items">
            <h3>Product</h3>
            @foreach ($cart->items as $item)
                <div class="cart-row">
                    <img src="https://via.placeholder.com/60" alt="Product" />
                    <div class="details">
                        <p>{{ $item->product->name }}</p>
                        <small>Size: M</small>
                    </div>
                    <div class="price">{{ $item->product->price }}</div>
                    <div class="sku">{{ $item->product->id }}</div>
                    <button>{{ $item->quantity }}</button>
                    <div class="subtotal">$99.99</div>
                </div>
            @endforeach


            <div class="coupon">
                <input type="text" placeholder="Coupon code" />
                <button>OK</button>
                <button class="clear-btn">🗑 Clear Shopping Cart</button>
            </div>
        </section>

        <section class="cart-summary">
            <h4>Cart Totals</h4>
            <p>Subtotal: <span>$99.99</span></p>
            <p class="total">TOTAL: <strong>$99.99</strong></p>
            <button class="checkout-btn">PROCEED TO CHECKOUT</button>
            <button class="continue-btn">CONTINUE SHOPPING</button>
        </section>
    </main>
@endsection
