@extends('admin.layouts.app')

@section('title', 'Tạo đăng ký mới')

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">Tạo đăng ký mới</h1>
            <a href="{{ route('subscriptions.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Quay lại
            </a>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('subscriptions.store') }}" method="POST">
                            @csrf

                            <!-- User Selection -->
                            <div class="mb-3">
                                <label for="user_id" class="form-label">
                                    Người dùng <span class="text-danger">*</span>
                                </label>
                                <select name="user_id" id="user_id"
                                    class="form-select @error('user_id') is-invalid @enderror" required>
                                    <option value="">-- Chọn người dùng --</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}"
                                            {{ old('user_id', $selectedUserId) == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }} ({{ $user->email }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">
                                    Chọn người dùng sẽ nhận đăng ký này
                                </small>
                            </div>

                            <!-- Plan Selection -->
                            <div class="mb-3">
                                <label for="plan_id" class="form-label">
                                    Gói dịch vụ <span class="text-danger">*</span>
                                </label>
                                <select name="plan_id" id="plan_id"
                                    class="form-select @error('plan_id') is-invalid @enderror" required>
                                    <option value="">-- Chọn gói dịch vụ --</option>
                                    @foreach ($plans as $plan)
                                        <option value="{{ $plan->id }}" data-duration="{{ $plan->duration_days }}"
                                            data-price="{{ $plan->price }}"
                                            {{ old('plan_id') == $plan->id ? 'selected' : '' }}>
                                            {{ $plan->name }} - {{ number_format($plan->price) }}đ
                                            ({{ $plan->duration_days }} ngày)
                                        </option>
                                    @endforeach
                                </select>
                                @error('plan_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Duration Preview -->
                            <div id="durationPreview" class="alert alert-info mb-3" style="display: none;">
                                <i class="fas fa-info-circle"></i>
                                <strong>Thời hạn:</strong> <span id="durationText"></span>
                            </div>

                            <!-- Payment Method -->
                            <div class="mb-3">
                                <label for="payment_method" class="form-label">Phương thức thanh toán</label>
                                <select name="payment_method" id="payment_method"
                                    class="form-select @error('payment_method') is-invalid @enderror">
                                    <option value="admin_grant"
                                        {{ old('payment_method') == 'admin_grant' ? 'selected' : '' }}>Admin cấp</option>
                                    <option value="bank_transfer"
                                        {{ old('payment_method') == 'bank_transfer' ? 'selected' : '' }}>Chuyển khoản
                                    </option>
                                    <option value="momo" {{ old('payment_method') == 'momo' ? 'selected' : '' }}>MoMo
                                    </option>
                                    <option value="vnpay" {{ old('payment_method') == 'vnpay' ? 'selected' : '' }}>VNPay
                                    </option>
                                    <option value="cash" {{ old('payment_method') == 'cash' ? 'selected' : '' }}>Tiền mặt
                                    </option>
                                    <option value="other" {{ old('payment_method') == 'other' ? 'selected' : '' }}>Khác
                                    </option>
                                </select>
                                @error('payment_method')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Amount Paid -->
                            <div class="mb-3">
                                <label for="amount_paid" class="form-label">Số tiền thanh toán</label>
                                <div class="input-group">
                                    <input type="number" name="amount_paid" id="amount_paid"
                                        class="form-control @error('amount_paid') is-invalid @enderror"
                                        value="{{ old('amount_paid', 0) }}" min="0" step="1000">
                                    <span class="input-group-text">VNĐ</span>
                                    @error('amount_paid')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <small class="text-muted">
                                    Để trống hoặc 0 nếu là tài khoản miễn phí
                                </small>
                            </div>

                            <!-- Notes -->
                            <div class="mb-3">
                                <label for="notes" class="form-label">Ghi chú</label>
                                <textarea name="notes" id="notes" rows="4" class="form-control @error('notes') is-invalid @enderror"
                                    placeholder="Ghi chú thêm về đăng ký này...">{{ old('notes') }}</textarea>
                                @error('notes')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Submit Buttons -->
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Tạo đăng ký
                                </button>
                                <a href="{{ route('subscriptions.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-times"></i> Hủy
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Sidebar Info -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-info-circle"></i> Thông tin</h5>
                    </div>
                    <div class="card-body">
                        <h6>Lưu ý khi tạo đăng ký:</h6>
                        <ul class="small">
                            <li>Chọn người dùng và gói dịch vụ phù hợp</li>
                            <li>Ngày bắt đầu sẽ là ngày hiện tại</li>
                            <li>Ngày hết hạn tự động tính dựa trên thời hạn gói</li>
                            <li>Trạng thái mặc định là "Đang hoạt động"</li>
                            <li>Trạng thái Premium của người dùng sẽ được cập nhật tự động</li>
                        </ul>

                        <hr>

                        <h6>Phương thức thanh toán:</h6>
                        <ul class="small">
                            <li><strong>Admin cấp:</strong> Tài khoản được cấp miễn phí</li>
                            <li><strong>Chuyển khoản:</strong> Thanh toán qua ngân hàng</li>
                            <li><strong>MoMo/VNPay:</strong> Ví điện tử</li>
                            <li><strong>Tiền mặt:</strong> Thanh toán trực tiếp</li>
                        </ul>
                    </div>
                </div>

                <!-- Available Plans -->
                <div class="card mt-3">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-tags"></i> Gói dịch vụ</h5>
                    </div>
                    <div class="card-body">
                        @foreach ($plans as $plan)
                            <div class="border-bottom pb-2 mb-2">
                                <strong>{{ $plan->name }}</strong><br>
                                <small class="text-muted">
                                    {{ number_format($plan->price) }}đ - {{ $plan->duration_days }} ngày
                                </small>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Auto-fill amount when plan is selected
            document.getElementById('plan_id').addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                const price = selectedOption.getAttribute('data-price');
                const duration = selectedOption.getAttribute('data-duration');

                if (price) {
                    document.getElementById('amount_paid').value = price;
                }

                if (duration) {
                    const endDate = new Date();
                    endDate.setDate(endDate.getDate() + parseInt(duration));

                    const durationText = `${duration} ngày (đến ${endDate.toLocaleDateString('vi-VN')})`;
                    document.getElementById('durationText').textContent = durationText;
                    document.getElementById('durationPreview').style.display = 'block';
                } else {
                    document.getElementById('durationPreview').style.display = 'none';
                }
            });

            // Enhanced user select with search
            if (typeof $ !== 'undefined' && $.fn.select2) {
                $('#user_id').select2({
                    placeholder: '-- Chọn người dùng --',
                    allowClear: true,
                    width: '100%'
                });

                $('#plan_id').select2({
                    placeholder: '-- Chọn gói dịch vụ --',
                    allowClear: true,
                    width: '100%'
                });
            }
        </script>
    @endpush
@endsection
