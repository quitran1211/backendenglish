@extends('admin.layouts.app')

@section('title', 'Thêm từ vựng')

@section('content')
    <div class="container-fluid p-4">

        {{-- ===== HEADER ===== --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="h4 fw-semibold mb-1">Thêm từ vựng mới</h2>
                <div class="text-muted">Nhập thông tin từ vựng vào hệ thống</div>
            </div>

            <a href="{{ route('vocabularies.index') }}" class="btn btn-outline-secondary">
                <i class="fa-solid fa-arrow-left"></i> Quay lại
            </a>
        </div>

        {{-- ===== ERROR ===== --}}
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
                <strong>Đã xảy ra lỗi!</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- ===== FORM ===== --}}
        <form action="{{ route('vocabularies.store') }}" method="POST">
            @csrf

            <div class="row g-4">

                {{-- TỪ VỰNG --}}
                <div class="col-md-6">
                    <label class="form-label fw-semibold">
                        Từ vựng <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="word" class="form-control" value="{{ old('word') }}"
                        placeholder="Ví dụ: develop" required>
                </div>

                {{-- PHIÊN ÂM --}}
                <div class="col-md-6">
                    <label class="form-label fw-semibold">
                        Phiên âm
                    </label>
                    <input type="text" name="pronunciation" class="form-control" value="{{ old('pronunciation') }}"
                        placeholder="/dɪˈveləp/">
                </div>

                {{-- LOẠI TỪ --}}
                <div class="col-md-4">
                    <label class="form-label fw-semibold">
                        Loại từ
                    </label>
                    <select name="word_type" class="form-select">
                        <option value="">-- Chọn loại từ --</option>
                        @foreach (['noun', 'verb', 'adjective', 'adverb', 'pronoun', 'preposition', 'conjunction', 'interjection'] as $type)
                            <option value="{{ $type }}" @selected(old('word_type') === $type)>
                                {{ ucfirst($type) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- TRẠNG THÁI --}}
                <div class="col-md-4">
                    <label class="form-label fw-semibold">
                        Trạng thái
                    </label>
                    <select name="is_active" class="form-select">
                        <option value="1" @selected(old('is_active', 1) == 1)>Hoạt động</option>
                        <option value="0" @selected(old('is_active') == 0)>Ẩn</option>
                    </select>
                </div>

                {{-- ===== NGHĨA TIẾNG VIỆT ===== --}}
                <div class="col-md-12">
                    <label class="form-label fw-semibold">
                        Nghĩa tiếng Việt <span class="text-danger">*</span>
                    </label>
                    <textarea name="meaning_vi" rows="3" class="form-control" placeholder="Nhập nghĩa tiếng Việt" required>{{ old('meaning_vi') }}</textarea>
                </div>

                {{-- ===== NGHĨA TIẾNG ANH ===== --}}
                <div class="col-md-12">
                    <label class="form-label fw-semibold">
                        Nghĩa tiếng Anh
                    </label>
                    <textarea name="meaning_en" rows="3" class="form-control" placeholder="English definition">{{ old('meaning_en') }}</textarea>
                </div>

            </div>

            {{-- ===== ACTION ===== --}}
            <div class="mt-4 d-flex gap-2">
                <button class="btn btn-primary">
                    <i class="fa-solid fa-save"></i> Lưu từ vựng
                </button>

                <a href="{{ route('vocabularies.index') }}" class="btn btn-outline-secondary">
                    Huỷ
                </a>
            </div>
        </form>
    </div>
@endsection
