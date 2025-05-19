@extends('admin.pages.top10users.masterTop10')

@section('title', 'Top 10 Users Mua Hàng Nhiều Nhất')

@section('content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-md-12">
            <button class="btn btn-secondary mb-3" onclick="window.history.back();">
                <i class="fas fa-arrow-left me-1"></i> Quay lại
            </button>
            <div class="card shadow border-0">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0 font-weight-bold">
                        <i class="fas fa-crown me-2"></i>Top 10 Users có tổng số tiền mua hàng cao nhất
                    </h3>
                </div>
                <div class="card-body p-0">
                    <div id="container"></div>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="py-3 text-center" width="5%">#</th>
                                    <th class="py-3" width="30%"><i class="fas fa-user me-2"></i>Tên người dùng</th>
                                    <th class="py-3" width="35%"><i class="fas fa-envelope me-2"></i>Email</th>
                                    <th class="py-3 text-end" width="30%"><i class="fas fa-coins me-2"></i>Tổng tiền đã
                                        mua (VNĐ)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($topUsers as $index => $user)
                                    <tr class="{{ $index < 3 ? 'table-' . ['warning', 'light', 'info'][$index] : '' }}">
                                        <td class="text-center align-middle">
                                            @if($index < 3)
                                                <span
                                                    class="badge rounded-pill bg-{{ ['warning', 'secondary', 'success'][$index] }} fs-6">{{ $index + 1 }}</span>
                                            @else
                                                <span class="text-muted">{{ $index + 1 }}</span>
                                            @endif
                                        </td>
                                        <td class="align-middle fw-{{ $index < 3 ? 'bold' : 'normal' }}">{{ $user->name }}
                                        </td>
                                        <td class="align-middle">{{ $user->email }}</td>
                                        <td class="text-end align-middle fw-{{ $index < 3 ? 'bold' : 'normal' }}">
                                            <span class="{{ $index < 3 ? 'text-primary' : '' }}">
                                                {{ number_format($user->total_spent, 0, ',', '.') }}₫
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-4 text-muted">
                                            <div class="d-flex flex-column align-items-center">
                                                <i class="fas fa-database fa-3x mb-3 text-secondary"></i>
                                                <p class="mb-0">Không có dữ liệu</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-white text-muted small">
                    <div class="d-flex justify-content-between align-items-center">
                        <span>Cập nhật gần nhất: {{ date('d/m/Y H:i') }}</span>
                        <span>Tổng số người dùng: {{ count($topUsers) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('styles')
    <style>
        /* Các style bạn có thể giữ nguyên */
        .table> :not(caption)>*>* {
            padding: 1rem 1.5rem;
        }

        #container {
            height: 400px;
            max-width: 800px;
            margin: auto;
        }
    </style>
@endsection

@section('scripts')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Highcharts.chart('container', {
                chart: { type: 'column' },
                title: { text: 'Top 10 Users theo tổng tiền mua hàng (VNĐ)' },
                xAxis: {
                    categories: [
                        @foreach ($topUsers as $user)
                            "{{ $user->name }}",
                        @endforeach
                                                                                                            ],
                    crosshair: true,
                    accessibility: { description: 'Tên người dùng' }
                },
                yAxis: {
                    min: 0,
                    title: { text: 'Tổng tiền mua hàng (VNĐ)' }
                },
                tooltip: { valueSuffix: ' VNĐ' },
                plotOptions: {
                    column: { pointPadding: 0.2, borderWidth: 0 }
                },
                series: [{
                    name: 'Tổng tiền',
                    data: [
                        @foreach ($topUsers as $user)
                            {{ $user->total_spent }},
                        @endforeach
                                                                                                            ],
                    color: '#007bff' // màu xanh dương
                }]
            });
        });
    </script>
@endsection