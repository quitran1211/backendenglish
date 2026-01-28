@extends('admin.layouts.app')

@section('title', 'Sửa đăng ký #' . $subscription->id)

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">Sửa đăng ký #{{ $subscription->id }}</h1>
            <div>
                <a href="{{ route('subscriptions.show', $subscription) }}" class="btn btn-info">
                    <i class="fas fa-eye"></i> Xem chi tiết
                </a>
                <a href="{{ route('subscriptions.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Quay lại
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('subscriptions.update', $subscription) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- User Info (Read-only) -->
                            <div class="mb-3">
                                <label class="form-label">Người dùng</label>
                                <input type="text" class="form-control"
                                    value="{{ $subscription->user->name }} ({{ $subscription->user->email }})" readonly
                                    disabled>
                                <small class="text-muted">Không thể thay đổi người dùng</small>
                            </div>

                            <!-- Plan Info (Read-only) -->
                            <div class="mb-3">
                                <label class="form-label">Gói dịch vụ</label>
                                <input type="text" class="form-control" value="{{ $subscription->plan->name ?? 'N/A' }}"
                                    readonly disabled>
                                <small class="text-muted">Không thể thay đổi gói dịch vụ</small>
                            </div>

                            <hr>

                            <!-- Status -->
                            <div class="mb-3">
                                <label for="status" class="form-label">
                                    Trạng thái <span class="text-danger">*</span>
                                </label>
                                <select name="status" id="status"
                                    class="form-select @error('status') is-invalid @enderror" required>
                                    <option value="active"
                                        {{ old('status', $subscription->status) == 'active' ? 'selected' : '' }}>
                                        Đang hoạt động
                                    </option>
                                    <option value="expired"
                                        {{ old('status', $subscription->status) == 'expired' ? 'selected' : '' }}>
                                        Đã hết hạn
                                    </option>
                                    <option value="cancelled"
                                        {{ old('status', $subscription->status) == 'cancelled' ? 'selected' : '' }}>
                                        Đã hủy
                                    </option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">
                                    Thay đổi trạng thái sẽ ảnh hưởng đến quyền Premium của người dùng
                                </small>
                            </div>

                            <!-- Expires At -->
                            <div class="mb-3">
                                <label for="expires_at" class="form-label">Ngày hết hạn</label>
                                <input type="datetime-local" name="expires_at" id="expires_at"
                                    class="form-control @error('expires_at') is-invalid @enderror"
                                    value="{{ old('expires_at', $subscription->expires_at?->format('Y-m-d\TH:i')) }}">
                                @error('expires_at')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">
                                    Để trống nếu không giới hạn thời gian.
                                    Hiện tại:
                                    @if ($subscription->expires_at)
                                        {{ $subscription->expires_at->format('d/m/Y H:i') }}
                                        @if ($subscription->expires_at->isPast())
                                            <span class="text-danger">(Đã hết hạn)</span>
                                        @else
                                            <span class="text-success">(Còn
                                                {{ $subscription->expires_at->diffForHumans() }})</span>
                                        @endif
                                    @else
                                        Không giới hạn
                                    @endif
                                </small>
                            </div>

                            <!-- Quick Extend Options -->
                            <div class="mb-3">
                                <label class="form-label">Gia hạn nhanh</label>
                                <div class="btn-group w-100" role="group">
                                    <button type="button" class="btn btn-outline-primary" onclick="extendDays(7)">
                                        +7 ngày
                                    </button>
                                    <button type="button" class="btn btn-outline-primary" onclick="extendDays(30)">
                                        +30 ngày
                                    </button>
                                    <button type="button" class="btn btn-outline-primary" onclick="extendDays(90)">
                                        +90 ngày
                                    </button>
                                    <button type="button" class="btn btn-outline-primary" onclick="extendDays(365)">
                                        +1 năm
                                    </button>
                                </div>
                            </div>

                            <!-- Notes -->
                            <div class="mb-3">
                                <label for="notes" class="form-label">Ghi chú</label>
                                <textarea name="notes" id="notes" rows="4" class="form-control @error('notes') is-invalid @enderror"
                                    placeholder="Ghi chú thêm về đăng ký này...">{{ old('notes', $subscription->notes) }}</textarea>
                                @error('notes')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Submit Buttons -->
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Cập nhật
                                </button>
                                <a href="{{ route('subscriptions.show', $subscription) }}" class="btn btn-secondary">
                                    <i class="fas fa-times"></i> Hủy
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Sidebar Info -->
            <div class="col-md-4">
                <!-- Current Info -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-info-circle"></i> Thông tin hiện tại</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="text-muted small">ID Đăng ký</label>
                            <p class="fw-bold">#{{ $subscription->id }}</p>
                        </div>

                        <div class="mb-3">
                            <label class="text-muted small">Người dùng</label>
                            <p class="fw-bold">
                                {{ $subscription->user->name }}<br>
                                <small class="text-muted">{{ $subscription->user->email }}</small>
                            </p>
                        </div>

                        <div class="mb-3">
                            <label class="text-muted small">Gói dịch vụ</label>
                            <p>
                                @if ($subscription->plan)
                                    <span class="badge bg-primary">{{ $subscription->plan->name }}</span><br>
                                    <small class="text-muted">
                                        {{ number_format($subscription->plan->price) }}đ -
                                        {{ $subscription->plan->duration_days }} ngày
                                    </small>
                                @else
                                    <span class="text-muted">N/A</span>
                                @endif
                            </p>
                        </div>

                        <div class="mb-3">
                            <label class="text-muted small">Ngày bắt đầu</label>
                            <p>{{ $subscription->started_at?->format('d/m/Y H:i') }}</p>
                        </div>

                        <div class="mb-3">
                            <label class="text-muted small">Số tiền đã thanh toán</label>
                            <p class="fw-bold text-success">
                                {{ number_format($subscription->amount_paid) }} VNĐ
                            </p>
                        </div>

                        <div class="mb-3">
                            <label class="text-muted small">Phương thức thanh toán</label>
                            <p>{{ $subscription->payment_method ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Tips -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-lightbulb"></i> Mẹo</h5>
                    </div>
                    <div class="card-body">
                        <ul class="small mb-0">
                            <li>Thay đổi trạng thái thành "Đang hoạt động" để kích hoạt Premium</li>
                            <li>Đặt trạng thái "Đã hủy" để tạm ngừng dịch vụ</li>
                            <li>Sử dụng các nút gia hạn nhanh để tự động tính ngày hết hạn</li>
                            <li>Trạng thái Premium của người dùng sẽ tự động cập nhật</li>
                            <li>Không nên thay đổi người dùng hoặc gói dịch vụ, thay vào đó hãy tạo đăng ký mới</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function extendDays(days) {
                const expiresInput = document.getElementById('expires_at');
                let currentDate;

                // Get current expires_at or use now
                if (expiresInput.value) {
                    currentDate = new Date(expiresInput.value);
                } else {
                    currentDate = new Date();
                }

                // Add days
                currentDate.setDate(currentDate.getDate() + days);

                // Format to datetime-local format
                const year = currentDate.getFullYear();
                const month = String(currentDate.getMonth() + 1).padStart(2, '0');
                const day = String(currentDate.getDate()).padStart(2, '0');
                const hours = String(currentDate.getHours()).padStart(2, '0');
                const minutes = String(currentDate.getMinutes()).padStart(2, '0');

                expiresInput.value = `${year}-${month}-${day}T${hours}:${minutes}`;

                // Visual feedback
                expiresInput.classList.add('border-success');
                setTimeout(() => {
                    expiresInput.classList.remove('border-success');
                }, 1000);
            }

            // Auto-adjust status when changing expires_at
            document.getElementById('expires_at').addEventListener('change', function() {
                const expiresDate = new Date(this.value);
                const now = new Date();
                const statusSelect = document.getElementById('status');

                if (expiresDate > now && statusSelect.value === 'expired') {
                    if (confirm('Ngày hết hạn trong tương lai. Thay đổi trạng thái thành "Đang hoạt động"?')) {
                        statusSelect.value = 'active';
                    }
                } else if (expiresDate < now && statusSelect.value === 'active') {
                    if (confirm('Ngày hết hạn trong quá khứ. Thay đổi trạng thái thành "Đã hết hạn"?')) {
                        statusSelect.value = 'expired';
                    }
                }
            });
        </script>
    @endpush
@endsection
