@extends('admin.layouts.app')

@section('title', 'Thêm câu hỏi')

@section('content')
    <div class="container-fluid p-4">

        <!-- HEADER -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-semibold mb-1">Thêm câu hỏi</h4>
                <div class="text-muted small">
                    Quiz: <strong>{{ $quiz->title }}</strong>
                </div>
            </div>

            <a href="{{ route('quizzes.questions.index', $quiz->id) }}" class="btn btn-secondary btn-sm">
                Quay lại
            </a>
        </div>

        <!-- ERROR -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- FORM -->
        <form method="POST" action="{{ route('quizzes.questions.store', $quiz->id) }}" class="card p-4">

            @csrf

            <!-- QUESTION TEXT -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Nội dung câu hỏi</label>
                <textarea name="question_text" class="form-control" rows="3" required>{{ old('question_text') }}</textarea>
            </div>

            <!-- VOCABULARY -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Từ vựng liên kết (vocabulary_id)</label>
                <select name="vocabulary_id" class="form-select">
                    <option value="">-- Không liên kết --</option>
                    @foreach ($vocabularies as $vocab)
                        <option value="{{ $vocab->id }}" {{ old('vocabulary_id') == $vocab->id ? 'selected' : '' }}>
                            {{ $vocab->word }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- QUESTION TYPE -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Loại câu hỏi (question_type)</label>
                <select name="question_type" class="form-select" required>
                    <option value="">-- Chọn loại --</option>
                    <option value="multiple_choice" {{ old('question_type') == 'multiple_choice' ? 'selected' : '' }}>
                        Trắc nghiệm
                    </option>
                    <option value="fill_blank" {{ old('question_type') == 'fill_blank' ? 'selected' : '' }}>
                        Điền từ
                    </option>
                    <option value="true_false" {{ old('question_type') == 'true_false' ? 'selected' : '' }}>
                        Đúng / Sai
                    </option>
                </select>
            </div>

            <!-- OPTIONS -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Option A</label>
                    <input type="text" name="option_a" class="form-control" value="{{ old('option_a') }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Option B</label>
                    <input type="text" name="option_b" class="form-control" value="{{ old('option_b') }}">
                </div>

                <div class="col-md-6 mt-3">
                    <label class="form-label">Option C</label>
                    <input type="text" name="option_c" class="form-control" value="{{ old('option_c') }}">
                </div>

                <div class="col-md-6 mt-3">
                    <label class="form-label">Option D</label>
                    <input type="text" name="option_d" class="form-control" value="{{ old('option_d') }}">
                </div>
            </div>

            <!-- CORRECT ANSWER -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Đáp án đúng (correct_answer)</label>
                <input type="text" name="correct_answer" class="form-control" value="{{ old('correct_answer') }}"
                    required>
            </div>

            <!-- EXPLANATION -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Giải thích (explanation)</label>
                <textarea name="explanation" class="form-control" rows="3">{{ old('explanation') }}</textarea>
            </div>

            <!-- POINTS & ORDER -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Điểm (points)</label>
                    <input type="number" name="points" class="form-control" min="1" value="{{ old('points', 1) }}"
                        required>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Thứ tự hiển thị (display_order)</label>
                    <input type="number" name="display_order" class="form-control" min="1"
                        value="{{ old('display_order', 1) }}" required>
                </div>
            </div>

            <!-- ACTION -->
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('quizzes.questions.index', $quiz->id) }}" class="btn btn-secondary">
                    Hủy
                </a>
                <button type="submit" class="btn btn-primary">
                    Lưu câu hỏi
                </button>
            </div>

        </form>
    </div>
@endsection
