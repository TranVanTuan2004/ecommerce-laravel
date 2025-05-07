<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>10K Yellow Gold - Marseille</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            background-color: #fff;
            color: #333;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }

        /* Header Styles */
        header {
            padding: 15px 0;
            border-bottom: 1px solid #eee;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .social-icons a {
            display: inline-block;
            width: 30px;
            height: 30px;
            background-color: #333;
            color: white;
            border-radius: 50%;
            text-align: center;
            line-height: 30px;
            margin-right: 8px;
        }

        nav {
            display: flex;
        }

        nav a {
            margin: 0 15px;
            font-size: 14px;
            color: #333;
        }

        .logo {
            text-align: center;
        }

        .logo h1 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 0;
        }

        .logo p {
            font-size: 10px;
            color: #777;
            text-transform: uppercase;
        }

        .user-actions {
            display: flex;
            align-items: center;
        }

        .user-actions a {
            margin-left: 15px;
            font-size: 14px;
            position: relative;
        }

        .user-actions .icon-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background-color: #333;
            color: white;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
        }

        /* Breadcrumb */
        .breadcrumb {
            display: flex;
            padding: 15px 0;
            color: #888;
            font-size: 13px;
        }

        .breadcrumb a:hover {
            color: #333;
        }

        .breadcrumb-separator {
            margin: 0 8px;
        }

        .return-link {
            margin-left: auto;
        }

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
</head>

<body>
    <!-- Header -->
    <header>
        <div class="container">
            <div class="header-content">
                <!-- Social Links -->
                <div class="social-icons">
                    <a href="#"><span>f</span></a>
                    <a href="#"><span>i</span></a>
                    <a href="#"><span>y</span></a>
                </div>

                <!-- Navigation -->
                <nav>
                    <a href="#">Elements</a>
                    <a href="#">Our Shop</a>
                    <a href="#">About us</a>
                </nav>

                <!-- Logo -->
                <div class="logo">
                    <h1>Marseille</h1>
                    <p>XSTORE THEME</p>
                </div>

                <!-- Right Links -->
                <div class="user-actions">
                    <a href="#">Contacts</a>
                    <a href="#">Search</a>
                    <a href="#">Sign In</a>
                    <a href="#">
                        <span class="icon-badge">1</span>
                        <span>🔔</span>
                    </a>
                    <a href="#">
                        <span class="icon-badge">1</span>
                        <span>❤️</span>
                    </a>
                    <a href="#">
                        <span class="icon-badge">0</span>
                        <span>🛒</span>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container">
        <!-- Breadcrumb -->
        <div class="breadcrumb">
            <a href="#">Home</a>
            <span class="breadcrumb-separator">></span>
            <a href="#">Men</a>
            <a href="#" class="return-link">Return to previous page</a>
        </div>

        <!-- Product Section -->
        <div class="product-section">
            <!-- Product Images -->
            <div class="product-gallery">
                <div class="product-image">
                    <img src="https://via.placeholder.com/400x450" alt="Product Front">
                </div>
                <div class="product-image">
                    <img src="https://via.placeholder.com/400x450" alt="Product Detail">
                </div>
                <div class="product-image">
                    <img src="https://via.placeholder.com/400x450" alt="Product Back">
                </div>
                <div class="product-image">
                    <img src="https://via.placeholder.com/400x450" alt="Product Full">
                </div>
            </div>

            <!-- Product Details -->
            <div class="product-details">
                <h1 class="product-title">{{ $product->name }}</h1>
                <p class="product-price">${{ $product->price }}</p>
                <p class="product-price"> {{ $product->brand->name ?? 'No brand' }}</p>

                <p class="product-description">{{ $product->description }}</p>

                <!-- Size Selection -->
                <div>
                    <p class="size-label">Size M</p>
                    <div class="size-options">
                        <a href="#">L</a>
                        <a href="#" class="active">M</a>
                        <a href="#">S</a>
                    </div>
                    <a href="#" class="clear-link">Clear</a>
                </div>

                <!-- Quantity and Add to Cart -->
                <div class="quantity-container">
                    <div class="quantity-input">
                        <button>-</button>
                        <input type="text" value="1">
                        <button>+</button>
                    </div>
                    <button class="add-to-cart-btn">
                        🛒 ADD TO CART
                    </button>
                </div>

                <div class="or-divider">OR</div>

                <button class="buy-now-btn">
                    ⚡ BUY NOW
                </button>

                <div class="action-buttons">
                    <button class="action-btn">❤</button>
                    <button class="action-btn">🔄</button>
                </div>

                <!-- Payment Info -->
                <div class="payment-info">
                    <p class="payment-info-title">GUARANTEED SAFE CHECKOUT</p>
                    <div class="payment-methods">
                        <img src="/api/placeholder/50/30" alt="Visa">
                        <img src="/api/placeholder/50/30" alt="MasterCard">
                        <img src="/api/placeholder/50/30" alt="PayPal">
                        <img src="/api/placeholder/50/30" alt="American Express">
                        <img src="/api/placeholder/50/30" alt="Maestro">
                        <img src="/api/placeholder/50/30" alt="Bitcoin">
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
    </main>
</body>

</html>