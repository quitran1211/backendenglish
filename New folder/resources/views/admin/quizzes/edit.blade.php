@extends('admin.layouts.app')

@section('title', 'Chỉnh sửa Câu hỏi')

@section('content')
    <div class="container-fluid p-4">

        <!-- HEADER -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h4 fw-semibold">Chỉnh sửa Câu hỏi</h2>
            <a href="{{ route('quizzes.index') }}" class="btn btn-secondary">
                <i class="fa-solid fa-arrow-left"></i> Quay lại
            </a>
        </div>

        <!-- FORM -->
        <div class="card shadow-sm">
            <div class="card-body">
                <form method="POST" action="{{ route('quizzes.update', $quiz->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">

                        <!-- Lesson -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Bài học *</label>
                            <select name="lesson_id" class="form-select @error('lesson_id') is-invalid @enderror" required>
                                <option value="">-- Chọn bài học --</option>
                                @foreach ($lessons as $lesson)
                                    <option value="{{ $lesson->id }}"
                                        {{ old('lesson_id', $quiz->lesson_id) == $lesson->id ? 'selected' : '' }}>
                                        {{ $lesson->title }}
                                    </option>
                                @endforeach
                            </select>
                            @error('lesson_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Level -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Mức độ *</label>
                            <select name="level_id" class="form-select @error('level_id') is-invalid @enderror" required>
                                <option value="">-- Chọn mức độ --</option>
                                @foreach ($levels as $level)
                                    <option value="{{ $level->id }}"
                                        {{ old('level_id', $quiz->level_id) == $level->id ? 'selected' : '' }}>
                                        {{ $level->level_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('level_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Title -->
                        <div class="col-md-8">
                            <label class="form-label fw-semibold">Tiêu đề *</label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                                value="{{ old('title', $quiz->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="col-md-12">
                            <label class="form-label">Mô tả</label>
                            <textarea name="description" rows="3" class="form-control">
{{ old('description', $quiz->description) }}</textarea>
                        </div>

                        <!-- Quiz Type -->
                        <div class="col-md-4">
                            <label class="form-label">Loại Quiz</label>
                            <select name="quiz_type" class="form-select" required>
                                @foreach (['vocabulary', 'multiple_choice', 'listening'] as $type)
                                    <option value="{{ $type }}"
                                        {{ old('quiz_type', $quiz->quiz_type) == $type ? 'selected' : '' }}>
                                        {{ ucfirst(str_replace('_', ' ', $type)) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Time Limit -->
                        <div class="col-md-4">
                            <label class="form-label">Thời gian (phút)</label>
                            <input type="number" name="time_limit" class="form-control"
                                value="{{ old('time_limit', $quiz->time_limit) }}" min="0">
                        </div>

                        <!-- Passing Score -->
                        <div class="col-md-4">
                            <label class="form-label">Điểm đạt (%)</label>
                            <input type="number" name="passing_score" class="form-control"
                                value="{{ old('passing_score', $quiz->passing_score) }}" min="0" max="100"
                                required>
                        </div>

                        <!-- Switches -->
                        <div class="col-md-6">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_free" value="1"
                                    {{ old('is_free', $quiz->is_free) ? 'checked' : '' }}>
                                <label class="form-check-label">Miễn phí</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_active" value="1"
                                    {{ old('is_active', $quiz->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label">Kích hoạt</label>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="col-12 text-end">
                            <a href="{{ route('quizzes.index') }}" class="btn btn-secondary">Hủy</a>
                            <button class="btn btn-primary">
                                <i class="fa-solid fa-save"></i> Cập nhật
                            </button>
                        </div>

                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
