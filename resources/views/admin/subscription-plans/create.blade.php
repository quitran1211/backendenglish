@extends('admin.layouts.app')

@section('title', 'Tạo gói đăng ký mới')

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">
                <i class="fas fa-plus-circle"></i> Tạo gói đăng ký mới
            </h1>
            <a href="{{ route('subscription-plans.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Quay lại
            </a>
        </div>

        <div class="row">
            <!-- Main Form -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('subscription-plans.store') }}" method="POST">
                            @csrf

                            <!-- Plan Name -->
                            <div class="mb-3">
                                <label for="name" class="form-label">
                                    Tên gói <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="name" id="name"
                                    class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                    placeholder="VD: Gói Premium 1 tháng" required autofocus>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Tên gói sẽ hiển thị cho người dùng</small>
                            </div>

                            <!-- Description -->
                            <div class="mb-3">
                                <label for="description" class="form-label">Mô tả</label>
                                <textarea name="description" id="description" rows="4"
                                    class="form-control @error('description') is-invalid @enderror" placeholder="Mô tả chi tiết về gói đăng ký...">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Mô tả các tính năng và lợi ích của gói</small>
                            </div>

                            <div class="row">
                                <!-- Duration -->
                                <div class="col-md-6 mb-3">
                                    <label for="duration_days" class="form-label">
                                        Thời hạn (ngày) <span class="text-danger">*</span>
                                    </label>
                                    <input type="number" name="duration_days" id="duration_days"
                                        class="form-control @error('duration_days') is-invalid @enderror"
                                        value="{{ old('duration_days', 30) }}" min="1" required>
                                    @error('duration_days')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted" id="durationHelper">
                                        ~1.0 tháng
                                    </small>
                                </div>

                                <!-- Price -->
                                <div class="col-md-6 mb-3">
                                    <label for="price" class="form-label">
                                        Giá (VNĐ) <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <input type="number" name="price" id="price"
                                            class="form-control @error('price') is-invalid @enderror"
                                            value="{{ old('price', 0) }}" min="0" step="1000" required>
                                        <span class="input-group-text">VNĐ</span>
                                        @error('price')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <small class="text-muted" id="priceHelper">
                                        0 đ/ngày
                                    </small>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Sort Order -->
                                <div class="col-md-6 mb-3">
                                    <label for="sort_order" class="form-label">Thứ tự hiển thị</label>
                                    <input type="number" name="sort_order" id="sort_order"
                                        class="form-control @error('sort_order') is-invalid @enderror"
                                        value="{{ old('sort_order', 0) }}" min="0">
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
                                            value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">
                                            <span class="badge bg-success" id="statusBadge">Hoạt động</span>
                                        </label>
                                    </div>
                                    <small class="text-muted">Chỉ gói hoạt động mới hiển thị cho người dùng</small>
                                </div>
                            </div>

                            <!-- Preview Card -->
                            <div class="mb-3">
                                <label class="form-label">Xem trước</label>
                                <div class="card" id="previewCard">
                                    <div class="card-body text-center">
                                        <h4 class="card-title" id="previewName">Tên gói</h4>
                                        <p class="text-muted small" id="previewDescription">Mô tả gói đăng ký</p>
                                        <hr>
                                        <h2 class="text-success mb-0">
                                            <span id="previewPrice">0</span> đ
                                        </h2>
                                        <small class="text-muted">
                                            <span id="previewDuration">0</span> ngày
                                            (<span id="previewMonths">0</span> tháng)
                                        </small>
                                        <hr>
                                        <small class="text-muted">
                                            <span id="previewPricePerDay">0</span> đ/ngày
                                        </small>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Buttons -->
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Tạo gói đăng ký
                                </button>
                                <button type="submit" name="create_another" value="1" class="btn btn-success">
                                    <i class="fas fa-plus"></i> Lưu và tạo tiếp
                                </button>
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
                <!-- Quick Templates -->
                <div class="card mb-3">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-magic"></i> Mẫu nhanh</h5>
                    </div>
                    <div class="card-body">
                        <p class="small text-muted">Chọn mẫu để điền nhanh:</p>
                        <div class="d-grid gap-2">
                            <button type="button" class="btn btn-outline-primary btn-sm"
                                onclick="fillTemplate('monthly')">
                                <i class="fas fa-calendar"></i> Gói 1 tháng
                            </button>
                            <button type="button" class="btn btn-outline-primary btn-sm"
                                onclick="fillTemplate('quarterly')">
                                <i class="fas fa-calendar-alt"></i> Gói 3 tháng
                            </button>
                            <button type="button" class="btn btn-outline-primary btn-sm"
                                onclick="fillTemplate('yearly')">
                                <i class="fas fa-calendar-check"></i> Gói 1 năm
                            </button>
                            <button type="button" class="btn btn-outline-success btn-sm"
                                onclick="fillTemplate('trial')">
                                <i class="fas fa-gift"></i> Gói dùng thử
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Tips -->
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-lightbulb"></i> Gợi ý</h5>
                    </div>
                    <div class="card-body">
                        <ul class="small mb-0">
                            <li>Đặt tên gói ngắn gọn, dễ hiểu</li>
                            <li>Mô tả rõ ràng các tính năng</li>
                            <li>Giá nên chia hết cho 1000đ</li>
                            <li>Gói dài hạn nên có giá ưu đãi hơn</li>
                            <li>Thứ tự hiển thị: gói phổ biến = 0</li>
                        </ul>
                    </div>
                </div>

                <!-- Pricing Strategy -->
                <div class="card">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0"><i class="fas fa-chart-line"></i> Chiến lược giá</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-2">
                            <strong>Gói 1 tháng:</strong>
                            <p class="small text-muted mb-1">Giá chuẩn, không giảm giá</p>
                        </div>
                        <div class="mb-2">
                            <strong>Gói 3 tháng:</strong>
                            <p class="small text-muted mb-1">Giảm 10-15% so với tháng</p>
                        </div>
                        <div class="mb-2">
                            <strong>Gói 6 tháng:</strong>
                            <p class="small text-muted mb-1">Giảm 20-25% so với tháng</p>
                        </div>
                        <div class="mb-0">
                            <strong>Gói 1 năm:</strong>
                            <p class="small text-muted mb-0">Giảm 30-40% so với tháng</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
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

            // Template filling
            function fillTemplate(type) {
                const templates = {
                    monthly: {
                        name: 'Gói Premium 1 tháng',
                        description: 'Gói đăng ký Premium 1 tháng với đầy đủ tính năng cao cấp',
                        duration_days: 30,
                        price: 99000,
                        sort_order: 1
                    },
                    quarterly: {
                        name: 'Gói Premium 3 tháng',
                        description: 'Gói đăng ký Premium 3 tháng - Tiết kiệm 15% so với gói tháng',
                        duration_days: 90,
                        price: 249000,
                        sort_order: 2
                    },
                    yearly: {
                        name: 'Gói Premium 1 năm',
                        description: 'Gói đăng ký Premium 1 năm - Tiết kiệm 40% so với gói tháng',
                        duration_days: 365,
                        price: 699000,
                        sort_order: 3
                    },
                    trial: {
                        name: 'Gói dùng thử',
                        description: 'Trải nghiệm miễn phí các tính năng Premium trong 7 ngày',
                        duration_days: 7,
                        price: 0,
                        sort_order: 0
                    }
                };

                const template = templates[type];
                if (template) {
                    document.getElementById('name').value = template.name;
                    document.getElementById('description').value = template.description;
                    document.getElementById('duration_days').value = template.duration_days;
                    document.getElementById('price').value = template.price;
                    document.getElementById('sort_order').value = template.sort_order;
                    updatePreview();
                }
            }

            // Auto update preview
            ['name', 'description', 'duration_days', 'price'].forEach(id => {
                document.getElementById(id).addEventListener('input', updatePreview);
            });

            // Initial preview
            updatePreview();
        </script>
    @endpush
@endsection
