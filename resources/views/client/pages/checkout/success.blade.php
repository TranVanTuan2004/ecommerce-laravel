@extends('client.master')

@section('content')
    <div class="container py-5 text-center">
        <div class="mb-4">
            <i class="bi bi-check-circle-fill text-success" style="font-size: 5rem;"></i>
            <h2 class="mt-3">Đặt hàng thành công!</h2>
            <p class="text-muted">Cảm ơn bạn đã mua sắm tại cửa hàng của chúng tôi.</p>
        </div>

        <div class="border p-4 rounded bg-light d-inline-block text-start" style="max-width: 500px;">
            <p><strong>Mã đơn hàng:</strong> #{{ $order->id }}</p>
            <p><strong>Ngày đặt:</strong> {{ $order->created_at }}</p>
            <p><strong>Tổng tiền:</strong> <span class="text-danger">{{ number_format($order->total_price, 3) }}đ</span></p>
            <p><strong>Trạng thái:</strong> <span class="text-success">Đang xử lý</span></p>
            <p><strong>Phương thức thanh toán:</strong> Thanh toán khi nhận hàng</p>
        </div>

        <div class="mt-4">
            <a href="{{ route('homePage') }}" class="btn btn-outline-primary me-2">Tiếp tục mua sắm</a>
            <a href="" class="btn btn-primary">Xem lịch sử đơn hàng</a>
        </div>
    </div>
@endsection
