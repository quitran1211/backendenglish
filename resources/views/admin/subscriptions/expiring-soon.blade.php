@extends('admin.layouts.app')

@section('title', 'Đăng ký sắp hết hạn')

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">
                <i class="fas fa-clock text-warning"></i> Đăng ký sắp hết hạn
            </h1>
            <a href="{{ route('subscriptions.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Quay lại
            </a>
        </div>

        <!-- Alert Info -->
        <div class="alert alert-warning mb-4">
            <i class="fas fa-exclamation-triangle"></i>
            <strong>Cảnh báo:</strong> Các đăng ký dưới đây sẽ hết hạn trong vòng 7 ngày tới.
            Hãy liên hệ với người dùng để gia hạn hoặc thông báo về việc hết hạn.
        </div>

        <!-- Statistics -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card bg-danger text-white">
                    <div class="card-body">
                        <h6 class="card-title">Hết hạn hôm nay</h6>
                        <h2 class="mb-0">
                            {{ $subscriptions->filter(fn($s) => $s->expires_at->isToday())->count() }}
                        </h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <h6 class="card-title">Hết hạn trong 3 ngày</h6>
                        <h2 class="mb-0">
                            {{ $subscriptions->filter(fn($s) => $s->expires_at->diffInDays(now()) <= 3)->count() }}
                        </h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <h6 class="card-title">Hết hạn trong 7 ngày</h6>
                        <h2 class="mb-0">{{ $subscriptions->count() }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h6 class="card-title">Tiềm năng doanh thu</h6>
                        <h2 class="mb-0">
                            {{ number_format($subscriptions->sum(fn($s) => $s->plan->price ?? 0) / 1000) }}K
                        </h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6><i class="fas fa-envelope"></i> Thao tác hàng loạt</h6>
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary btn-sm"
                                onclick="alert('Tính năng gửi email nhắc nhở đang phát triển')">
                                <i class="fas fa-paper-plane"></i> Gửi email nhắc nhở tất cả
                            </button>
                            <button type="button" class="btn btn-success btn-sm"
                                onclick="alert('Tính năng gia hạn tự động đang phát triển')">
                                <i class="fas fa-sync"></i> Gia hạn tự động
                            </button>
                        </div>
                    </div>
                    <div class="col-md-6 text-end">
                        <h6><i class="fas fa-download"></i> Xuất dữ liệu</h6>
                        <button type="button" class="btn btn-outline-success btn-sm" onclick="exportToCSV()">
                            <i class="fas fa-file-csv"></i> Xuất CSV
                        </button>
                        <button type="button" class="btn btn-outline-primary btn-sm" onclick="window.print()">
                            <i class="fas fa-print"></i> In danh sách
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Subscriptions Table -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="expiringTable">
                        <thead>
                            <tr>
                                <th>Mức độ</th>
                                <th>ID</th>
                                <th>Người dùng</th>
                                <th>Gói dịch vụ</th>
                                <th>Ngày hết hạn</th>
                                <th>Còn lại</th>
                                <th>Số tiền</th>
                                <th width="200">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($subscriptions as $subscription)
                                @php
                                    $daysLeft = $subscription->expires_at->diffInDays(now());
                                    $urgencyClass = $daysLeft <= 1 ? 'danger' : ($daysLeft <= 3 ? 'warning' : 'info');
                                    $urgencyIcon =
                                        $daysLeft <= 1
                                            ? 'exclamation-circle'
                                            : ($daysLeft <= 3
                                                ? 'exclamation-triangle'
                                                : 'info-circle');
                                @endphp
                                <tr class="table-{{ $urgencyClass }}">
                                    <td class="text-center">
                                        <i class="fas fa-{{ $urgencyIcon }} fa-lg"></i>
                                    </td>
                                    <td>{{ $subscription->id }}</td>
                                    <td>
                                        <div>
                                            <strong>{{ $subscription->user->name }}</strong>
                                            <br>
                                            <small class="text-muted">{{ $subscription->user->email }}</small>
                                        </div>
                                    </td>
                                    <td>
                                        @if ($subscription->plan)
                                            <span class="badge bg-primary">{{ $subscription->plan->name }}</span>
                                            <br>
                                            <small
                                                class="text-muted">{{ number_format($subscription->plan->price) }}đ</small>
                                        @else
                                            <span class="badge bg-secondary">N/A</span>
                                        @endif
                                    </td>
                                    <td>
                                        <strong>{{ $subscription->expires_at->format('d/m/Y') }}</strong>
                                        <br>
                                        <small class="text-muted">{{ $subscription->expires_at->format('H:i') }}</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $urgencyClass }} fs-6">
                                            @if ($subscription->expires_at->isToday())
                                                Hôm nay!
                                            @else
                                                {{ $daysLeft }} ngày
                                            @endif
                                        </span>
                                    </td>
                                    <td>
                                        <strong>{{ number_format($subscription->amount_paid) }}đ</strong>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <!-- Quick Extend -->
                                            <div class="dropdown">
                                                <button class="btn btn-success dropdown-toggle" type="button"
                                                    data-bs-toggle="dropdown">
                                                    <i class="fas fa-plus"></i> Gia hạn
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <form action="{{ route('subscriptions.extend', $subscription) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="additional_days" value="30">
                                                            <button type="submit" class="dropdown-item">30 ngày</button>
                                                        </form>
                                                    </li>
                                                    <li>
                                                        <form action="{{ route('subscriptions.extend', $subscription) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="additional_days" value="90">
                                                            <button type="submit" class="dropdown-item">90 ngày</button>
                                                        </form>
                                                    </li>
                                                    <li>
                                                        <form action="{{ route('subscriptions.extend', $subscription) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="additional_days" value="365">
                                                            <button type="submit" class="dropdown-item">365 ngày</button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>

                                            <!-- View -->
                                            <a href="{{ route('subscriptions.show', $subscription) }}" class="btn btn-info"
                                                title="Chi tiết">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            <!-- Send Reminder -->
                                            <button type="button" class="btn btn-primary" title="Gửi email nhắc nhở"
                                                onclick="sendReminder({{ $subscription->id }}, '{{ $subscription->user->email }}')">
                                                <i class="fas fa-envelope"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-5">
                                        <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
                                        <p class="text-muted">Không có đăng ký nào sắp hết hạn trong 7 ngày tới</p>
                                        <a href="{{ route('subscriptions.index') }}" class="btn btn-primary">
                                            <i class="fas fa-list"></i> Về danh sách đăng ký
                                        </a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Renewal Tips -->
        @if ($subscriptions->count() > 0)
            <div class="card mt-4">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="fas fa-lightbulb"></i> Mẹo gia hạn hiệu quả</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <h6><i class="fas fa-bell"></i> Thông báo sớm</h6>
                            <p class="small">Gửi email nhắc nhở 7 ngày trước khi hết hạn để khách hàng có thời gian chuẩn
                                bị.</p>
                        </div>
                        <div class="col-md-4">
                            <h6><i class="fas fa-gift"></i> Ưu đãi gia hạn</h6>
                            <p class="small">Cung cấp giảm giá hoặc ưu đãi đặc biệt cho khách hàng gia hạn sớm.</p>
                        </div>
                        <div class="col-md-4">
                            <h6><i class="fas fa-headset"></i> Hỗ trợ tận tình</h6>
                            <p class="small">Liên hệ trực tiếp qua điện thoại hoặc chat với khách hàng VIP.</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    @push('scripts')
        <script>
            function sendReminder(subscriptionId, userEmail) {
                if (confirm(`Gửi email nhắc nhở đến ${userEmail}?`)) {
                    // TODO: Implement send reminder functionality
                    alert('Tính năng gửi email đang được phát triển');
                }
            }

            function exportToCSV() {
                const table = document.getElementById('expiringTable');
                let csv = [];
                const rows = table.querySelectorAll('tr');

                for (let i = 0; i < rows.length; i++) {
                    const row = [],
                        cols = rows[i].querySelectorAll('td, th');

                    for (let j = 1; j < cols.length - 1; j++) { // Skip first (icon) and last (actions) column
                        let data = cols[j].innerText.replace(/(\r\n|\n|\r)/gm, ' ').trim();
                        row.push('"' + data + '"');
                    }

                    csv.push(row.join(','));
                }

                const csvFile = new Blob([csv.join('\n')], {
                    type: 'text/csv'
                });
                const downloadLink = document.createElement('a');
                downloadLink.download = 'expiring_subscriptions_' + new Date().getTime() + '.csv';
                downloadLink.href = window.URL.createObjectURL(csvFile);
                downloadLink.style.display = 'none';
                document.body.appendChild(downloadLink);
                downloadLink.click();
                document.body.removeChild(downloadLink);
            }
        </script>
    @endpush

    @push('styles')
        <style>
            @media print {

                .btn,
                .dropdown,
                .alert {
                    display: none !important;
                }

                .card {
                    border: none !important;
                    box-shadow: none !important;
                }
            }
        </style>
    @endpush
@endsection
