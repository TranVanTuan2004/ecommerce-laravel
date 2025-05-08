@extends('layouts.app')
@section('content')
<div class="container">
    <h3>Lịch sử mua hàng</h3>
    @foreach($orders as $order)
    <div class="border p-3 mb-3">
        Mã đơn: #{{ $order->id }} - Tổng: {{ number_format($order->total_price, 0, ',', '.') }} VNĐ - Đã giao<br>
        <strong>Sản phẩm:</strong>
        <ul>
            @foreach($order->products as $product)
            <li>{{ $product->name }} - SL: {{ $product->pivot->quantity }} - Giá: {{ number_format($product->pivot->price, 0, ',', '.') }} VNĐ</li>
            @endforeach
        </ul>

        @foreach($order->orderItems as $item)
        <form method="POST" action="{{ route('reviews.store') }}" class="mt-2">
            @csrf
            <input type="hidden" name="product_id" value="{{ $item->product_id }}">
            <input type="hidden" name="order_id" value="{{ $order->id }}">
            Đánh giá:
            <input type="number" name="rating" min="1" max="5" required>
            <input type="text" name="comment" placeholder="Viết nhận xét...">
            <button type="submit">Gửi</button>
        </form>
        @endforeach
    </div>
    @endforeach
</div>
@endsection