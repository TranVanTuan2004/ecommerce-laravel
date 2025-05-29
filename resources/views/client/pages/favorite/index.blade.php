@extends('client.master')
@section('content')
    <style>
        .checkout-steps {
            background: linear-gradient(to right, #fff6e5, #ffe7ba);
            color: #333;
            padding: 30px 0;
            text-align: center;
        }

        .product-card {
            border: none;
            border-radius: 16px;
            overflow: hidden;
            background: #fff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            animation: fadeInUp 0.6s ease;
        }

        .product-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .product-img {
            height: 220px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .product-card:hover .product-img {
            transform: scale(1.05);
        }

        .remove-btn {
            position: absolute;
            top: 12px;
            right: 12px;
            z-index: 2;
            /* Thêm dòng này */
            background: rgba(255, 255, 255, 0.9);
            border-radius: 50%;
            padding: 6px 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .remove-btn:hover {
            background: #ffe8e8;
        }

        .product-title {
            font-size: 15px;
            font-weight: 600;
            color: #333;
            height: 40px;
            overflow: hidden;
        }

        .product-price {
            color: #e63946;
            font-size: 16px;
            font-weight: bold;
        }

        .btn-add-cart {
            transition: all 0.3s ease;
            border-radius: 20px;
            padding: 5px 18px;
            font-size: 13px;
        }

        .btn-add-cart:hover {
            transform: scale(1.05);
        }

        .empty-wishlist {
            text-align: center;
            padding: 80px 20px;
            animation: fadeIn 0.8s ease-in-out;
        }

        .btn-dark-custom {
            background-color: #212529;
            color: #fff;
            padding: 10px 20px;
            font-size: 13px;
            border-radius: 4px;
            text-transform: uppercase;
            transition: all 0.3s ease;
        }

        .btn-dark-custom:hover {
            background-color: #fff;
            color: #000;
            border: 1px solid #000;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }
    </style>

    <div class="checkout-steps">
        <h3>❤️ Your Favorites</h3>
    </div>

    <div class="container mt-5 mb-4 py-3">
        <div class="row">
            @if (count($favorites) == 0)
                <div class="col-12 empty-wishlist">
                    <i class="far fa-heart fa-3x text-muted mb-3"></i>
                    <h3>Your wishlist is empty</h3>
                    <p class="text-muted">Explore our shop and find something you'll love!</p>
                    <a href="{{ route('homePage') }}" class="btn btn-dark-custom mt-2">Return to Shop</a>
                </div>
            @endif

            @foreach ($favorites as $product)
                <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                    <div class="card product-card">

                        <!-- Nút xoá -->
                        <form action="{{ route('favorite.toggle') }}" method="POST" class="remove-btn">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit" class="btn p-0 border-0 bg-transparent" title="Remove from wishlist">
                                <i class="fas fa-times text-danger"></i>
                            </button>
                        </form>

                        <!-- Hình ảnh -->
                        <a href="{{ route('productDetail', $product->id) }}">
                            <img src="{{ $product->image ?? 'https://www.img.vn/uploads/version/img24-png-20190726133727cbvncjKzsQ.png' }}"
                                class="card-img-top product-img" alt="Product image">
                        </a>

                        <!-- Thông tin -->
                        <div class="card-body text-center px-3">
                            <h6 class="product-title mb-2">{{ Str::limit($product->name, 30) }}</h6>
                            <p class="product-price mb-2">{{ number_format($product->price) }}đ</p>
                            <a href="{{ route('cart.addToCart', $product->id) }}"
                                class="btn btn-outline-success btn-sm btn-add-cart">Add to Cart</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-end mt-4">
            {{ $favorites->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
