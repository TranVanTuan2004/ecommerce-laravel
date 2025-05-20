<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marseille XStore Theme</title>
    <!-- Stylesheets -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Custom CSS */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
        }

        /* Header Styles */
        .social-icons a {
            color: #333;
            margin-right: 15px;
            font-size: 18px;
        }

        .logo a {
            text-decoration: none;
            color: #333;
        }

        .logo h1 {
            font-size: 28px;
            font-weight: 500;
        }

        .tagline {
            font-size: 12px;
            letter-spacing: 2px;
        }

        .header-actions a {
            color: #333;
            text-decoration: none;
            font-size: 14px;
        }

        .cart-count {
            position: absolute;
            top: -8px;
            right: -8px;
            background-color: #000;
            color: #fff;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Navigation */
        .main-navigation {
            border-top: 1px solid #eee;
            border-bottom: 1px solid #eee;
            padding: 10px 0;
        }

        .nav-link {
            color: #333;
            font-weight: 500;
            padding: 8px 20px;
            transition: color 0.3s;
        }

        .nav-link:hover,
        .nav-link.active {
            color: #000;
        }

        /* Banner */
        .banner-section {
            background-color: #f5f5f5;
            padding: 60px 0;
        }

        .countdown-box {
            display: inline-block;
            min-width: 80px;
            text-align: center;
            margin: 0 5px;
        }

        /* Product Cards */
        .product-card {
            margin-bottom: 30px;
            transition: transform 0.3s;
        }

        .product-card:hover {
            transform: translateY(-5px);
        }

        .product-image {
            position: relative;
            overflow: hidden;
        }

        .color-options {
            display: flex;
            gap: 5px;
        }

        .color-btn {
            width: 20px;
            height: 20px;
            border: none;
            border-radius: 50%;
            padding: 0;
        }

        .product-title {
            margin: 10px 0 5px;
            font-weight: 500;
        }

        .product-brand {
            font-size: 12px;
            color: #777;
        }

        .sale-price {
            font-weight: 600;
            color: #333;
        }

        .original-price {
            font-size: 12px;
            margin-left: 5px;
        }

        /* Footer */
        .site-footer {
            background-color: #222;
            color: #fff;
            padding: 60px 0 30px;
        }

        .footer-heading {
            font-size: 16px;
            font-weight: 500;
        }

        .site-footer a {
            color: #bbb;
            transition: color 0.3s;
        }

        .site-footer a:hover {
            color: #fff;
        }

        /* Utilities */
        .website-counter {
            position: fixed;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            background-color: #000;
            color: #fff;
            padding: 15px 10px;
            text-align: center;
            border-radius: 5px 0 0 5px;
        }

        .counter-number {
            font-size: 18px;
            font-weight: 600;
        }

        .counter-label {
            font-size: 10px;
            letter-spacing: 1px;
        }

        .buy-now-fixed {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: #4CAF50;
            padding: 10px;
            z-index: 1000;
        }

        .buy-now-btn {
            display: block;
            width: 100%;
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px;
            font-weight: 600;
            text-align: center;
            text-decoration: none;
        }

        .product-img {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-radius: 8px;
            object-fit: cover;
        }

        @media (min-width: 768px) {
            .buy-now-fixed {
                display: none;
            }
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header>
        <div class="container">
            <div class="row py-3 align-items-center">
                <!-- Social Icons -->
                <div class="col-lg-3 col-md-4 col-6">
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>

                <!-- Logo -->
                <div class="col-lg-6 col-md-4 text-center">
                    <div class="logo">
                        <a href="#">
                            <h1 class="m-0">Marseille</h1>
                            <div class="tagline">XSTORE THEME</div>
                        </a>
                    </div>
                </div>

                <!-- Navigation Right -->
                <div class="col-lg-3 col-md-4 col-6">
                    <div class="header-actions d-flex justify-content-end">
                        <a href="#" class="me-3">Contacts</a>
                        <a href="#" class="me-3"><i class="fas fa-search"></i></a>
                        <a href="#" class="me-3">Sign In</a>
                        <a href="#" class="me-3"><i class="far fa-heart"></i></a>
                        <a href="#" class="position-relative">
                            <i class="fas fa-shopping-bag"></i>
                            <span class="cart-count">3</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Navigation -->
    <nav class="main-navigation">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <ul class="nav justify-content-center">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Shop</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">About Us</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Breadcrumb -->
    <div class="container py-3">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent p-0 m-0">
                        <li class="breadcrumb-item"><a href="#" class="text-decoration-none text-dark">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Shop</li>
                    </ol>
                </nav>
                <a href="#" class="text-dark text-decoration-none mt-2 d-block">
                    <small>&larr; Return to previous page</small>
                </a>
            </div>
        </div>
    </div>

    <!-- Banner Section -->
    <div class="banner-section">
        <div class="container text-center">
            <!-- Countdown Timer -->
            <div class="countdown-timer mb-3">
                <div class="row justify-content-center">
                    <div class="col-auto">
                        <div class="countdown-box bg-white px-3 py-2">Days</div>
                    </div>
                    <div class="col-auto">
                        <div class="countdown-box bg-white px-3 py-2">Hours</div>
                    </div>
                    <div class="col-auto">
                        <div class="countdown-box bg-white px-3 py-2">Mins</div>
                    </div>
                    <div class="col-auto">
                        <div class="countdown-box bg-white px-3 py-2">Secs</div>
                    </div>
                </div>
            </div>
            <h2 class="mb-3">The Classics Make A Comeback</h2>
            <a href="#" class="btn btn-dark px-4">Buy Now</a>
        </div>
    </div>

    <!-- Shop Filters -->
    <div class="container my-4">
        <div class="row align-items-center">
            <div class="col-md-6 d-flex align-items-center mb-3 mb-md-0">
                <!-- Sorting Dropdown -->
                <div class="dropdown me-3">
                    <select class="form-select" name="sorting" id="shop-sorting">
                        <option value="default">Default sorting</option>
                        <option value="popularity">Sort by popularity</option>
                        <option value="rating">Sort by rating</option>
                        <option value="date">Sort by latest</option>
                        <option value="price-asc">Sort by price: low to high</option>
                        <option value="price-desc">Sort by price: high to low</option>
                    </select>
                </div>

                <!-- View Toggle -->
                <div class="view-toggle">
                    <button class="btn btn-sm btn-outline-secondary active me-2">
                        <i class="fas fa-th"></i>
                    </button>
                    <button class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-list"></i>
                    </button>
                </div>
            </div>
            <div class="col-md-6 text-md-end">
                <!-- Items Per Page -->
                <div class="items-per-page">
                    <span class="me-2">Show</span>
                    <select class="form-select form-select-sm d-inline-block w-auto" name="per-page" id="shop-per-page">
                        <option value="8">8</option>
                        <option value="16">16</option>
                        <option value="24">24</option>
                        <option value="32">32</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Products Grid -->
    <div class="container">
        <div class="row">
            <!-- Product 1 -->
            @foreach ($products as $product)
                <div class="col-md-3 col-6 mb-4">
                    <div class="product-card">
                        <div class="product-image">
                            <a href={{ route('productDetail', ['id' => $product->id]) }}>
                                <img class="product-img" src="{{ asset($product->image) }}" alt="Product Name"
                                    class="img-fluid">
                            </a>
                            <div class="color-options position-absolute bottom-0 start-0 p-2">
                                <button class="color-btn me-1" style="background-color: #000000;"></button>
                                <button class="color-btn me-1" style="background-color: #CC0000;"></button>
                                <button class="color-btn" style="background-color: #3399CC;"></button>
                            </div>
                        </div>
                        <div class="product-info py-2">
                            <h3 class="product-title h6">
                                <a href={{ route('productDetail', ['id' => $product->id]) }}
                                    class="text-dark text-decoration-none">{{ $product->name }}</a>
                            </h3>
                            <p class="product-brand text-muted small"> {{ $product->brand->name ?? 'No brand' }}</p>
                            <div class="product-price">
                                <span class="sale-price">${{ $product->price }}</span>
                            </div>
                            <form action="#" method="POST" class="mt-2">
                                <button type="submit" class="btn btn-sm btn-outline-dark w-100">ADD TO CART</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="pagination-container">
                {{ $products->links('pagination::bootstrap-4') }}
            </div>





        </div>
    </div>

    <!-- Load More -->
    <div class="container mb-5">
        <div class="row">
            <div class="col-12 text-center">
                <button class="btn btn-outline-secondary px-4">LOAD MORE PRODUCTS</button>
            </div>
        </div>
    </div>

    <!-- Website Counter -->
    <div class="website-counter">
        <div class="counter-number">140+</div>
        <div class="counter-label">WEBSITE</div>
    </div>

    <!-- Fixed Buy Now Button (Mobile) -->
    <div class="buy-now-fixed d-md-none">
        <a href="#" class="buy-now-btn">BUY NOW</a>
    </div>

    <!-- Footer -->
    <footer class="site-footer">
        <div class="container">
            <div class="row">
                <!-- Footer Logo -->
                <div class="col-12 text-center mb-4">
                    <div class="footer-logo">
                        <h2 class="text-white mb-0">Marseille</h2>
                        <div class="tagline">XSTORE THEME</div>
                    </div>
                </div>

                <!-- Footer Links -->
                <div class="col-lg-2 col-md-4 col-6 mb-4">
                    <h5 class="footer-heading mb-3">Home</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-decoration-none">Home</a></li>
                        <li><a href="#" class="text-decoration-none">Elements</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-4 col-6 mb-4">
                    <h5 class="footer-heading mb-3">Elements</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-decoration-none">Elements</a></li>
                        <li><a href="#" class="text-decoration-none">Elements</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-4 col-6 mb-4">
                    <h5 class="footer-heading mb-3">Elements</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-decoration-none">Elements</a></li>
                        <li><a href="#" class="text-decoration-none">Elements</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-4 col-6 mb-4">
                    <h5 class="footer-heading mb-3">Elements</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-decoration-none">Elements</a></li>
                        <li><a href="#" class="text-decoration-none">Elements</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-4 col-6 mb-4">
                    <h5 class="footer-heading mb-3">Elements</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-decoration-none">Elements</a></li>
                        <li><a href="#" class="text-decoration-none">Elements</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-4 col-6 mb-4">
                    <h5 class="footer-heading mb-3">Elements</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-decoration-none">Elements</a></li>
                        <li><a href="#" class="text-decoration-none">Elements</a></li>
                    </ul>
                </div>

                <!-- Payment Info -->
                <div class="col-12 text-center mt-4">
                    <p>Guaranteed safe checkout</p>
                </div>

                <!-- Copyright -->
                <div class="col-12 text-center mt-4">
                    <p class="copyright">
                        Copyright © 2025 <a href="#" class="text-white">XStore theme</a>. Created by 8theme - <a
                            href="#" class="text-white">WordPress WooCommerce themes</a>
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>