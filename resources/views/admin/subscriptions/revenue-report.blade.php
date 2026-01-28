@extends('admin.layouts.app')

@section('title', 'Báo cáo doanh thu')

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">
                <i class="fas fa-chart-bar"></i> Báo cáo doanh thu đăng ký
            </h1>
            <div>
                <button type="button" class="btn btn-success" onclick="exportReport()">
                    <i class="fas fa-file-excel"></i> Xuất Excel
                </button>
                <button type="button" class="btn btn-info" onclick="window.print()">
                    <i class="fas fa-print"></i> In báo cáo
                </button>
                <a href="{{ route('subscriptions.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Quay lại
                </a>
            </div>
        </div>

        <!-- Summary Statistics -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h6 class="card-title">Tổng doanh thu</h6>
                        <h2 class="mb-0">
                            {{ number_format($revenueByMonth->sum('total')) }} đ
                        </h2>
                        <small>12 tháng gần nhất</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h6 class="card-title">Trung bình/tháng</h6>
                        <h2 class="mb-0">
                            {{ number_format($revenueByMonth->avg('total')) }} đ
                        </h2>
                        <small>{{ $revenueByMonth->count() }} tháng</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <h6 class="card-title">Tổng số đăng ký</h6>
                        <h2 class="mb-0">
                            {{ number_format($revenueByPlan->sum('count')) }}
                        </h2>
                        <small>Tất cả gói dịch vụ</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <h6 class="card-title">Gói phổ biến nhất</h6>
                        <h2 class="mb-0">
                            {{ $revenueByPlan->sortByDesc('count')->first()->plan->name ?? 'N/A' }}
                        </h2>
                        <small>{{ $revenueByPlan->sortByDesc('count')->first()->count ?? 0 }} đăng ký</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Revenue by Month Chart -->
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-chart-line"></i> Doanh thu theo tháng</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="revenueChart" height="80"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Revenue Tables -->
        <div class="row">
            <!-- Revenue by Month Table -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-calendar-alt"></i> Doanh thu theo tháng</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Tháng</th>
                                        <th class="text-end">Doanh thu</th>
                                        <th class="text-end">% Thay đổi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $previousTotal = null;
                                    @endphp
                                    @foreach ($revenueByMonth as $index => $revenue)
                                        <tr>
                                            <td>
                                                <strong>{{ \Carbon\Carbon::parse($revenue->month . '-01')->format('m/Y') }}</strong>
                                            </td>
                                            <td class="text-end">
                                                <strong>{{ number_format($revenue->total) }} đ</strong>
                                            </td>
                                            <td class="text-end">
                                                @if ($previousTotal !== null && $previousTotal > 0)
                                                    @php
                                                        $change =
                                                            (($revenue->total - $previousTotal) / $previousTotal) * 100;
                                                    @endphp
                                                    <span class="badge bg-{{ $change >= 0 ? 'success' : 'danger' }}">
                                                        <i
                                                            class="fas fa-{{ $change >= 0 ? 'arrow-up' : 'arrow-down' }}"></i>
                                                        {{ number_format(abs($change), 1) }}%
                                                    </span>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @php
                                            $previousTotal = $revenue->total;
                                        @endphp
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="table-primary">
                                        <td><strong>Tổng cộng</strong></td>
                                        <td class="text-end">
                                            <strong>{{ number_format($revenueByMonth->sum('total')) }} đ</strong>
                                        </td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Revenue by Plan Table -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-tags"></i> Doanh thu theo gói dịch vụ</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Gói dịch vụ</th>
                                        <th class="text-center">Số lượng</th>
                                        <th class="text-end">Doanh thu</th>
                                        <th class="text-end">%</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $totalRevenue = $revenueByPlan->sum('total');
                                    @endphp
                                    @foreach ($revenueByPlan->sortByDesc('total') as $revenue)
                                        <tr>
                                            <td>
                                                <span class="badge bg-primary">
                                                    {{ $revenue->plan->name ?? 'Unknown' }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <strong>{{ number_format($revenue->count) }}</strong>
                                            </td>
                                            <td class="text-end">
                                                <strong>{{ number_format($revenue->total) }} đ</strong>
                                            </td>
                                            <td class="text-end">
                                                @if ($totalRevenue > 0)
                                                    <span class="badge bg-info">
                                                        {{ number_format(($revenue->total / $totalRevenue) * 100, 1) }}%
                                                    </span>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="table-success">
                                        <td><strong>Tổng cộng</strong></td>
                                        <td class="text-center">
                                            <strong>{{ number_format($revenueByPlan->sum('count')) }}</strong>
                                        </td>
                                        <td class="text-end">
                                            <strong>{{ number_format($totalRevenue) }} đ</strong>
                                        </td>
                                        <td class="text-end"><strong>100%</strong></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <!-- Plan Distribution Chart -->
                        <div class="mt-4">
                            <canvas id="planChart" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Insights -->
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0"><i class="fas fa-lightbulb"></i> Phân tích & Khuyến nghị</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <h6><i class="fas fa-trophy text-warning"></i> Gói bán chạy nhất</h6>
                                @php
                                    $topPlan = $revenueByPlan->sortByDesc('count')->first();
                                @endphp
                                <p>
                                    <strong>{{ $topPlan->plan->name ?? 'N/A' }}</strong> với
                                    <strong>{{ $topPlan->count ?? 0 }}</strong> đăng ký
                                    ({{ number_format(($topPlan->count / $revenueByPlan->sum('count')) * 100, 1) }}% tổng
                                    số)
                                </p>
                            </div>
                            <div class="col-md-4">
                                <h6><i class="fas fa-dollar-sign text-success"></i> Gói doanh thu cao nhất</h6>
                                @php
                                    $topRevenue = $revenueByPlan->sortByDesc('total')->first();
                                @endphp
                                <p>
                                    <strong>{{ $topRevenue->plan->name ?? 'N/A' }}</strong> với
                                    <strong>{{ number_format($topRevenue->total ?? 0) }}đ</strong>
                                    ({{ number_format(($topRevenue->total / $totalRevenue) * 100, 1) }}% tổng doanh thu)
                                </p>
                            </div>
                            <div class="col-md-4">
                                <h6><i class="fas fa-chart-line text-primary"></i> Xu hướng</h6>
                                @php
                                    $latestMonth = $revenueByMonth->first();
                                    $previousMonth = $revenueByMonth->skip(1)->first();
                                    if ($latestMonth && $previousMonth && $previousMonth->total > 0) {
                                        $trend =
                                            (($latestMonth->total - $previousMonth->total) / $previousMonth->total) *
                                            100;
                                    } else {
                                        $trend = 0;
                                    }
                                @endphp
                                <p>
                                    Doanh thu tháng này
                                    @if ($trend > 0)
                                        <span class="text-success">
                                            <i class="fas fa-arrow-up"></i> tăng {{ number_format(abs($trend), 1) }}%
                                        </span>
                                    @elseif($trend < 0)
                                        <span class="text-danger">
                                            <i class="fas fa-arrow-down"></i> giảm {{ number_format(abs($trend), 1) }}%
                                        </span>
                                    @else
                                        <span class="text-muted">không đổi</span>
                                    @endif
                                    so với tháng trước
                                </p>
                            </div>
                        </div>

                        <hr>

                        <h6><i class="fas fa-clipboard-list"></i> Khuyến nghị:</h6>
                        <ul class="mb-0">
                            <li>Tập trung marketing vào gói <strong>{{ $topPlan->plan->name ?? 'N/A' }}</strong> - gói phổ
                                biến nhất</li>
                            <li>Tối ưu hóa giá và tính năng của gói <strong>{{ $topRevenue->plan->name ?? 'N/A' }}</strong>
                                - đóng góp doanh thu lớn nhất</li>
                            <li>Theo dõi và phân tích nguyên nhân {{ $trend >= 0 ? 'tăng' : 'giảm' }} doanh thu tháng này
                            </li>
                            <li>Xem xét tạo các chương trình khuyến mãi cho các gói có số lượng đăng ký thấp</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
        <script>
            // Revenue by Month Chart
            const revenueCtx = document.getElementById('revenueChart').getContext('2d');
            const revenueChart = new Chart(revenueCtx, {
                type: 'line',
                data: {
                    labels: {!! json_encode(
                        $revenueByMonth->pluck('month')->map(fn($m) => \Carbon\Carbon::parse($m . '-01')->format('m/Y'))->reverse(),
                    ) !!},
                    datasets: [{
                        label: 'Doanh thu (VNĐ)',
                        data: {!! json_encode($revenueByMonth->pluck('total')->reverse()) !!},
                        borderColor: 'rgb(75, 192, 192)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        tension: 0.1,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return 'Doanh thu: ' + new Intl.NumberFormat('vi-VN').format(context.parsed.y) +
                                        ' đ';
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return new Intl.NumberFormat('vi-VN', {
                                        notation: 'compact'
                                    }).format(value);
                                }
                            }
                        }
                    }
                }
            });

            // Revenue by Plan Chart (Pie)
            const planCtx = document.getElementById('planChart').getContext('2d');
            const planChart = new Chart(planCtx, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($revenueByPlan->pluck('plan.name')) !!},
                    datasets: [{
                        label: 'Doanh thu',
                        data: {!! json_encode($revenueByPlan->pluck('total')) !!},
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.8)',
                            'rgba(54, 162, 235, 0.8)',
                            'rgba(255, 206, 86, 0.8)',
                            'rgba(75, 192, 192, 0.8)',
                            'rgba(153, 102, 255, 0.8)',
                            'rgba(255, 159, 64, 0.8)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = ((context.parsed / total) * 100).toFixed(1);
                                    return context.label + ': ' + new Intl.NumberFormat('vi-VN').format(context
                                        .parsed) + ' đ (' + percentage + '%)';
                                }
                            }
                        }
                    }
                }
            });

            function exportReport() {
                alert('Tính năng xuất Excel đang được phát triển');
            }
        </script>
    @endpush

    @push('styles')
        <style>
            @media print {

                .btn,
                .card-header {
                    display: none !important;
                }

                .card {
                    border: 1px solid #dee2e6 !important;
                    page-break-inside: avoid;
                }

                canvas {
                    max-height: 300px !important;
                }
            }
        </style>
    @endpush
@endsection
