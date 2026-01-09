@extends('admin.layouts.app')

@section('title', 'Tạo Quiz mới')

@section('content')

    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col">
                <h1 class="h3">Tạo Quiz mới</h1>
            </div>
        </div>

        ```
        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('quizzes.store') }}" method="POST">
                    @csrf

                    {{-- LEVEL --}}
                    <div class="mb-3">
                        <label class="form-label">Level</label>
                        <select name="level_id" class="form-select" required>
                            <option value="">-- Chọn level --</option>
                            @foreach ($levels as $level)
                                <option value="{{ $level->id }}" @selected(old('level_id') == $level->id)>
                                    {{ $level->level_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('level_id')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- LESSON --}}
                    <div class="mb-3">
                        <label class="form-label">Lesson</label>
                        <select name="lesson_id" class="form-select" required>
                            <option value="">-- Chọn lesson --</option>
                            @foreach ($lessons as $lesson)
                                <option value="{{ $lesson->id }}" @selected(old('lesson_id') == $lesson->id)>
                                    {{ $lesson->title }}
                                </option>
                            @endforeach
                        </select>
                        @error('lesson_id')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- TITLE --}}
                    <div class="mb-3">
                        <label class="form-label">Tiêu đề Quiz</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                        @error('title')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- DESCRIPTION --}}
                    <div class="mb-3">
                        <label class="form-label">Mô tả</label>
                        <textarea name="description" rows="3" class="form-control">{{ old('description') }}</textarea>
                    </div>

                    {{-- QUIZ TYPE --}}
                    <div class="mb-3">
                        <label class="form-label">Loại Quiz</label>
                        <select name="quiz_type" class="form-select" required>
                            <option value="vocabulary">Vocabulary</option>
                            <option value="multiple_choice">Multiple Choice</option>
                            <option value="listening">Listening</option>
                        </select>
                    </div>

                    {{-- TIME LIMIT --}}
                    <div class="mb-3">
                        <label class="form-label">Thời gian làm bài (phút)</label>
                        <input type="number" name="time_limit" class="form-control" value="{{ old('time_limit') }}"
                            min="0">
                    </div>

                    {{-- PASSING SCORE --}}
                    <div class="mb-3">
                        <label class="form-label">Điểm đạt (%)</label>
                        <input type="number" name="passing_score" class="form-control"
                            value="{{ old('passing_score', 70) }}" min="0" max="100" required>
                    </div>

                    {{-- IS ACTIVE --}}
                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" name="is_active" value="1" checked>
                        <label class="form-check-label">Kích hoạt quiz</label>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('quizzes.index') }}" class="btn btn-secondary">Quay lại</a>
                        <button type="submit" class="btn btn-primary">Lưu Quiz</button>
                    </div>
                </form>
            </div>
        </div>
        ```

    </div>
@endsection
