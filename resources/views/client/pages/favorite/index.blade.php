    <style>
        .product-card {
            border: 1px solid #eee;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
            transition: box-shadow 0.3s;
            position: relative;
        }

        .product-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .remove-wishlist {
            position: absolute;
            top: 10px;
            right: 10px;
            color: red;
            cursor: pointer;
        }

        .remove-wishlist:hover {
            color: darkred;
        }

        .empty-wishlist {
            text-align: center;
            padding: 80px 20px;
            font-family: 'Courier New', Courier, monospace;
        }

        .empty-wishlist i {
            font-size: 48px;
            color: #333;
            margin-bottom: 20px;
        }

        .empty-wishlist h2 {
            font-size: 20px;
            font-weight: bold;
            letter-spacing: 2px;
            margin-bottom: 10px;
        }

        .empty-wishlist p {
            font-size: 14px;
            color: #555;
            margin-bottom: 20px;
        }

        .btn-dark-custom {
            background-color: #2c2c2c !important;
            color: white !important;
            font-size: 12px;
            padding: 8px 20px;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-radius: 4px;
            transition: all linear 0.75s;
        }

        .btn-dark-custom:hover {
            background-color: #fff !important;
            color: black !important;
            outline: 1px solid #000;
        }
    </style>
    @extends('client.master')
    @section('content')
        <div class="checkout-steps py-5 bg-light">
            <div class="d-flex justify-content-center align-items-center gap-3 mb-2">
                <h3>❤️ Your favorites</h3>
            </div>
        </div>
        <div class="container mt-5 mb-3 py-3">
            <div class="row">
                <!-- Sản phẩm yêu thích 1 -->
                @if (count($favorites) == 0)
                    <div class="container empty-wishlist">
                        <i class="far fa-heart"></i>
                        <h2>YOUR WISHLIST IS EMPTY</h2>
                        <p>We invite you to get acquainted with an assortment of our shop. Surely you can find something for
                            yourself!</p>
                        <a href="{{ route('homePage') }}" class="btn btn-dark-custom" style="font-size: 14px !important">Return
                            to
                            Shop</a>
                    </div>
                @endif
                @foreach ($favorites as $product)
                    <div class="col-md-3 mb-4">
                        <div class="card shadow-sm border-0 h-100 position-relative">
                            <!-- Nút xoá yêu thích -->
                            <form action="{{ route('favorite.toggle') }}" method="POST" class="position-absolute"
                                style="top: 10px; right: 10px;">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button type="submit" class="btn btn-sm text-danger p-0" title="Xóa khỏi yêu thích"
                                    style="background: none; border: none;">
                                    <i class="fas fa-times-circle fa-lg"></i>
                                </button>
                            </form>

                            <!-- Ảnh sản phẩm -->
                            <a href={{ route('productDetail', $product->id) }}>
                                <img src="{{ $product->image ?? 'https://www.img.vn/uploads/version/img24-png-20190726133727cbvncjKzsQ.png' }}"
                                    class="card-img-top img-fluid"
                                    style="height: 220px; object-fit: cover; border-top-left-radius: .5rem; border-top-right-radius: .5rem;"
                                    alt="">
                            </a>

                            <div class="card-body text-center">
                                <h5 class="card-title font-weight-bold mb-2">
                                    {{ mb_strlen($product->name) > 20 ? mb_substr($product->name, 0, length: 20) . '...' : mb_substr($product->name, 0, length: 20) }}
                                </h5>
                                <p class="text-danger font-weight-bold mb-3">{{ number_format($product->price) }}đ</p>

                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('cart.addToCart', $product->id) }}"
                                        class="btn btn-success btn-sm rounded-pill px-3">Add to cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-end mt-3">
                {{ $favorites->links('pagination::bootstrap-4') }}
            </div>
        </div>
    @endsection
