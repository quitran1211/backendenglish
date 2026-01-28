@extends('admin.layouts.app')

@section('title', 'Sửa gói đăng ký')

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">
                <i class="fas fa-edit"></i> Sửa gói đăng ký: {{ $subscriptionPlan->name }}
            </h1>
            <div>
                <a href="{{ route('subscription-plans.show', $subscriptionPlan) }}" class="btn btn-info">
                    <i class="fas fa-eye"></i> Xem chi tiết
                </a>
                <a href="{{ route('subscription-plans.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Quay lại
                </a>
            </div>
        </div>

        <!-- Warning if plan has active subscriptions -->
        @if ($subscriptionPlan->subscriptions()->where('status', 'active')->count() > 0)
            <div class="alert alert-warning mb-4">
                <i class="fas fa-exclamation-triangle"></i>
                <strong>Cảnh báo:</strong> Gói này hiện có
                <strong>{{ $subscriptionPlan->subscriptions()->where('status', 'active')->count() }}</strong>
                đăng ký đang hoạt động. Thay đổi giá hoặc thời hạn sẽ không ảnh hưởng đến các đăng ký hiện tại.
            </div>
        @endif

        <div class="row">
            <!-- Main Form -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('subscription-plans.update', $subscriptionPlan) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Plan Name -->
                            <div class="mb-3">
                                <label for="name" class="form-label">
                                    Tên gói <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="name" id="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name', $subscriptionPlan->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div class="mb-3">
                                <label for="description" class="form-label">Mô tả</label>
                                <textarea name="description" id="description" rows="4"
                                    class="form-control @error('description') is-invalid @enderror" placeholder="Mô tả chi tiết về gói đăng ký...">{{ old('description', $subscriptionPlan->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <!-- Duration -->
                                <div class="col-md-6 mb-3">
                                    <label for="duration_days" class="form-label">
                                        Thời hạn (ngày) <span class="text-danger">*</span>
                                    </label>
                                    <input type="number" name="duration_days" id="duration_days"
                                        class="form-control @error('duration_days') is-invalid @enderror"
                                        value="{{ old('duration_days', $subscriptionPlan->duration_days) }}" min="1"
                                        required>
                                    @error('duration_days')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted" id="durationHelper"></small>
                                </div>

                                <!-- Price -->
                                <div class="col-md-6 mb-3">
                                    <label for="price" class="form-label">
                                        Giá (VNĐ) <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <input type="number" name="price" id="price"
                                            class="form-control @error('price') is-invalid @enderror"
                                            value="{{ old('price', $subscriptionPlan->price) }}" min="0"
                                            step="1000" required>
                                        <span class="input-group-text">VNĐ</span>
                                    </div>
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted" id="priceHelper"></small>
                                </div>
                            </div>

                            <!-- Price Change Alert -->
                            <div class="alert alert-info mb-3" id="priceChangeAlert" style="display: none;">
                                <i class="fas fa-info-circle"></i>
                                <strong>Thay đổi giá:</strong>
                                <span id="priceChangeText"></span>
                            </div>

                            <div class="row">
                                <!-- Sort Order -->
                                <div class="col-md-6 mb-3">
                                    <label for="sort_order" class="form-label">Thứ tự hiển thị</label>
                                    <input type="number" name="sort_order" id="sort_order"
                                        class="form-control @error('sort_order') is-invalid @enderror"
                                        value="{{ old('sort_order', $subscriptionPlan->sort_order) }}" min="0">
                                    @error('sort_order')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Số nhỏ hơn sẽ hiển thị trước</small>
                                </div>

                                <!-- Is Active -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Trạng thái</label>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="is_active" id="is_active"
                                            value="1"
                                            {{ old('is_active', $subscriptionPlan->is_active) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">
                                            <span class="badge bg-success" id="statusBadge">
                                                {{ $subscriptionPlan->is_active ? 'Hoạt động' : 'Vô hiệu' }}
                                            </span>
                                        </label>
                                    </div>
                                    <small class="text-muted">Vô hiệu hóa sẽ ẩn gói khỏi danh sách hiển thị</small>
                                </div>
                            </div>

                            <!-- Preview Card -->
                            <div class="mb-3">
                                <label class="form-label">Xem trước</label>
                                <div class="card" id="previewCard">
                                    <div class="card-body text-center">
                                        <h4 class="card-title" id="previewName"></h4>
                                        <p class="text-muted small" id="previewDescription"></p>
                                        <hr>
                                        <h2 class="text-success mb-0">
                                            <span id="previewPrice"></span> đ
                                        </h2>
                                        <small class="text-muted">
                                            <span id="previewDuration"></span> ngày
                                            (<span id="previewMonths"></span> tháng)
                                        </small>
                                        <hr>
                                        <small class="text-muted">
                                            <span id="previewPricePerDay"></span> đ/ngày
                                        </small>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Buttons -->
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Cập nhật
                                </button>
                                <a href="{{ route('subscription-plans.show', $subscriptionPlan) }}" class="btn btn-info">
                                    <i class="fas fa-eye"></i> Xem chi tiết
                                </a>
                                <a href="{{ route('subscription-plans.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-times"></i> Hủy
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-md-4">
                <!-- Current Stats -->
                <div class="card mb-3">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0"><i class="fas fa-chart-bar"></i> Thống kê hiện tại</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="text-muted small">Tổng số đăng ký</label>
                            <h3 class="mb-0">{{ $subscriptionPlan->subscriptions()->count() }}</h3>
                        </div>
                        <div class="mb-3">
                            <label class="text-muted small">Đăng ký đang hoạt động</label>
                            <h3 class="mb-0 text-success">
                                {{ $subscriptionPlan->subscriptions()->where('status', 'active')->count() }}
                            </h3>
                        </div>
                        <div class="mb-3">
                            <label class="text-muted small">Tổng doanh thu</label>
                            <h3 class="mb-0 text-primary">
                                {{ number_format($subscriptionPlan->subscriptions()->sum('amount_paid')) }} đ
                            </h3>
                        </div>
                        <div class="mb-0">
                            <label class="text-muted small">Ngày tạo</label>
                            <p class="mb-0">{{ $subscriptionPlan->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Change History (if using audit/revision package) -->
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-history"></i> Lịch sử thay đổi</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-2">
                            <small class="text-muted">Tạo lúc:</small>
                            <p class="mb-0">{{ $subscriptionPlan->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                        <div class="mb-0">
                            <small class="text-muted">Cập nhật lần cuối:</small>
                            <p class="mb-0">{{ $subscriptionPlan->updated_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Tips -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-lightbulb"></i> Lưu ý</h5>
                    </div>
                    <div class="card-body">
                        <ul class="small mb-0">
                            <li>Thay đổi giá chỉ áp dụng cho đăng ký mới</li>
                            <li>Vô hiệu hóa gói sẽ ẩn nó khỏi trang đăng ký</li>
                            <li>Đăng ký hiện tại không bị ảnh hưởng</li>
                            <li>Không thể xóa gói có đăng ký đang hoạt động</li>
                            <li>Nên thông báo trước khi thay đổi giá lớn</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            const originalPrice = {{ $subscriptionPlan->price }};

            // Preview update
            function updatePreview() {
                const name = document.getElementById('name').value || 'Tên gói';
                const description = document.getElementById('description').value || 'Mô tả gói đăng ký';
                const duration = parseInt(document.getElementById('duration_days').value) || 0;
                const price = parseInt(document.getElementById('price').value) || 0;

                document.getElementById('previewName').textContent = name;
                document.getElementById('previewDescription').textContent = description;
                document.getElementById('previewDuration').textContent = duration;
                document.getElementById('previewPrice').textContent = price.toLocaleString('vi-VN');
                document.getElementById('previewMonths').textContent = (duration / 30).toFixed(1);

                const pricePerDay = duration > 0 ? Math.round(price / duration) : 0;
                document.getElementById('previewPricePerDay').textContent = pricePerDay.toLocaleString('vi-VN');

                // Update helpers
                document.getElementById('durationHelper').textContent = `~${(duration / 30).toFixed(1)} tháng`;
                document.getElementById('priceHelper').textContent = `${pricePerDay.toLocaleString('vi-VN')} đ/ngày`;

                // Price change alert
                if (price !== originalPrice) {
                    const change = price - originalPrice;
                    const percent = ((change / originalPrice) * 100).toFixed(1);
                    const changeText = change > 0 ?
                        `Tăng ${change.toLocaleString('vi-VN')}đ (+${percent}%)` :
                        `Giảm ${Math.abs(change).toLocaleString('vi-VN')}đ (${percent}%)`;

                    document.getElementById('priceChangeText').textContent = changeText;
                    document.getElementById('priceChangeAlert').style.display = 'block';
                } else {
                    document.getElementById('priceChangeAlert').style.display = 'none';
                }
            }

            // Status badge toggle
            document.getElementById('is_active').addEventListener('change', function() {
                const badge = document.getElementById('statusBadge');
                if (this.checked) {
                    badge.className = 'badge bg-success';
                    badge.textContent = 'Hoạt động';
                } else {
                    badge.className = 'badge bg-secondary';
                    badge.textContent = 'Vô hiệu';
                }
            });

            // Auto update preview
            ['name', 'description', 'duration_days', 'price'].forEach(id => {
                document.getElementById(id).addEventListener('input', updatePreview);
            });

            // Initial preview
            updatePreview();
        </script>
    @endpush
@endsection
