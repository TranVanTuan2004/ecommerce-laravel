@extends('admin.master')

@section('title', 'Thống Kê Top 10 Sản Phẩm Bán Chạy Nhất')

@section('content')

    <style>
        .dashboard-container {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            margin-top: 40px;
        }

        .stats-list {
            flex: 1 1 350px;
            max-width: 400px;
            display: grid;
            grid-template-columns: 1fr;
            gap: 15px;
        }

        .stat-box {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 15px 20px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .stat-rank {
            font-weight: 700;
            font-size: 1.4rem;
            width: 32px;
            text-align: center;
            color: #6c757d;
        }

        .stat-name {
            flex-grow: 1;
            margin-left: 15px;
            font-weight: 600;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .stat-count {
            font-weight: 700;
            font-size: 1.2rem;
            color: #28a745;
        }

        .chart-container {
            flex: 2 1 600px;
            min-width: 300px;
        }
    </style>
    <div class="container" style="padding-bottom: 100px">
        <h1 class="text-center font-weight-bold text-primary">Thống Kê Top 10 Sản Phẩm Bán Chạy Nhất</h1>

        @if ($topProducts->isEmpty())
            <p class="text-center mt-4 text-muted">Chưa có sản phẩm nào được bán.</p>
        @else
            <div class="dashboard-container">
                <div class="stats-list">
                    @foreach ($topProducts as $index => $product)
                        <div class="stat-box" title="{{ $product->name }}">
                            <div class="stat-rank">{{ $index + 1 }}</div>
                            <div class="stat-name">{{ $product->name }}</div>
                            <div class="stat-count">{{ $product->total_sold ?? 0 }}</div>
                        </div>
                    @endforeach
                </div>

                <div class="chart-container">
                    <canvas id="topProductsChart" height="400"></canvas>
                </div>
            </div>
        @endif
    </div>
    <!-- Load Chart.js từ CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('topProductsChart').getContext('2d');

        const productNames = @json($topProducts->pluck('name'));
        const productSales = @json($topProducts->pluck('total_sold'));

        const chart = new Chart(ctx, {
            type: 'bar', // hoặc 'pie', 'line', 'doughnut' tùy ý
            data: {
                labels: productNames,
                datasets: [{
                    label: 'Số lượng bán',
                    data: productSales,
                    backgroundColor: 'rgba(40, 167, 69, 0.7)',
                    borderColor: 'rgba(40, 167, 69, 1)',
                    borderWidth: 1,
                    borderRadius: 5,
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        enabled: true
                    }
                }
            }
        });
    </script>
@endsection
