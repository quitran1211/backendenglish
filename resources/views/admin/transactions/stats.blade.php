@extends('admin.layouts.app')

@section('title', 'Thống kê Giao dịch')

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">Thống kê Giao dịch</h1>
            <div>
                <a href="{{ route('transactions.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Quay lại
                </a>
            </div>
        </div>

        <!-- Overview Statistics -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h5 class="card-title">Tổng doanh thu</h5>
                        <h2 class="mb-0">{{ number_format($stats['total_revenue']) }}đ</h2>
                        <small>Tất cả thời gian</small>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <h5 class="card-title">Tổng giao dịch</h5>
                        <h2 class="mb-0">{{ number_format($stats['total_transactions']) }}</h2>
                        <small>Tất cả trạng thái</small>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h5 class="card-title">Trung bình/GD</h5>
                        <h2 class="mb-0">{{ number_format($stats['avg_transaction']) }}đ</h2>
                        <small>Giá trị trung bình</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- By Status -->
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Thống kê theo trạng thái</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Trạng thái</th>
                                    <th class="text-end">Số lượng</th>
                                    <th class="text-end">Tổng tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $statusLabels = [
                                        'completed' => ['label' => 'Hoàn thành', 'color' => 'success'],
                                        'pending' => ['label' => 'Đang chờ', 'color' => 'warning'],
                                        'failed' => ['label' => 'Thất bại', 'color' => 'danger'],
                                        'refunded' => ['label' => 'Đã hoàn tiền', 'color' => 'secondary'],
                                    ];
                                @endphp
                                @foreach ($stats['by_status'] as $item)
                                    <tr>
                                        <td>
                                            <span
                                                class="badge bg-{{ $statusLabels[$item->status]['color'] ?? 'secondary' }}">
                                                {{ $statusLabels[$item->status]['label'] ?? $item->status }}
                                            </span>
                                        </td>
                                        <td class="text-end">
                                            <strong>{{ number_format($item->count) }}</strong>
                                        </td>
                                        <td class="text-end">
                                            <strong>{{ number_format($item->total) }}đ</strong>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- By Payment Method -->
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Thống kê theo phương thức</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Phương thức</th>
                                    <th class="text-end">Số lượng</th>
                                    <th class="text-end">Tổng tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $methodLabels = [
                                        'vnpay' => 'VNPay',
                                        'momo' => 'MoMo',
                                        'bank_transfer' => 'Chuyển khoản',
                                        'card' => 'Thẻ ngân hàng',
                                    ];
                                    $totalCompleted = $stats['by_method']->sum('count');
                                @endphp
                                @foreach ($stats['by_method'] as $method)
                                    @php
                                        $percentage =
                                            $totalCompleted > 0 ? ($method->count / $totalCompleted) * 100 : 0;
                                    @endphp
                                    <tr>
                                        <td>
                                            <strong>{{ $methodLabels[$method->payment_method] ?? $method->payment_method }}</strong>
                                            <div class="progress mt-1" style="height: 5px;">
                                                <div class="progress-bar bg-primary" role="progressbar"
                                                    style="width: {{ $percentage }}%" aria-valuenow="{{ $percentage }}"
                                                    aria-valuemin="0" aria-valuemax="100">
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-end">
                                            <strong>{{ number_format($method->count) }}</strong>
                                            <br>
                                            <small class="text-muted">{{ number_format($percentage, 1) }}%</small>
                                        </td>
                                        <td class="text-end">
                                            <strong>{{ number_format($method->total) }}đ</strong>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
