<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Thống kê đánh giá</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: sans-serif;
            background: #f2f2f2;
            padding: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
        }

        .product-card {
            background: #fff;
            border-radius: 10px;
            padding: 16px;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.05);
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .product-name {
            font-weight: 600;
            margin-bottom: 10px;
            text-align: center;
        }

        .chart-box {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
        }

        .chart-container {
            width: 120px;
            height: 120px;
            position: relative;
        }

        .legend {
            display: flex;
            flex-direction: column;
            gap: 6px;
            font-size: 0.85rem;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .color-box {
            width: 12px;
            height: 12px;
            border-radius: 3px;
        }

        @media (max-width: 768px) {
            .chart-box {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>

    <h2>Thống kê đánh giá sản phẩm</h2>
    <div style=" margin-bottom: 20px;">
        <a href="{{ url()->previous() }}"
            style="display: inline-block; padding: 10px 20px; background-color: #4D96FF; color: white; text-decoration: none; border-radius: 8px; font-weight: 500;">
            ← Quay lại
        </a>
    </div>

    <div class="grid-container">
        @php
            $colors = ['#FF6B6B', '#FFD93D', '#6BCB77', '#4D96FF', '#845EC2'];
        @endphp

        @foreach($stats as $stat)
            <div class="product-card">
                <div class="product-name">{{ $stat['product_name'] }} (#{{ $stat['product_id'] }})</div>
                <div class="chart-box">
                    <div class="chart-container">
                        <canvas id="chart-{{ $stat['product_id'] }}"></canvas>
                    </div>
                    <div class="legend">
                        @foreach(range(1, 5) as $i)
                            <div class="legend-item">
                                <span class="color-box" style="background-color: {{ $colors[$i - 1] }}"></span>
                                <span>{{ $i }} sao</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <script>
        const chartData = @json($stats);
        const chartColors = ['#FF6B6B', '#FFD93D', '#6BCB77', '#4D96FF', '#845EC2'];

        chartData.forEach(stat => {
            const ctx = document.getElementById(`chart-${stat.product_id}`).getContext('2d');
            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['1 sao', '2 sao', '3 sao', '4 sao', '5 sao'],
                    datasets: [{
                        data: Object.values(stat.ratings),
                        backgroundColor: chartColors,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            callbacks: {
                                label: ctx => `${ctx.label}: ${ctx.raw} đánh giá`
                            }
                        }
                    }
                }
            });
        });
    </script>

</body>

</html>