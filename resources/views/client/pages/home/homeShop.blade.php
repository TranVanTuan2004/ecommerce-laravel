@extends('client.master')
@section('content')
    @include('client.components.banner')
    @include('client.components.categories')
    @include('client.components.filter')
    @include('client.components.search_form', ['categories' => $categories, 'brands' => $brands])
    @include('client.components.chat')

    <!-- Phần hiển thị sản phẩm như hiện tại -->
    <div class="container my-4">
        <h2 class="mb-4">
            @if (request()->category_id)
                Sản phẩm trong danh mục: {{ $categories->find(request()->category_id)->name }}
            @else
                Tất cả sản phẩm
            @endif
        </h2>

        <div class="row">
            @forelse ($products as $product)
                <div class="col-md-3 col-6 mb-4">
                    <div class="product-card">
                        <div class="product-image">
                            <a href="{{ route('productDetail', $product->id) }}">
                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="img-fluid">
                            </a>
                            <div class="color-options position-absolute bottom-0 start-0 p-2">
                                <button class="color-btn me-1" style="background-color: #000000;"></button>
                                <button class="color-btn me-1" style="background-color: #CC0000;"></button>
                                <button class="color-btn" style="background-color: #3399CC;"></button>
                            </div>
                        </div>
                        <div class="product-info py-2">
                            <h3 class="product-title h6">
                                <a href="{{ route('productDetail', $product->id) }}" class="text-dark text-decoration-none">
                                    {{ $product->name }}
                                </a>
                            </h3>
                            <p class="product-brand text-muted small">
                                {{ $product->brand->name ?? 'No brand' }}
                            </p>
                            <div class="product-price">
                                <span class="sale-price">{{ number_format($product->price) }} VNĐ</span>
                            </div>
                            <form action="{{ route('cart.addToCart') }}" method="POST">
                                @csrf
                                <input type="text" hidden name="product_id" value="{{ $product->id }}">
                                <button type="submit" class="btn btn-sm btn-outline-dark w-100">ADD TO CART</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-center">Không có sản phẩm nào trong danh mục này.</p>
                </div>
            @endforelse
        </div>

    </div>


    <!-- Pagination -->
    <div class="pagination-container">
        {{ $products->appends(request()->except('page'))->links('pagination::bootstrap-4') }}
    </div>

    </div>


    <script>
        window.Echo.channel('chat')
            .listen('MessageSent', (e) => {
                console.log("Tin nhắn mới:", e.message);
                // Hiển thị lên UI
            });
    </script>
@endsection