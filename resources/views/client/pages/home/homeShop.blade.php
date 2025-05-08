@extends('client.master')
@section('content')
    @include('client.components.banner')
    @include('client.components.filter')
    <div class="container">
        <div class="row">
            <!-- Product 1 -->
            @foreach ($products as $product)
                <div class="col-md-3 col-6 mb-4">
                    <div class="product-card">
                        <div class="product-image">
                            <a href={{ route('productDetail', ['id' => $product->id]) }}>
                                <img src="{{ asset('client/img/category_img_01.jpg') }}" alt="Product Name" class="img-fluid">
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
                            <form action="{{ route('cart.addToCart') }}" method="POST">
                                @csrf
                                <input type="text" hidden name="product_id" value="{{ $product->id }}">
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
@endsection
