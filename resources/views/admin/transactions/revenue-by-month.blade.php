@extends('admin.layouts.app')

@section('title', 'Doanh thu theo tháng')

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">Doanh thu theo tháng</h1>
            <div>
                <a href="{{ route('transactions.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Quay lại
                </a>
            </div>
        </div>

        <!-- Summary Statistics -->
        @php
            $totalRevenue = $revenue->sum('total');
            $totalTransactions = $revenue->sum('count');
            $avgPerMonth = $revenue->count() > 0 ? $totalRevenue / $revenue->count() : 0;
            $maxMonth = $revenue->sortByDesc('total')->first();
        @endphp

        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h5 class="card-title">Tổng doanh thu</h5>
                        <h2 class="mb-0">{{ number_format($totalRevenue) }}đ</h2>
                        <small>12 tháng gần đây</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h5 class="card-title">Tổng giao dịch</h5>
                        <h2 class="mb-0">{{ number_format($totalTransactions) }}</h2>
                        <small>Giao dịch hoàn thành</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <h5 class="card-title">Trung bình/Tháng</h5>
                        <h2 class="mb-0">{{ number_format($avgPerMonth) }}đ</h2>
                        <small>Doanh thu trung bình</small>
                    </div>
                </div>
            </div>
            @if ($maxMonth)
                <div class="col-md-3">
                    <div class="card bg-warning text-white">
                        <div class="card-body">
                            <h5 class="card-title">Tháng cao nhất</h5>
                            <h2 class="mb-0">
                                {{ \Carbon\Carbon::createFromFormat('Y-m', $maxMonth->month)->format('m/Y') }}</h2>
                            <small>{{ number_format($maxMonth->total) }}đ</small>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Revenue Table -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Chi tiết 12 tháng gần đây</h5>
            </div>
            <div class="card-body">
                @if ($revenue->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Tháng/Năm</th>
                                    <th class="text-end">Số giao dịch</th>
                                    <th class="text-end">Doanh thu</th>
                                    <th width="40%">Biểu đồ</th>
                                    <th class="text-center">Xu hướng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $maxRevenue = $revenue->max('total');
                                    $prevRevenue = null;
                                @endphp
                                @foreach ($revenue as $item)
                                    @php
                                        $percentage = $maxRevenue > 0 ? ($item->total / $maxRevenue) * 100 : 0;
                                        $monthName = \Carbon\Carbon::createFromFormat('Y-m', $item->month)->format(
                                            'm/Y',
                                        );

                                        // Calculate trend
                                        $trend = 'neutral';
                                        $trendText = '-';
                                        $trendColor = 'secondary';
                                        $trendIcon = 'minus';

                                        if ($prevRevenue !== null) {
                                            if ($item->total > $prevRevenue) {
                                                $trend = 'up';
                                                $change = (($item->total - $prevRevenue) / $prevRevenue) * 100;
                                                $trendText = '+' . number_format($change, 1) . '%';
                                                $trendColor = 'success';
                                                $trendIcon = 'arrow-up';
                                            } elseif ($item->total < $prevRevenue) {
                                                $trend = 'down';
                                                $change = (($prevRevenue - $item->total) / $prevRevenue) * 100;
                                                $trendText = '-' . number_format($change, 1) . '%';
                                                $trendColor = 'danger';
                                                $trendIcon = 'arrow-down';
                                            } else {
                                                $trendText = '0%';
                                            }
                                        }
                                        $prevRevenue = $item->total;
                                    @endphp
                                    <tr>
                                        <td>
                                            <strong>Tháng
                                                {{ explode('-', $item->month)[1] }}/{{ explode('-', $item->month)[0] }}</strong>
                                        </td>
                                        <td class="text-end">
                                            <span class="badge bg-secondary">{{ number_format($item->count) }}</span>
                                        </td>
                                        <td class="text-end">
                                            <strong class="text-primary">{{ number_format($item->total) }}đ</strong>
                                        </td>
                                        <td>
                                            <div class="progress" style="height: 25px;">
                                                <div class="progress-bar bg-primary" role="progressbar"
                                                    style="width: {{ $percentage }}%"
                                                    aria-valuenow="{{ $percentage }}" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                    @if ($percentage > 20)
                                                        {{ number_format($percentage, 1) }}%
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-{{ $trendColor }}">
                                                <i class="fas fa-{{ $trendIcon }}"></i>
                                                {{ $trendText }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="table-light">
                                <tr>
                                    <th>TỔNG CỘNG</th>
                                    <th class="text-end">
                                        <span class="badge bg-dark">{{ number_format($totalTransactions) }}</span>
                                    </th>
                                    <th class="text-end">
                                        <strong class="text-success">{{ number_format($totalRevenue) }}đ</strong>
                                    </th>
                                    <th colspan="2"></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-chart-bar fa-3x text-muted mb-3"></i>
                        <h5>Chưa có dữ liệu</h5>
                        <p class="text-muted">Chưa có giao dịch nào được hoàn thành</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
