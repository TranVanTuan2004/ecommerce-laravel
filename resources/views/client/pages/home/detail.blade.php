<style>
    /* Product Section */
    .product-section {
        display: flex;
        flex-wrap: wrap;
        margin-bottom: 30px;
    }

    .product-gallery {
        width: 50%;
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        grid-gap: 10px;
    }

    .product-image {
        border: 1px solid #f0f0f0;
    }

    .product-image img {
        width: 100%;
        height: auto;
        display: block;
    }

    .product-details {
        width: 50%;
        padding-left: 40px;
    }

    .product-title {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .product-price {
        font-size: 18px;
        color: #666;
        margin-bottom: 20px;
    }

    .product-description {
        color: #666;
        line-height: 1.5;
        margin-bottom: 20px;
    }

    /* Size Selection */
    .size-label {
        margin-bottom: 10px;
        color: #333;
    }

    .size-options {
        display: flex;
        margin-bottom: 10px;
    }

    .size-options a {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border: 1px solid #ddd;
        margin-right: 8px;
        color: #333;
    }

    .size-options a.active {
        background-color: #f0f0f0;
    }

    .clear-link {
        color: #666;
        font-size: 14px;
        display: inline-block;
        margin-bottom: 20px;
    }

    /* Quantity and Add to Cart */
    .quantity-container {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
    }

    .quantity-input {
        display: flex;
        border: 1px solid #ddd;
    }

    .quantity-input button {
        width: 30px;
        height: 40px;
        background: none;
        border: none;
        border-right: 1px solid #ddd;
        border-left: 1px solid #ddd;
        cursor: pointer;
    }

    .quantity-input button:first-child {
        border-left: none;
    }

    .quantity-input button:last-child {
        border-right: none;
    }

    .quantity-input input {
        width: 50px;
        height: 40px;
        text-align: center;
        border: none;
        outline: none;
    }

    .add-to-cart-btn {
        flex: 1;
        height: 40px;
        background-color: #333;
        color: white;
        border: none;
        padding: 0 20px;
        margin-left: 15px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .add-to-cart-btn i {
        margin-right: 5px;
    }

    .or-divider {
        text-align: center;
        margin: 15px 0;
        color: #666;
    }

    .buy-now-btn {
        width: 100%;
        height: 40px;
        background-color: #333;
        color: white;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        margin-bottom: 20px;
    }

    .action-btn {
        width: 40px;
        height: 40px;
        border: 1px solid #ddd;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        cursor: pointer;
    }

    /* Payment Info */
    .payment-info {
        border: 1px solid #ddd;
        padding: 20px;
        margin-bottom: 20px;
    }

    .payment-info-title {
        text-align: center;
        color: #4CAF50;
        font-weight: bold;
        margin-bottom: 15px;
    }

    .payment-methods {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }

    .payment-methods img {
        height: 24px;
    }

    .payment-security {
        text-align: center;
        font-size: 14px;
        color: #666;
    }

    /* Product Meta */
    .product-meta {
        margin-bottom: 10px;
    }

    .product-meta span {
        font-weight: bold;
        margin-right: 5px;
    }

    .payment-logos {
        display: flex;
        flex-wrap: wrap;
        gap: 16px;
        justify-content: center;
        align-items: center;
        margin-top: 20px;
    }

    .payment-logo {
        width: 100px;
        height: 80px;
        object-fit: contain;
        padding: 6px;
        border: 1px solid #ddd;
        border-radius: 6px;
        background-color: white;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .payment-logo:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }


    /* Responsive */
    @media (max-width: 768px) {

        .product-gallery,
        .product-details {
            width: 100%;
        }

        .product-details {
            padding-left: 0;
            margin-top: 20px;
        }
    }
</style>

@extends('client.master')
<!-- Main Content -->
@section('content')
    <section class="container">
        <!-- Product Section -->
        <div class="product-section">
            <!-- Product Images -->
            <div class="product-gallery">
                <div class="product-image">
                    <img src="{{ asset($product->image) }}" alt="Avatar">

                </div>
                <div class="product-image">
                    <img src="{{ asset($product->image) }}" alt="Avatar">


                </div>
                <div class="product-image">
                    <img src="{{ asset($product->image) }}" alt="Avatar">

                </div>
                <div class="product-image">
                    <img src="{{ asset($product->image) }}" alt="Avatar">

                </div>
            </div>

            <!-- Product Details -->
            <div class="product-details">
                <h1 class="product-title">{{ $product->name }}</h1>
                <p class="product-price">${{ $product->price }}</p>
                <p class="product-price"> {{ $product->brand->name ?? 'No brand' }}</p>

                <p class="product-description">{{ $product->description }}</p>


                <!-- Quantity and Add to Cart -->
                <div style="display: flex !important;  gap: 50px;  width: 100% !important; margin-bottom: 12px">
                    <div class="action-buttons">
                        <form action={{ route('favorite.toggle') }} method="POST">
                            @csrf
                            <input type="text" hidden name="product_id" value={{ $product->id }}>
                            <button type="submit" class="action-btn">
                                @if (Auth::check())
                                    @if (Auth::user()->wishlist->contains($product->id))
                                        <i class="fas fa-heart text-danger"></i>
                                    @else
                                        <i class="fas fa-heart text-secondary"></i>
                                    @endif
                                @else
                                    <i class="fas fa-heart text-secondary"></i>
                                @endif
                            </button>
                        </form>
                    </div>
                    <form class="add-to-cart-btn" style="border-radius: 6px;" action="{{ route('cart.addToCart') }}"
                        method="POST">
                        @csrf
                        <input type="text" hidden name="product_id" value="{{ $product->id }}">
                        <button type="submit" class="add-to-cart-btn" style="border-radius: 6px;">
                            🛒 ADD TO CART
                        </button>
                    </form>

                </div>

                <div class="or-divider">OR</div>

                <form action={{ route('checkout.index') }} method="POST"
                    style="display: flex !important; gap: 50px;  width: 100% !important; margin-bottom: 12px">
                    @csrf
                    <div class="quantity-input">
                        <input type="number" name="quantity" min="1" max="100" value="1">
                    </div>
                    <input hidden type="text" name="productId" value="{{ $product->id }}" checked>
                    <button type="submit" class="add-to-cart-btn"
                        style="display: block !important; width: 100% !important; border-radius: 6px">
                        🛒 BUY NOW
                    </button>
                </form>



                <!-- Payment Info -->
                <div class="payment-info">
                    <p class="payment-info-title">GUARANTEED SAFE CHECKOUT</p>
                    <div class="payment-logos">
                        <img class="payment-logo" src="{{ asset('storage/paymentlogo/vnpay.png') }}" alt="VNPAY">
                        <img class="payment-logo" src="{{ asset('storage/paymentlogo/momo.png') }}" alt="MOMO">
                        <img class="payment-logo" src="{{ asset('storage/paymentlogo/zalo.png') }}" alt="ZaloPay">
                        <img class="payment-logo" src="{{ asset('storage/paymentlogo/paypal.png') }}" alt="PayPal">
                        <img class="payment-logo" src="{{ asset('storage/paymentlogo/bank.png') }}" alt="Stripe">
                    </div>

                    <p class="payment-security">Your Payment is 100% Secure</p>
                </div>

                <!-- Product Details -->
                <div class="product-meta">
                    <p><span>Brand:</span> {{ $product->brand->name ?? 'No brand' }}</p>
                </div>
                <div class="product-meta">
                    <p><span>SKU:</span> 12345</p>
                </div>
                <div class="product-meta">
                    <p><span>Category:</span>{{ $product->category->name ?? 'No category' }}</p>
                </div>
            </div>
        </div>
        @include('client.components.review', ['reviews' => $reviews])
    </section>
@endsection
