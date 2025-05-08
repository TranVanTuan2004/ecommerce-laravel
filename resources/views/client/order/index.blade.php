<div class="container">
    <h3>Đơn hàng của bạn</h3>
    @foreach($orders as $order)
    <div class="border p-3 mb-3">
        <strong>Mã đơn: #{{ $order->id }}</strong><br>
        Ngày đặt: {{ $order->created_at->format('d/m/Y') }}<br>
        Tổng tiền: {{ number_format($order->total_price, 0, ',', '.') }} VNĐ<br>
        Trạng thái: <span class="text-primary">{{ ucfirst($order->status) }}</span><br>

        <strong>Địa chỉ giao hàng:</strong> {{ $order->shipping->address ?? 'Chưa có' }}<br>

        <strong>Sản phẩm:</strong>
        <ul>
            @foreach($order->products as $product)
            <li>
                {{ $product->name }} - SL: {{ $product->pivot->quantity }} - Giá: {{ number_format($product->pivot->price, 0, ',', '.') }} VNĐ
            </li>
            @endforeach
        </ul>

        @if($order->payments->count())
        <strong>Thanh toán:</strong>
        <ul>
            @foreach($order->payments as $payment)
            <li>{{ $payment->method }} - {{ number_format($payment->amount, 0, ',', '.') }} VNĐ - {{ $payment->created_at->format('d/m/Y') }}</li>
            @endforeach
        </ul>
        @endif

        @if(in_array($order->status, ['pending','processing']))
        <form action="{{ route('orders.cancel', $order->id) }}" method="POST" class="mt-2">
            @csrf
            <button class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn hủy đơn này?')">Hủy đơn</button>
        </form>
        @endif
    </div>
    @endforeach
</div>
@endsection