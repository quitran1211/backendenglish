@extends('admin.layouts.app')

@section('title', 'Chi tiết gói: ' . $subscriptionPlan->name)

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">
                <i class="fas fa-tag"></i> {{ $subscriptionPlan->name }}
            </h1>
            <div>
                <a href="{{ route('subscription-plans.edit', $subscriptionPlan) }}" class="btn btn-primary">
                    <i class="fas fa-edit"></i> Sửa
                </a>
                <a href="{{ route('subscription-plans.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Quay lại
                </a>
            </div>
        </div>

        <div class="row">
            <!-- Main Information -->
            <div class="col-md-8">
                <!-- Plan Details Card -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-info-circle"></i> Thông tin gói</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="text-muted small">ID Gói</label>
                                <p class="fw-bold">#{{ $subscriptionPlan->id }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="text-muted small">Trạng thái</label>
                                <p>
                                    @if ($subscriptionPlan->is_active)
                                        <span class="badge bg-success fs-6">
                                            <i class="fas fa-check-circle"></i> Đang hoạt động
                                        </span>
                                    @else
                                        <span class="badge bg-secondary fs-6">
                                            <i class="fas fa-times-circle"></i> Vô hiệu hóa
                                        </span>
                                    @endif
                                </p>
                            </div>
                        </div>

                        <hr>

                        <div class="mb-3">
                            <label class="text-muted small">Tên gói</label>
                            <h4 class="mb-0">{{ $subscriptionPlan->name }}</h4>
                        </div>

                        @if ($subscriptionPlan->description)
                            <div class="mb-3">
                                <label class="text-muted small">Mô tả</label>
                                <p class="mb-0">{{ $subscriptionPlan->description }}</p>
                            </div>
                        @endif

                        <hr>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="text-muted small">Thời hạn</label>
                                <h3 class="mb-0 text-info">
                                    {{ $subscriptionPlan->duration_days }} ngày
                                </h3>
                                <small class="text-muted">
                                    (~{{ round($subscriptionPlan->duration_days / 30, 1) }} tháng)
                                </small>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="text-muted small">Giá</label>
                                <h3 class="mb-0 text-success">
                                    {{ number_format($subscriptionPlan->price) }} đ
                                </h3>
                                <small class="text-muted">
                                    {{ number_format($subscriptionPlan->price / $subscriptionPlan->duration_days) }} đ/ngày
                                </small>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="text-muted small">Thứ tự hiển thị</label>
                                <h3 class="mb-0 text-dark">
                                    {{ $subscriptionPlan->sort_order ?? 'N/A' }}
                                </h3>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="text-muted small">Ngày tạo</label>
                                <p class="mb-0">
                                    {{ $subscriptionPlan->created_at->format('d/m/Y H:i') }}<br>
                                    <small class="text-muted">{{ $subscriptionPlan->created_at->diffForHumans() }}</small>
                                </p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="text-muted small">Cập nhật lần cuối</label>
                                <p class="mb-0">
                                    {{ $subscriptionPlan->updated_at->format('d/m/Y H:i') }}<br>
                                    <small class="text-muted">{{ $subscriptionPlan->updated_at->diffForHumans() }}</small>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Subscriptions List -->
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="fas fa-users"></i> Danh sách đăng ký
                            <span class="badge bg-primary">{{ $subscriptions->total() }}</span>
                        </h5>
                        <a href="{{ route('subscriptions.create', ['plan_id' => $subscriptionPlan->id]) }}"
                            class="btn btn-sm btn-primary">
                            <i class="fas fa-plus"></i> Tạo đăng ký
                        </a>
                    </div>
                    <div class="card-body">
                        @if ($subscriptions->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Người dùng</th>
                                            <th>Trạng thái</th>
                                            <th>Ngày bắt đầu</th>
                                            <th>Ngày hết hạn</th>
                                            <th>Số tiền</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($subscriptions as $subscription)
                                            <tr>
                                                <td>#{{ $subscription->id }}</td>
                                                <td>
                                                    <div>
                                                        <strong>{{ $subscription->user->name }}</strong><br>
                                                        <small class="text-muted">{{ $subscription->user->email }}</small>
                                                    </div>
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
                                                    <span
                                                        class="badge bg-{{ $statusColors[$subscription->status] ?? 'secondary' }}">
                                                        {{ $statusLabels[$subscription->status] ?? $subscription->status }}
                                                    </span>
                                                </td>
                                                <td>{{ $subscription->started_at?->format('d/m/Y') }}</td>
                                                <td>
                                                    @if ($subscription->expires_at)
                                                        {{ $subscription->expires_at->format('d/m/Y') }}
                                                        @if ($subscription->status == 'active' && $subscription->expires_at->diffInDays(now()) <= 7)
                                                            <br><small class="text-warning">Sắp hết hạn</small>
                                                        @endif
                                                    @else
                                                        <span class="text-muted">Không giới hạn</span>
                                                    @endif
                                                </td>
                                                <td>{{ number_format($subscription->amount_paid) }}đ</td>
                                                <td>
                                                    <a href="{{ route('subscriptions.show', $subscription) }}"
                                                        class="btn btn-sm btn-info">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination -->
                            <div class="mt-3">
                                {{ $subscriptions->links() }}
                            </div>
                        @else
                            <div class="text-center py-4">
                                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                <p class="text-muted">Chưa có đăng ký nào cho gói này</p>
                                <a href="{{ route('subscriptions.create', ['plan_id' => $subscriptionPlan->id]) }}"
                                    class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Tạo đăng ký đầu tiên
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-md-4">
                <!-- Quick Actions -->
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-bolt"></i> Thao tác nhanh</h5>
                    </div>
                    <div class="card-body">
                        <!-- Edit -->
                        <a href="{{ route('subscription-plans.edit', $subscriptionPlan) }}"
                            class="btn btn-primary w-100 mb-2">
                            <i class="fas fa-edit"></i> Chỉnh sửa gói
                        </a>

                        <!-- Toggle Active -->
                        <form action="{{ route('subscription-plans.toggleActive', $subscriptionPlan) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit"
                                class="btn btn-{{ $subscriptionPlan->is_active ? 'warning' : 'success' }} w-100 mb-2">
                                <i class="fas fa-{{ $subscriptionPlan->is_active ? 'ban' : 'check' }}"></i>
                                {{ $subscriptionPlan->is_active ? 'Vô hiệu hóa' : 'Kích hoạt' }}
                            </button>
                        </form>

                        <!-- Create Subscription -->
                        <a href="{{ route('subscriptions.create', ['plan_id' => $subscriptionPlan->id]) }}"
                            class="btn btn-success w-100 mb-2">
                            <i class="fas fa-user-plus"></i> Tạo đăng ký mới
                        </a>

                        <!-- Delete -->
                        <form action="{{ route('subscription-plans.destroy', $subscriptionPlan) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100"
                                onclick="return confirm('Xóa gói này?\nLưu ý: Chỉ có thể xóa nếu không còn đăng ký đang hoạt động.')">
                                <i class="fas fa-trash"></i> Xóa gói
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Statistics -->
                <div class="card mb-4">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0"><i class="fas fa-chart-bar"></i> Thống kê</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="text-muted small">Tổng đăng ký</label>
                            <h2 class="mb-0">{{ $subscriptions->total() }}</h2>
                        </div>

                        <div class="mb-3">
                            <label class="text-muted small">Đang hoạt động</label>
                            <h2 class="mb-0 text-success">
                                {{ $subscriptionPlan->subscriptions()->where('status', 'active')->count() }}
                            </h2>
                        </div>

                        <div class="mb-3">
                            <label class="text-muted small">Đã hết hạn</label>
                            <h2 class="mb-0 text-danger">
                                {{ $subscriptionPlan->subscriptions()->where('status', 'expired')->count() }}
                            </h2>
                        </div>

                        <hr>

                        <div class="mb-3">
                            <label class="text-muted small">Tổng doanh thu</label>
                            <h3 class="mb-0 text-primary">
                                {{ number_format($subscriptionPlan->subscriptions()->sum('amount_paid')) }} đ
                            </h3>
                        </div>

                        <div class="mb-0">
                            <label class="text-muted small">Doanh thu trung bình</label>
                            <h4 class="mb-0">
                                @php
                                    $avgRevenue =
                                        $subscriptions->total() > 0
                                            ? $subscriptionPlan->subscriptions()->sum('amount_paid') /
                                                $subscriptions->total()
                                            : 0;
                                @endphp
                                {{ number_format($avgRevenue) }} đ
                            </h4>
                        </div>
                    </div>
                </div>

                <!-- Plan Preview -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-eye"></i> Xem trước (User view)</h5>
                    </div>
                    <div class="card-body text-center">
                        <div class="pricing-card">
                            @if (!$subscriptionPlan->is_active)
                                <div class="badge bg-secondary mb-2">Không khả dụng</div>
                            @endif

                            <h3 class="fw-bold">{{ $subscriptionPlan->name }}</h3>

                            @if ($subscriptionPlan->description)
                                <p class="text-muted small">{{ $subscriptionPlan->description }}</p>
                            @endif

                            <hr>

                            <div class="price mb-3">
                                <h1 class="text-success mb-0">
                                    {{ number_format($subscriptionPlan->price) }}
                                    <small class="fs-6">đ</small>
                                </h1>
                                <p class="text-muted small mb-0">
                                    {{ $subscriptionPlan->duration_days }} ngày
                                </p>
                            </div>

                            <hr>

                            <div class="small text-muted">
                                <i class="fas fa-calculator"></i>
                                {{ number_format($subscriptionPlan->price / $subscriptionPlan->duration_days) }} đ/ngày
                            </div>

                            @if ($subscriptionPlan->is_active)
                                <button class="btn btn-primary w-100 mt-3" disabled>
                                    <i class="fas fa-shopping-cart"></i> Đăng ký ngay
                                </button>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Price Comparison -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-balance-scale"></i> So sánh giá</h5>
                    </div>
                    <div class="card-body">
                        @php
                            $allPlans = \App\Models\SubscriptionPlan::where('is_active', true)
                                ->where('id', '!=', $subscriptionPlan->id)
                                ->orderBy('price')
                                ->take(3)
                                ->get();
                        @endphp

                        @if ($allPlans->count() > 0)
                            <p class="small text-muted">So với các gói khác:</p>
                            @foreach ($allPlans as $otherPlan)
                                <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom">
                                    <div>
                                        <strong class="small">{{ $otherPlan->name }}</strong><br>
                                        <small class="text-muted">{{ number_format($otherPlan->price) }}đ</small>
                                    </div>
                                    <div>
                                        @php
                                            $diff = $subscriptionPlan->price - $otherPlan->price;
                                            $percent =
                                                $otherPlan->price > 0 ? abs(($diff / $otherPlan->price) * 100) : 0;
                                        @endphp
                                        @if ($diff > 0)
                                            <span class="badge bg-danger small">+{{ number_format($percent, 0) }}%</span>
                                        @elseif($diff < 0)
                                            <span class="badge bg-success small">-{{ number_format($percent, 0) }}%</span>
                                        @else
                                            <span class="badge bg-secondary small">Bằng nhau</span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="text-muted small mb-0">Không có gói khác để so sánh</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            .pricing-card {
                padding: 1rem;
                border: 2px solid #e9ecef;
                border-radius: 0.5rem;
            }

            .pricing-card:hover {
                border-color: #0d6efd;
                box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
            }
        </style>
    @endpush
@endsection
