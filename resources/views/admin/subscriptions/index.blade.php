@extends('admin.layouts.app')

@section('title', 'Quản lý Đăng ký')

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">Quản lý Đăng ký</h1>
            <div>
                <a href="{{ route('subscriptions.expiringSoon') }}" class="btn btn-warning">
                    <i class="fas fa-clock"></i> Sắp hết hạn
                </a>
                <a href="{{ route('subscriptions.trash') }}" class="btn btn-secondary">
                    <i class="fas fa-trash"></i> Thùng rác
                </a>
                <a href="{{ route('subscriptions.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tạo đăng ký mới
                </a>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h5 class="card-title">Đang hoạt động</h5>
                        <h2 class="mb-0">{{ number_format($stats['total_active']) }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <h5 class="card-title">Sắp hết hạn (7 ngày)</h5>
                        <h2 class="mb-0">{{ number_format($stats['expiring_soon']) }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-danger text-white">
                    <div class="card-body">
                        <h5 class="card-title">Đã hết hạn</h5>
                        <h2 class="mb-0">{{ number_format($stats['expired']) }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <h5 class="card-title">Tổng doanh thu</h5>
                        <h2 class="mb-0">{{ number_format($stats['total_revenue']) }} đ</h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Form -->
        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('subscriptions.index') }}" method="GET" class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label">Tìm kiếm người dùng</label>
                        <input type="text" name="search" class="form-control" placeholder="Tên hoặc email..."
                            value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Trạng thái</label>
                        <select name="status" class="form-select">
                            <option value="">Tất cả</option>
                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Đang hoạt động
                            </option>
                            <option value="expired" {{ request('status') == 'expired' ? 'selected' : '' }}>Đã hết hạn
                            </option>
                            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Đã hủy
                            </option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Gói dịch vụ</label>
                        <select name="plan_id" class="form-select">
                            <option value="">Tất cả</option>
                            @foreach ($plans as $plan)
                                <option value="{{ $plan->id }}"
                                    {{ request('plan_id') == $plan->id ? 'selected' : '' }}>
                                    {{ $plan->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">&nbsp;</label>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary flex-fill">
                                <i class="fas fa-search"></i> Lọc
                            </button>
                            <a href="{{ route('subscriptions.index') }}" class="btn btn-secondary">
                                <i class="fas fa-redo"></i>
                            </a>
                        </div>
                    </div>
                </form>
                <div class="mt-3">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="expiring_soon" id="expiringSoon"
                            {{ request()->has('expiring_soon') ? 'checked' : '' }} onchange="this.form.submit()">
                        <label class="form-check-label" for="expiringSoon">
                            Chỉ hiển thị sắp hết hạn
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bulk Actions & Export -->
        <div class="card mb-4">
            <div class="card-body">
                <form id="bulkActionForm" action="{{ route('subscriptions.bulkAction') }}" method="POST" class="d-inline">
                    @csrf
                    <div class="row align-items-end">
                        <div class="col-md-4">
                            <label class="form-label">Thao tác hàng loạt</label>
                            <select name="action" class="form-select" required>
                                <option value="">Chọn thao tác...</option>
                                <option value="cancel">Hủy đăng ký</option>
                                <option value="delete">Xóa</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-warning" onclick="return confirm('Bạn có chắc chắn?')">
                                <i class="fas fa-bolt"></i> Thực hiện
                            </button>
                        </div>
                        <div class="col-md-5 text-end">
                            <a href="{{ route('subscriptions.checkExpired') }}" class="btn btn-info"
                                onclick="return confirm('Kiểm tra và cập nhật trạng thái hết hạn?')">
                                <i class="fas fa-sync"></i> Kiểm tra hết hạn
                            </a>
                            <a href="{{ route('subscriptions.export') }}?{{ http_build_query(request()->all()) }}"
                                class="btn btn-success">
                                <i class="fas fa-file-excel"></i> Xuất CSV
                            </a>
                            <a href="{{ route('subscriptions.revenueReport') }}" class="btn btn-dark">
                                <i class="fas fa-chart-bar"></i> Báo cáo doanh thu
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Subscriptions Table -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="50">
                                    <input type="checkbox" id="selectAll">
                                </th>
                                <th>ID</th>
                                <th>Người dùng</th>
                                <th>Gói dịch vụ</th>
                                <th>Trạng thái</th>
                                <th>Ngày bắt đầu</th>
                                <th>Ngày hết hạn</th>
                                <th>Số tiền</th>
                                <th width="150">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($subscriptions as $subscription)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="ids[]" value="{{ $subscription->id }}"
                                            class="subscription-checkbox" form="bulkActionForm">
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
                                        @else
                                            <span class="badge bg-secondary">N/A</span>
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                            $statusColors = [
                                                'active' => 'success',
                                                'expired' => 'danger',
                                                'cancelled' => 'secondary',
                                            ];
                                            $statusLabels = [
                                                'active' => 'Hoạt động',
                                                'expired' => 'Hết hạn',
                                                'cancelled' => 'Đã hủy',
                                            ];
                                        @endphp
                                        <span class="badge bg-{{ $statusColors[$subscription->status] ?? 'secondary' }}">
                                            {{ $statusLabels[$subscription->status] ?? $subscription->status }}
                                        </span>
                                    </td>
                                    <td>{{ $subscription->started_at?->format('d/m/Y') }}</td>
                                    <td>
                                        @if ($subscription->expires_at)
                                            {{ $subscription->expires_at->format('d/m/Y') }}

                                            @if (
                                                $subscription->status === 'active' &&
                                                    $subscription->days_remaining !== null &&
                                                    $subscription->days_remaining <= 7 &&
                                                    $subscription->days_remaining > 0)
                                                <br>
                                                <small class="text-warning">
                                                    <i class="fas fa-exclamation-triangle"></i>
                                                    Còn {{ $subscription->days_remaining }} ngày
                                                </small>
                                            @endif
                                        @else
                                            <span class="text-muted">Không giới hạn</span>
                                        @endif
                                    </td>

                                    <td>{{ number_format($subscription->amount_paid) }} đ</td>
                                    <td>
                                        <div class="btn-group btn-group-sm gap-2">
                                            <a href="{{ route('subscriptions.show', $subscription) }}"
                                                class="btn btn-info rounded" title="Chi tiết">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('subscriptions.edit', $subscription) }}"
                                                class="btn btn-primary rounded" title="Sửa">
                                                <i class="fas fa-edit "></i>
                                            </a>
                                            @if ($subscription->status == 'active')
                                                <form action="{{ route('subscriptions.cancel', $subscription) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-warning" title="Hủy"
                                                        onclick="return confirm('Hủy đăng ký này?')">
                                                        <i class="fas fa-ban"></i>
                                                    </button>
                                                </form>
                                            @endif
                                            <form action="{{ route('subscriptions.destroy', $subscription) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" title="Xóa"
                                                    onclick="return confirm('Xóa đăng ký này?')">
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
                                        <p class="text-muted">Không có đăng ký nào</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-3">
                    {{ $subscriptions->links() }}
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Select all checkboxes
            document.getElementById('selectAll').addEventListener('change', function() {
                const checkboxes = document.querySelectorAll('.subscription-checkbox');
                checkboxes.forEach(checkbox => checkbox.checked = this.checked);
            });
        </script>
    @endpush
@endsection
