@extends('admin.layouts.app')

@section('title', 'Thêm Bài học mới')

@section('content')
    <div class="container-fluid p-4">

        <!-- ===== HEADER ===== -->
        <div class="d-flex align-items-center justify-content-between rounded border bg-white p-4 shadow-sm mb-4">
            <h2 class="h4 fw-semibold mb-0 text-dark">
                Thêm Bài học mới
            </h2>

            <a href="{{ route('lesson.index') }}"
                class="d-inline-flex align-items-center gap-2 rounded
                  bg-secondary px-4 py-2 text-white text-decoration-none
                  shadow-sm transition">
                <i class="fa-solid fa-arrow-left"></i>
                <span>Quay lại</span>
            </a>
        </div>

        <!-- ===== FORM ===== -->
        <div class="rounded border bg-white p-4 shadow-sm">
            <form method="POST" action="{{ route('lesson.store') }}">
                @csrf

                <div class="row g-4">
                    <!-- Level -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            Mức độ <span class="text-danger">*</span>
                        </label>
                        <select name="level_id" class="form-select @error('level_id') is-invalid @enderror" required>
                            <option value="">-- Chọn mức độ --</option>
                            @foreach ($levels as $level)
                                <option value="{{ $level->id }}" {{ old('level_id') == $level->id ? 'selected' : '' }}>
                                    {{ $level->level_name }} ({{ $level->target_score }})
                                </option>
                            @endforeach
                        </select>
                        @error('level_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Display Order -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Thứ tự hiển thị</label>
                        <input type="number" name="display_order"
                            class="form-control @error('display_order') is-invalid @enderror"
                            value="{{ old('display_order', 0) }}" min="0">
                        @error('display_order')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Title -->
                    <div class="col-md-8">
                        <label class="form-label fw-semibold">
                            Tiêu đề bài học <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                            value="{{ old('title') }}" placeholder="VD: Business & Work" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Word Count -->
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Số từ vựng</label>
                        <input type="number" name="vocabularie_count"
                            class="form-control @error('vocabularie_count') is-invalid @enderror"
                            value="{{ old('vocabularie_count', 0) }}" min="0">
                        @error('vocabularie_count')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Topic -->
                    <div class="col-md-12">
                        <label class="form-label fw-semibold">Chủ đề</label>
                        <input type="text" name="topic" class="form-control @error('topic') is-invalid @enderror"
                            value="{{ old('topic') }}" placeholder="VD: Công việc và doanh nghiệp">
                        @error('topic')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="col-md-12">
                        <label class="form-label fw-semibold">Mô tả</label>
                        <textarea name="description" rows="4" class="form-control @error('description') is-invalid @enderror"
                            placeholder="Mô tả chi tiết về bài học...">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Checkboxes -->
                    <div class="col-md-12">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-check form-switch">
                                    <input type="checkbox" name="is_free" value="1" class="form-check-input"
                                        id="is_free" {{ old('is_free') ? 'checked' : '' }}>
                                    <label class="form-check-label fw-semibold" for="is_free">
                                        <i class="fa-solid fa-lock-open text-success"></i> Miễn phí
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check form-switch">
                                    <input type="checkbox" name="is_active" value="1" class="form-check-input"
                                        id="is_active" {{ old('is_active', true) ? 'checked' : '' }}>
                                    <label class="form-check-label fw-semibold" for="is_active">
                                        <i class="fa-solid fa-circle-check text-primary"></i> Kích hoạt
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="col-md-12">
                        <div class="d-flex gap-2 justify-content-end">
                            <a href="{{ route('lesson.index') }}" class="btn btn-secondary px-4">
                                <i class="fa-solid fa-xmark"></i> Hủy
                            </a>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fa-solid fa-check"></i> Thêm bài học
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
