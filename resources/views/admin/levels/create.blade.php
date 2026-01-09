@extends('admin.layouts.app')

@section('title', 'Thêm Cấp độ mới')

@section('content')
    <div class="container-fluid p-4">

        <!-- ===== HEADER ===== -->
        <div class="d-flex align-items-center justify-content-between rounded border bg-white p-4 shadow-sm mb-4">
            <h2 class="h4 fw-semibold mb-0 text-dark">
                <i class="fa-solid fa-plus-circle text-primary"></i> Thêm Cấp độ mới
            </h2>

            <a href="{{ route('levels.index') }}" class="btn btn-secondary">
                <i class="fa-solid fa-arrow-left"></i> Quay lại
            </a>
        </div>

        <!-- ===== FORM ===== -->
        <div class="rounded border bg-white p-4 shadow-sm">
            <form method="POST" action="{{ route('levels.store') }}">
                @csrf

                <div class="row g-4">
                    <!-- Level Code -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            Mã cấp độ <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="level_code"
                            class="form-control @error('level_code') is-invalid @enderror" value="{{ old('level_code') }}"
                            placeholder="VD: A1, B2, C1..." required maxlength="50">
                        <small class="text-muted">Mã định danh duy nhất cho cấp độ</small>
                        @error('level_code')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Level Name -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            Tên cấp độ <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="level_name"
                            class="form-control @error('level_name') is-invalid @enderror" value="{{ old('level_name') }}"
                            placeholder="VD: Beginner, Intermediate..." required maxlength="255">
                        @error('level_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Target Score -->
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">
                            Điểm mục tiêu <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="target_score"
                            class="form-control @error('target_score') is-invalid @enderror"
                            value="{{ old('target_score') }}" placeholder="VD: 400, 550..." rrequired maxlength="255">
                        <small class="text-muted">Điểm TOEIC từ 0-990</small>
                        @error('target_score')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Total Words -->
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Tổng số từ vựng</label>
                        <input type="number" name="total_words"
                            class="form-control @error('total_words') is-invalid @enderror"
                            value="{{ old('total_words', 0) }}" min="0">
                        @error('total_words')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Display Order -->
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Thứ tự hiển thị</label>
                        <input type="number" name="display_order"
                            class="form-control @error('display_order') is-invalid @enderror"
                            value="{{ old('display_order', 0) }}" min="0">
                        <small class="text-muted">Số thứ tự hiển thị (càng nhỏ càng ưu tiên)</small>
                        @error('display_order')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Color -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Màu sắc</label>
                        <div class="input-group">
                            <input type="color" name="color"
                                class="form-control form-control-color @error('color') is-invalid @enderror"
                                value="{{ old('color', '#007bff') }}" title="Chọn màu sắc">
                            <input type="text" class="form-control" value="{{ old('color', '#007bff') }}"
                                id="colorValue" readonly>
                        </div>
                        <small class="text-muted">Màu đại diện cho cấp độ</small>
                        @error('color')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Is Active -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold d-block">Trạng thái</label>
                        <div class="form-check form-switch mt-2">
                            <input type="checkbox" name="is_active" value="1" class="form-check-input" id="is_active"
                                {{ old('is_active', true) ? 'checked' : '' }}>
                            <label class="form-check-label fw-semibold" for="is_active">
                                <i class="fa-solid fa-circle-check text-success"></i> Kích hoạt
                            </label>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="col-md-12">
                        <label class="form-label fw-semibold">Mô tả</label>
                        <textarea name="description" rows="4" class="form-control @error('description') is-invalid @enderror"
                            placeholder="Nhập mô tả chi tiết về cấp độ này...">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Buttons -->
                    <div class="col-md-12">
                        <div class="d-flex gap-2 justify-content-end border-top pt-3">
                            <a href="{{ route('levels.index') }}" class="btn btn-secondary px-4">
                                <i class="fa-solid fa-xmark"></i> Hủy
                            </a>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fa-solid fa-save"></i> Lưu lại
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            // Sync color picker with text input
            document.querySelector('input[name="color"]').addEventListener('input', function() {
                document.getElementById('colorValue').value = this.value;
            });
        </script>
    @endpush
@endsection
