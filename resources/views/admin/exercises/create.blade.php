@extends('admin.layouts.app')

@section('title', 'Thêm Exercise')

@section('content')
    <div class="container-fluid p-4">

        <!-- ===== HEADER ===== -->
        <div class="d-flex align-items-center justify-content-between rounded border bg-white p-4 shadow-sm mb-4">
            <h2 class="h4 fw-semibold mb-0 text-dark">
                Thêm Exercise mới
            </h2>

            <a href="{{ route('exercises.index') }}"
                class="d-inline-flex align-items-center gap-2 rounded bg-secondary px-4 py-2 text-white text-decoration-none shadow-sm">
                <i class="fa-solid fa-arrow-left"></i>
                <span>Quay lại</span>
            </a>
        </div>

        <!-- ===== FORM ===== -->
        <div class="rounded border bg-white shadow-sm p-4">
            <form action="{{ route('exercises.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-medium">Bài học</label>
                    <select id="lesson_id" name="lesson_id" class="form-select" required>
                        <option value="">-- Chọn bài học --</option>
                        @foreach ($lessons as $lesson)
                            <option value="{{ $lesson->id }}">
                                {{ $lesson->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- <div class="mb-3">
                    <label class="form-label fw-medium">Từ vựng</label>
                    <select name="lesson_id" class="form-select" required>
                        <option value="">-- Chọn từ vựng --</option>
                        @foreach ($vocabulary as $vocab)
                            <option value="{{ $vocab->id }}">{{ $vocab->word }}</option>
                        @endforeach
                    </select>
                </div> --}}
                <div class="mb-3">
                    <label class="form-label">Vocabulary</label>
                    <select id="vocabulary_id" name="vocabulary_id" class="form-select" required>
                        <option value="">-- Chọn từ vựng --</option>
                    </select>

                </div>


                <div class="mb-3">
                    <label class="form-label fw-medium">Câu có chỗ trống</label>
                    <input type="text" name="sentence" class="form-control" placeholder="I ___ to school" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-medium">Câu đầy đủ</label>
                    <input type="text" name="sentence_full" class="form-control" placeholder="I go to school" required>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-medium">Độ khó</label>
                    <select name="difficulty" class="form-select">
                        <option value="easy">Dễ</option>
                        <option value="medium">Trung bình</option>
                        <option value="hard">Khó</option>
                    </select>
                </div>

                <div class="text-end">
                    <button class="btn btn-primary px-4">
                        <i class="fa-solid fa-save me-1"></i>
                        Lưu
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script>
        const vocabUrlTemplate =
            "{{ route('exercises.lessons.vocabularies', ['lesson' => '__ID__']) }}";

        document.getElementById('lesson_id').addEventListener('change', function() {
            const lessonId = this.value;
            const vocabSelect = document.getElementById('vocabulary_id');

            vocabSelect.innerHTML = '<option>Đang tải...</option>';

            if (!lessonId) {
                vocabSelect.innerHTML = '<option value="">-- Chọn từ vựng --</option>';
                return;
            }

            const url = vocabUrlTemplate.replace('__ID__', lessonId);

            fetch(url)
                .then(res => res.json())
                .then(data => {
                    vocabSelect.innerHTML = '<option value="">-- Chọn từ vựng --</option>';
                    data.forEach(vocab => {
                        vocabSelect.innerHTML +=
                            `<option value="${vocab.id}">${vocab.word}</option>`;
                    });
                });
        });
    </script>

@endsection
