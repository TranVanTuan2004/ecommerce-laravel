<style>
    td {
        text-align: start;
        vertical-align: middle !important;
    }

    td select.form-control-sm {
        width: 140px;
        margin: 0 auto;
    }

    .badge {
        padding: 0.4em 0.7em;
        font-size: 0.85rem;
        display: inline-block;
        width: 90px;
        text-align: center;
    }

    td .btn-group {
        display: flex;
        flex-wrap: wrap;
        gap: 4px;
        justify-content: center;
    }

    td .btn {
        margin: 2px 1px;
        min-width: 32px;
        padding: 4px 6px;
    }
</style>


@extends('admin.master')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading mb-3">
        <div class="col-lg-8">
            <h2 class="mt-2">Quản lý đơn hàng</h2>
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="active"><strong>Đơn hàng</strong></li>
            </ol>
        </div>
    </div>

    <div class="row mb-4 mt-4">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered align-middle text-center">
                            <thead class="thead-light">
                                <tr>
                                    <th><input type="checkbox" id="checkAll"></th>
                                    <th>Khách hàng</th>
                                    <th>Sản phẩm</th>
                                    <th>Địa chỉ</th>
                                    <th>Tổng tiền</th>
                                    <th>Thao tác</th>
                                    <th>Trạng thái</th>
                                    <th>Phương thức thanh toán</th>
                                    <th>Ngày đặt</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as $order)
                                    <tr>
                                        <td><input type="checkbox" class="checkBoxItem"></td>
                                        <td>{{ $order->user->name ?? 'Khách vãng lai' }}</td>
                                        <td style="text-align: left;">
                                            <ul class="list-unstyled mb-0">
                                                @php $maxVisible = 3; @endphp
                                                @foreach ($order->orderProducts as $index => $orderProduct)
                                                    <li class="{{ $index >= $maxVisible ? 'extra-products-' . $order->id : '' }}"
                                                        style="{{ $index >= $maxVisible ? 'display: none;' : '' }}">
                                                        <strong>{{ $orderProduct->product->name }}</strong>
                                                        (SL: {{ $orderProduct->quantity }}, Giá:
                                                        {{ number_format($orderProduct->price, 0, ',', '.') }}đ)
                                                    </li>
                                                @endforeach

                                                @if ($order->orderProducts->count() > $maxVisible)
                                                    <li>
                                                        <a href="javascript:void(0);"
                                                            onclick="toggleMoreProducts({{ $order->id }})"
                                                            class="text-primary">
                                                            Xem thêm...
                                                        </a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </td>
                                        <td>{{ $order->shipping_address ?? $order->user->address }}</td>
                                        <td>
                                            @php
                                                $hasDiscount =
                                                    isset($order->discount_price) && $order->discount_price > 0;
                                                $finalPrice = $hasDiscount
                                                    ? $order->total_price - $order->discount_price
                                                    : $order->total_price;
                                            @endphp

                                            @if ($hasDiscount)
                                                <span class="text-muted" style="text-decoration: line-through;">
                                                    {{ number_format($order->total_price, 0, ',', '.') }}đ
                                                </span><br>
                                                <span class="text-success fw-bold">
                                                    {{ number_format($finalPrice, 0, ',', '.') }}đ
                                                </span>
                                            @else
                                                {{ number_format($order->total_price, 0, ',', '.') }}đ
                                            @endif
                                        </td>

                                        <td>
                                            <form action="{{ route('order.updateStatus', $order->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <select name="status" class="form-control form-control-sm"
                                                    onchange="this.form.submit()">
                                                    <option value="pending"
                                                        {{ $order->status == 'pending' ? 'selected' : '' }}>Chờ xác nhận
                                                    </option>
                                                    <option value="confirmed"
                                                        {{ $order->status == 'confirmed' ? 'selected' : '' }}>Đã xác nhận
                                                    </option>
                                                    <option value="shipping"
                                                        {{ $order->status == 'shipping' ? 'selected' : '' }}>Đang vận
                                                        chuyển
                                                    </option>
                                                    <option value="delivering"
                                                        {{ $order->status == 'delivering' ? 'selected' : '' }}>Đang giao
                                                    </option>
                                                    <option value="delivered"
                                                        {{ $order->status == 'delivered' ? 'selected' : '' }}>Đã giao
                                                    </option>
                                                    <option value="cancelled"
                                                        {{ $order->status == 'cancelled' ? 'selected' : '' }}>Huỷ đơn hàng
                                                    </option>
                                                </select>

                                            </form>
                                        </td>
                                        <td>
                                            @php
                                                $statusLabels = [
                                                    'pending' => 'Chờ xác nhận',
                                                    'confirmed' => 'Đã xác nhận',
                                                    'shipping' => 'Đang vận chuyển',
                                                    'delivering' => 'Đang giao',
                                                    'delivered' => 'Đã giao',
                                                    'cancelled' => 'Huỷ đơn hàng',
                                                ];
                                            @endphp

                                            <span
                                                class="badge
                                                @if ($order->status == 'pending') badge-warning
                                                @elseif ($order->status == 'confirmed') badge-secondary
                                                @elseif ($order->status == 'shipping') badge-info
                                                @elseif ($order->status == 'delivering') badge-primary
                                                @elseif ($order->status == 'delivered') badge-success
                                                @elseif ($order->status == 'cancelled') badge-danger @endif
    ">
                                                {{ $statusLabels[$order->status] ?? ucfirst($order->status) }}
                                            </span>
                                        </td>

                                        @php
                                            $paymentMethods = [
                                                'cod' => 'Thanh toán khi nhận hàng',
                                                'bank' => 'Chuyển khoản',
                                                'online' => 'Thanh toán online',
                                            ];
                                        @endphp

                                        <td>{{ $paymentMethods[$order->payment_method] ?? ucfirst($order->payment_method) }}
                                        </td>

                                        <td>{{ \Carbon\Carbon::parse($order->ordered_at)->format('d/m/Y H:i') }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('order.show', $order->id) }}"
                                                    class="btn btn-sm btn-primary" title="Xem chi tiết">
                                                    <i class="fa fa-eye"></i>
                                                </a>

                                                <a href="{{ route('order.edit', $order->id) }}"
                                                    class="btn btn-sm btn-warning" title="Sửa">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            </div>
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10">Không có đơn hàng nào.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center mt-3">
                        {{ $orders->appends(request()->all())->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.getElementById('checkAll').addEventListener('change', function() {
            const checked = this.checked;
            document.querySelectorAll('.checkBoxItem').forEach(cb => cb.checked = checked);
        });


        function toggleMoreProducts(orderId) {
            const items = document.querySelectorAll('.extra-products-' + orderId);
            items.forEach(item => {
                if (item.style.display === 'none') {
                    item.style.display = 'list-item';
                } else {
                    item.style.display = 'none';
                }
            });
        }
    </script>
@endpush
