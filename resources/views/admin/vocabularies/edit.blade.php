@extends('admin.layouts.app')

@section('title', 'Chỉnh sửa Từ vựng')

@section('content')
    <div class="container-fluid p-4">

        <!-- ===== HEADER ===== -->
        <div class="d-flex align-items-center justify-content-between rounded border bg-white p-4 shadow-sm mb-4">
            <h2 class="h4 fw-semibold mb-0 text-dark">
                Chỉnh sửa Từ vựng
            </h2>

            <a href="{{ route('vocabularies.index') }}"
                class="d-inline-flex align-items-center gap-2 rounded
                  bg-secondary px-4 py-2 text-white text-decoration-none
                  shadow-sm transition">
                <i class="fa-solid fa-arrow-left"></i>
                <span>Quay lại</span>
            </a>
        </div>

        <!-- ===== FORM ===== -->
        <div class="rounded border bg-white p-4 shadow-sm">
            <form method="POST" action="{{ route('vocabularies.update', $vocabulary->id) }}">
                @csrf
                @method('PUT')

                <div class="row g-4">
                    <!-- Word -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            Từ vựng <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="word" class="form-control @error('word') is-invalid @enderror"
                            value="{{ old('word', $vocabulary->word) }}" required maxlength="255">
                        @error('word')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Pronunciation -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Phát âm</label>
                        <input type="text" name="pronunciation"
                            class="form-control @error('pronunciation') is-invalid @enderror"
                            value="{{ old('pronunciation', $vocabulary->pronunciation) }}" maxlength="255"
                            placeholder="VD: /həˈloʊ/">
                        @error('pronunciation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Word Type -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Loại từ</label>
                        <input type="text" name="word_type" class="form-control @error('word_type') is-invalid @enderror"
                            value="{{ old('word_type', $vocabulary->word_type) }}" maxlength="50"
                            placeholder="VD: noun, verb, adjective...">
                        @error('word_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Is Active Switch -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold d-block">Trạng thái</label>
                        <div class="form-check form-switch mt-2">
                            <input type="checkbox" name="is_active" value="1" class="form-check-input" id="is_active"
                                {{ old('is_active', $vocabulary->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label fw-semibold" for="is_active">
                                <i class="fa-solid fa-circle-check text-primary"></i> Kích hoạt
                            </label>
                        </div>
                    </div>

                    <!-- Meaning Vietnamese -->
                    <div class="col-md-12">
                        <label class="form-label fw-semibold">
                            Nghĩa tiếng Việt <span class="text-danger">*</span>
                        </label>
                        <textarea name="meaning_vi" rows="3" class="form-control @error('meaning_vi') is-invalid @enderror" required>{{ old('meaning_vi', $vocabulary->meaning_vi) }}</textarea>
                        @error('meaning_vi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Meaning English -->
                    <div class="col-md-12">
                        <label class="form-label fw-semibold">Nghĩa tiếng Anh</label>
                        <textarea name="meaning_en" rows="3" class="form-control @error('meaning_en') is-invalid @enderror">{{ old('meaning_en', $vocabulary->meaning_en) }}</textarea>
                        @error('meaning_en')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Buttons -->
                    <div class="col-md-12">
                        <div class="d-flex gap-2 justify-content-end">
                            <a href="{{ route('vocabularies.index') }}" class="btn btn-secondary px-4">
                                <i class="fa-solid fa-xmark"></i> Hủy
                            </a>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fa-solid fa-save"></i> Cập nhật
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
