@extends('admin.layouts.app')

@section('title', 'Sửa Exercise')

@section('content')
    <div class="container-fluid p-4">

        <!-- ===== HEADER ===== -->
        <div class="d-flex align-items-center justify-content-between rounded border bg-white p-4 shadow-sm mb-4">
            <h2 class="h4 fw-semibold mb-0 text-dark">
                Sửa Exercise #{{ $exercise->id }}
            </h2>

            <a href="{{ route('exercises.show', $exercise) }}"
                class="d-inline-flex align-items-center gap-2 rounded bg-secondary px-4 py-2 text-white text-decoration-none shadow-sm">
                <i class="fa-solid fa-arrow-left"></i>
                <span>Quay lại</span>
            </a>
        </div>

        <!-- ===== FORM ===== -->
        <div class="rounded border bg-white shadow-sm p-4">
            <form action="{{ route('exercises.update', $exercise) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-medium">Bài học</label>
                    <select name="lesson_id" class="form-select">
                        @foreach ($lessons as $lesson)
                            <option value="{{ $lesson->id }}" @selected($lesson->id == $exercise->lesson_id)>
                                {{ $lesson->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-medium">Câu có chỗ trống</label>
                    <input type="text" name="sentence" value="{{ $exercise->sentence }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-medium">Câu đầy đủ</label>
                    <input type="text" name="sentence_full" value="{{ $exercise->sentence_full }}" class="form-control">
                </div>

                <div class="mb-4">
                    <label class="form-label fw-medium">Độ khó</label>
                    <select name="difficulty" class="form-select">
                        <option value="easy" @selected($exercise->difficulty == 'easy')>Dễ</option>
                        <option value="medium" @selected($exercise->difficulty == 'medium')>Trung bình</option>
                        <option value="hard" @selected($exercise->difficulty == 'hard')>Khó</option>
                    </select>
                </div>

                <div class="text-end">
                    <button class="btn btn-success px-4">
                        <i class="fa-solid fa-check me-1"></i>
                        Cập nhật
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
