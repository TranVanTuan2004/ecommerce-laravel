<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Theo dõi đơn hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Theo dõi trạng thái đơn hàng</h2>

        @if ($orders->count())

        @php
        $statusColor = [
        'pending' => 'warning',
        'processing' => 'secondary',
        'shipping' => 'info',
        'in_transit' => 'primary',
        'delivered' => 'success',
        'canceled' => 'danger',
        ];

        $statusLabel = [
        'pending' => 'Chờ xử lý',
        'processing' => 'Đang xử lý',
        'shipping' => 'Đang vận chuyển',
        'in_transit' => 'Đang giao hàng',
        'delivered' => 'Đã giao',
        'canceled' => 'Đã hủy',
        ];
        @endphp

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Mã đơn</th>
                    <th>Ngày đặt</th>
                    <th>Tổng tiền</th>
                    <th>Phương thức</th>
                    <th>Trạng thái</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                @php
                $currentStatus = $order->shipping->status ?? $order->status;
                $color = $statusColor[$currentStatus] ?? 'secondary';
                $label = $statusLabel[$currentStatus] ?? ucfirst($currentStatus);
                @endphp
                <tr>
                    <td>#{{ $order->id }}</td>
                    <td>{{ $order->created_at->format('d/m/Y') }}</td>
                    <td>{{ number_format($order->total_price, 0, ',', '.') }}đ</td>
                    <td>{{ ucfirst($order->payment_method) }}</td>
                    <td><span class="badge bg-{{ $color }}">{{ $label }}</span></td>
                    <td>
                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-outline-primary">Xem</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $orders->links() }}
        @else
        <p>Chưa có đơn hàng nào.</p>
        @endif
    </div>
</body>

</html>