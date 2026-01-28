@extends('admin.layouts.app')

@section('title', 'Chi tiết đăng ký #' . $subscription->id)

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">Chi tiết đăng ký #{{ $subscription->id }}</h1>
            <div>
                <a href="{{ route('subscriptions.edit', $subscription) }}" class="btn btn-primary">
                    <i class="fas fa-edit"></i> Sửa
                </a>
                <a href="{{ route('subscriptions.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Quay lại
                </a>
            </div>
        </div>

        <div class="row">
            <!-- Main Information -->
            <div class="col-md-8">
                <!-- Subscription Details Card -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-file-alt"></i> Thông tin đăng ký</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="text-muted small">ID Đăng ký</label>
                                <p class="fw-bold">#{{ $subscription->id }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="text-muted small">Trạng thái</label>
                                <p>
                                    @php
                                        $statusColors = [
                                            'active' => 'success',
                                            'expired' => 'danger',
                                            'cancelled' => 'secondary',
                                        ];
                                        $statusLabels = [
                                            'active' => 'Đang hoạt động',
                                            'expired' => 'Đã hết hạn',
                                            'cancelled' => 'Đã hủy',
                                        ];
                                    @endphp
                                    <span class="badge bg-{{ $statusColors[$subscription->status] ?? 'secondary' }} fs-6">
                                        {{ $statusLabels[$subscription->status] ?? $subscription->status }}
                                    </span>
                                </p>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="text-muted small">Người dùng</label>
                                <p class="fw-bold">
                                    {{ $subscription->user->name }}<br>
                                    <small class="text-muted">{{ $subscription->user->email }}</small>
                                </p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="text-muted small">Gói dịch vụ</label>
                                <p>
                                    @if ($subscription->plan)
                                        <span class="badge bg-primary fs-6">{{ $subscription->plan->name }}</span><br>
                                        <small class="text-muted">
                                            {{ number_format($subscription->plan->price) }}đ -
                                            {{ $subscription->plan->duration_days }} ngày
                                        </small>
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </p>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="text-muted small">Ngày bắt đầu</label>
                                <p class="fw-bold">
                                    @if ($subscription->started_at)
                                        {{ $subscription->started_at->format('d/m/Y H:i') }}<br>
                                        <small class="text-muted">
                                            {{ $subscription->started_at->diffForHumans() }}
                                        </small>
                                    @else
                                        <span class="text-muted">Chưa có</span>
                                    @endif
                                </p>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="text-muted small">Ngày hết hạn</label>
                                <p class="fw-bold">
                                    @if ($subscription->expires_at)
                                        {{ $subscription->expires_at->format('d/m/Y H:i') }}<br>
                                        <small class="text-muted">
                                            @if ($subscription->expires_at->isPast())
                                                <span class="text-danger">
                                                    <i class="fas fa-exclamation-triangle"></i>
                                                    Đã hết hạn {{ $subscription->expires_at->diffForHumans() }}
                                                </span>
                                            @else
                                                <span class="text-success">
                                                    Còn {{ $subscription->expires_at->diffForHumans() }}
                                                </span>
                                            @endif
                                        </small>
                                    @else
                                        <span class="text-muted">Không giới hạn</span>
                                    @endif
                                </p>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="text-muted small">Thời hạn</label>
                                <p class="fw-bold">
                                    @if ($subscription->started_at && $subscription->expires_at)
                                        {{ $subscription->started_at->diffInDays($subscription->expires_at) }} ngày
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </p>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="text-muted small">Phương thức thanh toán</label>
                                <p class="fw-bold">{{ $subscription->payment_method ?? 'N/A' }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="text-muted small">Số tiền thanh toán</label>
                                <p class="fw-bold text-success fs-5">
                                    {{ number_format($subscription->amount_paid) }} VNĐ
                                </p>
                            </div>
                        </div>

                        @if ($subscription->notes)
                            <hr>
                            <div class="mb-3">
                                <label class="text-muted small">Ghi chú</label>
                                <p class="fw-bold">{{ $subscription->notes }}</p>
                            </div>
                        @endif

                        <hr>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="text-muted small">Ngày tạo</label>
                                <p>{{ $subscription->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="text-muted small">Cập nhật lần cuối</label>
                                <p>{{ $subscription->updated_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Transactions History -->
                @if ($subscription->transactions && $subscription->transactions->count() > 0)
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="fas fa-history"></i> Lịch sử giao dịch</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Ngày</th>
                                            <th>Loại</th>
                                            <th>Số tiền</th>
                                            <th>Trạng thái</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($subscription->transactions as $transaction)
                                            <tr>
                                                <td>#{{ $transaction->id }}</td>
                                                <td>{{ $transaction->created_at->format('d/m/Y H:i') }}</td>
                                                <td>{{ $transaction->type }}</td>
                                                <td>{{ number_format($transaction->amount) }} đ</td>
                                                <td>
                                                    <span
                                                        class="badge bg-{{ $transaction->status == 'completed' ? 'success' : 'warning' }}">
                                                        {{ $transaction->status }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar Actions -->
            <div class="col-md-4">
                <!-- Quick Actions -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-bolt"></i> Thao tác nhanh</h5>
                    </div>
                    <div class="card-body">
                        @if ($subscription->status == 'active')
                            <!-- Extend Subscription -->
                            <form action="{{ route('subscriptions.extend', $subscription) }}" method="POST"
                                class="mb-3">
                                @csrf
                                @method('PUT')
                                <label class="form-label small">Gia hạn thêm (ngày)</label>
                                <div class="input-group input-group-sm mb-2">
                                    <input type="number" name="additional_days" class="form-control" value="30"
                                        min="1" max="365" required>
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-plus"></i> Gia hạn
                                    </button>
                                </div>
                            </form>

                            <hr>

                            <!-- Cancel Subscription -->
                            <form action="{{ route('subscriptions.cancel', $subscription) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-warning btn-sm w-100 mb-2"
                                    onclick="return confirm('Hủy đăng ký này?')">
                                    <i class="fas fa-ban"></i> Hủy đăng ký
                                </button>
                            </form>
                        @endif

                        @if ($subscription->status == 'cancelled' || $subscription->status == 'expired')
                            <form action="{{ route('subscriptions.extend', $subscription) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="additional_days" value="30">
                                <button type="submit" class="btn btn-success btn-sm w-100 mb-2">
                                    <i class="fas fa-redo"></i> Kích hoạt lại (30 ngày)
                                </button>
                            </form>
                        @endif

                        <!-- Edit -->
                        <a href="{{ route('subscriptions.edit', $subscription) }}"
                            class="btn btn-primary btn-sm w-100 mb-2">
                            <i class="fas fa-edit"></i> Chỉnh sửa
                        </a>

                        <!-- Delete -->
                        <form action="{{ route('subscriptions.destroy', $subscription) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm w-100"
                                onclick="return confirm('Xóa đăng ký này?')">
                                <i class="fas fa-trash"></i> Xóa
                            </button>
                        </form>
                    </div>
                </div>

                <!-- User Info -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-user"></i> Thông tin người dùng</h5>
                    </div>
                    <div class="card-body">
                        <p class="mb-2">
                            <strong>Tên:</strong> {{ $subscription->user->name }}
                        </p>
                        <p class="mb-2">
                            <strong>Email:</strong><br>
                            <small>{{ $subscription->user->email }}</small>
                        </p>
                        <p class="mb-2">
                            <strong>Trạng thái Premium:</strong>
                            <span class="badge bg-{{ $subscription->user->is_premium ? 'success' : 'secondary' }}">
                                {{ $subscription->user->is_premium ? 'Premium' : 'Free' }}
                            </span>
                        </p>
                        <hr>
                        <a href="{{ route('user.show', $subscription->user) }}"
                            class="btn btn-sm btn-outline-primary w-100">
                            <i class="fas fa-eye"></i> Xem hồ sơ
                        </a>
                    </div>
                </div>

                <!-- Timeline -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-clock"></i> Dòng thời gian</h5>
                    </div>
                    <div class="card-body">
                        <ul class="timeline">
                            <li class="mb-3">
                                <i class="fas fa-plus-circle text-success"></i>
                                <strong>Tạo đăng ký</strong><br>
                                <small class="text-muted">{{ $subscription->created_at->format('d/m/Y H:i') }}</small>
                            </li>

                            @if ($subscription->started_at)
                                <li class="mb-3">
                                    <i class="fas fa-play-circle text-primary"></i>
                                    <strong>Bắt đầu</strong><br>
                                    <small class="text-muted">{{ $subscription->started_at->format('d/m/Y H:i') }}</small>
                                </li>
                            @endif

                            @if ($subscription->expires_at)
                                <li class="mb-3">
                                    <i
                                        class="fas fa-{{ $subscription->expires_at->isPast() ? 'stop' : 'hourglass-end' }}-circle
                                   text-{{ $subscription->expires_at->isPast() ? 'danger' : 'warning' }}"></i>
                                    <strong>{{ $subscription->expires_at->isPast() ? 'Đã hết hạn' : 'Sẽ hết hạn' }}</strong><br>
                                    <small class="text-muted">{{ $subscription->expires_at->format('d/m/Y H:i') }}</small>
                                </li>
                            @endif

                            @if ($subscription->updated_at != $subscription->created_at)
                                <li class="mb-3">
                                    <i class="fas fa-edit text-info"></i>
                                    <strong>Cập nhật lần cuối</strong><br>
                                    <small class="text-muted">{{ $subscription->updated_at->format('d/m/Y H:i') }}</small>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            .timeline {
                list-style: none;
                padding-left: 0;
                position: relative;
            }

            .timeline::before {
                content: '';
                position: absolute;
                left: 8px;
                top: 0;
                bottom: 0;
                width: 2px;
                background: #dee2e6;
            }

            .timeline li {
                position: relative;
                padding-left: 30px;
            }

            .timeline li i {
                position: absolute;
                left: 0;
                background: white;
                padding: 2px;
            }
        </style>
    @endpush
@endsection
