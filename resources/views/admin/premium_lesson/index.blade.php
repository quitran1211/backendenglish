@extends('admin.layouts.app')

@section('title', 'Quản lý Giao dịch')

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">Quản lý Giao dịch</h1>
            <div>
                <a href="{{ route('transactions.stats') }}" class="btn btn-info">
                    <i class="fas fa-chart-bar"></i> Thống kê
                </a>
                <a href="{{ route('transactions.trash') }}" class="btn btn-secondary">
                    <i class="fas fa-trash"></i> Thùng rác
                </a>
                <a href="{{ route('transactions.export') }}" class="btn btn-success">
                    <i class="fas fa-download"></i> Xuất CSV
                </a>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-md-2">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h5 class="card-title">Hoàn thành</h5>
                        <h2 class="mb-0">{{ number_format($stats['total_completed']) }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <h5 class="card-title">Đang chờ</h5>
                        <h2 class="mb-0">{{ number_format($stats['total_pending']) }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card bg-danger text-white">
                    <div class="card-body">
                        <h5 class="card-title">Thất bại</h5>
                        <h2 class="mb-0">{{ number_format($stats['total_failed']) }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h5 class="card-title">Tổng doanh thu</h5>
                        <h2 class="mb-0">{{ number_format($stats['total_revenue']) }}đ</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <h5 class="card-title">DT hôm nay</h5>
                        <h2 class="mb-0">{{ number_format($stats['revenue_today']) }}đ</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card bg-dark text-white">
                    <div class="card-body">
                        <h5 class="card-title">DT tháng này</h5>
                        <h2 class="mb-0">{{ number_format($stats['revenue_this_month']) }}đ</h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Form -->
        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('transactions.index') }}" method="GET" class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label">Tìm kiếm</label>
                        <input type="text" name="search" class="form-control" placeholder="Mã GD hoặc email..."
                            value="{{ request('search') }}">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Trạng thái</label>
                        <select name="status" class="form-select">
                            <option value="">Tất cả</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Đang chờ
                            </option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Hoàn thành
                            </option>
                            <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>Thất bại</option>
                            <option value="refunded" {{ request('status') == 'refunded' ? 'selected' : '' }}>Đã hoàn tiền
                            </option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Phương thức</label>
                        <select name="payment_method" class="form-select">
                            <option value="">Tất cả</option>
                            <option value="vnpay" {{ request('payment_method') == 'vnpay' ? 'selected' : '' }}>VNPay
                            </option>
                            <option value="momo" {{ request('payment_method') == 'momo' ? 'selected' : '' }}>MoMo
                            </option>
                            <option value="bank_transfer"
                                {{ request('payment_method') == 'bank_transfer' ? 'selected' : '' }}>Chuyển khoản</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Từ ngày</label>
                        <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Đến ngày</label>
                        <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}">
                    </div>
                    <div class="col-md-1">
                        <label class="form-label">&nbsp;</label>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search"></i> Lọc
                            </button>
                            <a href="{{ route('transactions.index') }}" class="btn btn-secondary">
                                <i class="fas fa-redo"></i>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Bulk Actions -->
        <div class="card mb-4">
            <div class="card-body">
                <form id="bulkActionForm" action="{{ route('transactions.bulkAction') }}" method="POST" class="d-inline">
                    @csrf
                    <div class="row align-items-end">
                        <div class="col-md-4">
                            <label class="form-label">Thao tác hàng loạt</label>
                            <select name="action" class="form-select" required>
                                <option value="">Chọn thao tác...</option>
                                <option value="complete">Đánh dấu hoàn thành</option>
                                <option value="fail">Đánh dấu thất bại</option>
                                <option value="delete">Xóa</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-warning" onclick="return confirm('Bạn có chắc chắn?')">
                                <i class="fas fa-bolt"></i> Thực hiện
                            </button>
                        </div>
                        <div class="col-md-5 text-end">
                            <a href="{{ route('transactions.revenueByMonth') }}" class="btn btn-dark">
                                <i class="fas fa-calendar"></i> Doanh thu theo tháng
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Transactions Table -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="50">
                                    <input type="checkbox" id="selectAll">
                                </th>
                                <th>Mã GD</th>
                                <th>Người dùng</th>
                                <th>Gói</th>
                                <th>Số tiền</th>
                                <th>Phương thức</th>
                                <th>Trạng thái</th>
                                <th>Ngày thanh toán</th>
                                <th width="150">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transactions as $transaction)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="ids[]" value="{{ $transaction->id }}"
                                            class="transaction-checkbox" form="bulkActionForm">
                                    </td>
                                    <td>
                                        <strong>{{ $transaction->transaction_code }}</strong>
                                    </td>
                                    <td>
                                        <div>
                                            <strong>{{ $transaction->user->name }}</strong>
                                            <br>
                                            <small class="text-muted">{{ $transaction->user->email }}</small>
                                        </div>
                                    </td>
                                    <td>
                                        @if ($transaction->plan)
                                            <span class="badge bg-primary">{{ $transaction->plan->name }}</span>
                                        @else
                                            <span class="badge bg-secondary">N/A</span>
                                        @endif
                                    </td>
                                    <td>
                                        <strong>{{ number_format($transaction->amount) }}đ</strong>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary">
                                            {{ strtoupper($transaction->payment_method) }}
                                        </span>
                                    </td>
                                    <td>
                                        @php
                                            $statusColors = [
                                                'completed' => 'success',
                                                'pending' => 'warning',
                                                'failed' => 'danger',
                                                'refunded' => 'secondary',
                                            ];
                                            $statusLabels = [
                                                'completed' => 'Hoàn thành',
                                                'pending' => 'Đang chờ',
                                                'failed' => 'Thất bại',
                                                'refunded' => 'Đã hoàn tiền',
                                            ];
                                        @endphp
                                        <span class="badge bg-{{ $statusColors[$transaction->status] ?? 'secondary' }}">
                                            {{ $statusLabels[$transaction->status] ?? $transaction->status }}
                                        </span>
                                    </td>
                                    <td>
                                        {{ $transaction->paid_at ? $transaction->paid_at->format('d/m/Y H:i') : '-' }}
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('transactions.show', $transaction) }}" class="btn btn-info"
                                                title="Chi tiết">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <form action="{{ route('transactions.destroy', $transaction) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" title="Xóa"
                                                    onclick="return confirm('Xóa giao dịch này?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center py-4">
                                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                        <p class="text-muted">Không có giao dịch nào</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-3">
                    {{ $transactions->links() }}
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Select all checkboxes
            document.getElementById('selectAll').addEventListener('change', function() {
                const checkboxes = document.querySelectorAll('.transaction-checkbox');
                checkboxes.forEach(checkbox => checkbox.checked = this.checked);
            });
        </script>
    @endpush
@endsection
