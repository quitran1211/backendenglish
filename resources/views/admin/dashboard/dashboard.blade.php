@extends('admin.layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="container-fluid">

        {{-- PAGE TITLE --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        </div>

        {{-- STAT CARDS --}}
        <div class="row">

            {{-- USERS --}}
            <div class="col-md-3 mb-4">
                <div class="card shadow h-100 border-left-primary">
                    <div class="card-body">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Tổng người dùng
                        </div>
                        <div class="h5 mb-0 font-weight-bold">
                            {{ $stats['total_users'] }}
                        </div>
                        <small class="text-muted">
                            Premium: {{ $stats['premium_users'] }} |
                            Free: {{ $stats['free_users'] }}
                        </small>
                    </div>
                </div>
            </div>

            {{-- LESSONS --}}
            <div class="col-md-3 mb-4">
                <div class="card shadow h-100 border-left-success">
                    <div class="card-body">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Bài học
                        </div>
                        <div class="h5 mb-0 font-weight-bold">
                            {{ $stats['total_lessons'] }}
                        </div>
                        <small class="text-muted">
                            Free: {{ $stats['free_lessons'] }} |
                            Premium: {{ $stats['premium_lessons'] }}
                        </small>
                    </div>
                </div>
            </div>

            {{-- SUBSCRIPTIONS --}}
            <div class="col-md-3 mb-4">
                <div class="card shadow h-100 border-left-warning">
                    <div class="card-body">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Đăng ký
                        </div>
                        <div class="h5 mb-0 font-weight-bold">
                            {{ $stats['active_subscriptions'] }} Đang hoạt động
                        </div>
                        <small class="text-muted">
                            Gần hết hạn: {{ $stats['expiring_soon'] }} <br>
                            Đã hết hạn: {{ $stats['expired_subscriptions'] }}
                        </small>
                    </div>
                </div>
            </div>

            {{-- REVENUE --}}
            <div class="col-md-3 mb-4">
                <div class="card shadow h-100 border-left-danger">
                    <div class="card-body">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                            Doanh thu
                        </div>
                        <div class="h5 mb-0 font-weight-bold">
                            {{ number_format($stats['total_revenue'], 0) }} ₫
                        </div>
                        <small class="text-muted">
                            Tháng này: {{ number_format($stats['revenue_this_month'], 0) }} ₫ <br>
                            Tháng trước: {{ number_format($stats['revenue_last_month'], 0) }} ₫
                        </small>
                    </div>
                </div>
            </div>

        </div>

        {{-- CHART --}}
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">
                            Doanh thu (Trong 12 tháng)
                        </h6>
                    </div>
                    <div class="card-body">
                        <canvas id="revenueChart" height="100"></canvas>
                    </div>
                </div>
            </div>
        </div>

        {{-- RECENT DATA --}}
        <div class="row">

            {{-- RECENT SUBSCRIPTIONS --}}
            <div class="col-md-6 mb-4">
                <div class="card shadow">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Đăng ký gần đây</h6>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Plan</th>
                                    <th>Status</th>
                                    <th>Expires</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentSubscriptions as $sub)
                                    <tr>
                                        <td>{{ $sub->user->username ?? '-' }}</td>
                                        <td>{{ $sub->plan->name ?? '-' }}</td>
                                        <td>
                                            <span
                                                class="badge bg-{{ $sub->status === 'active' ? 'success' : 'secondary' }}">
                                                {{ ucfirst($sub->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $sub->expires_at?->format('d/m/Y') ?? '∞' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted">No data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- RECENT TRANSACTIONS --}}
            <div class="col-md-6 mb-4">
                <div class="card shadow">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Recent Transactions</h6>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Plan</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentTransactions as $tx)
                                    <tr>
                                        <td>{{ $tx->user->username ?? '-' }}</td>
                                        <td>{{ $tx->plan->name ?? '-' }}</td>
                                        <td>{{ number_format($tx->amount, 0) }} ₫</td>
                                        <td>{{ $tx->paid_at?->format('d/m/Y') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted">No data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

{{-- CHART SCRIPT --}}
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('revenueChart').getContext('2d');

        const labels = @json($revenueByMonth->pluck('month'));
        const data = @json($revenueByMonth->pluck('total'));

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Revenue',
                    data: data,
                    tension: 0.3,
                    fill: false,
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        ticks: {
                            callback: value => value.toLocaleString() + ' ₫'
                        }
                    }
                }
            }
        });
    </script>
@endpush
