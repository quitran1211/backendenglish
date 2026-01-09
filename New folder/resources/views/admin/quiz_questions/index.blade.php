@extends('admin.layouts.app')

@section('title', 'Quản lý Câu hỏi')

@section('content')
    <div class="container-fluid p-4">

        <!-- HEADER -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-semibold mb-1">Câu hỏi của Quiz</h4>
                <div class="text-muted small">
                    {{ $quiz->title }} • {{ $questions->count() }} câu hỏi
                </div>
            </div>

            <div class="d-flex gap-2">
                <a href="{{ route('quizzes.questions.index', $quiz->id) }}" class="btn btn-secondary btn-sm">
                    Quay lại Quiz
                </a>
                <a href="{{ route('quizzes.questions.create', $quiz->id) }}" class="btn btn-primary btn-sm">
                    Thêm câu hỏi
                </a>
                <a href="{{ route('quizzes.questions.trash', $quiz->id) }}" class="btn btn-outline-secondary btn-sm">
                    Thùng rác
                </a>
            </div>
        </div>

        <!-- ALERT -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- TABLE -->
        <div class="card">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Câu hỏi</th>
                            <th width="160" class="text-center">Từ vựng</th>
                            <th width="140" class="text-center">Loại</th>
                            <th width="80" class="text-center">Điểm</th>
                            <th width="100" class="text-center">Thứ tự</th>
                            <th width="150" class="text-center">Thao tác</th>
                            <th width="60" class="text-center">ID</th>
                            <th width="60" class="text-center"></th>


                        </tr>
                    </thead>
                    <tbody>
                        @forelse($questions as $index => $question)
                            <tr>
                                <td>
                                    <div class="fw-semibold">
                                        {{ Str::limit($question->question_text, 80) }}
                                    </div>
                                    <small class="text-muted">
                                        Đáp án đúng: <strong>{{ $question->correct_answer }}</strong>
                                    </small>
                                </td>

                                <td>
                                    @if ($question->vocabulary)
                                        <span class="badge bg-info">
                                            {{ $question->vocabulary->word }}
                                        </span>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>

                                <td>
                                    <span class="badge bg-secondary">
                                        {{ $question->question_type }}
                                    </span>
                                </td>

                                <td class="text-center">
                                    {{ $question->points }}
                                </td>

                                <td class="text-center">
                                    {{ $question->display_order }}
                                </td>

                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <!-- Edit -->
                                        <a href="{{ route('quizzes.questions.edit', [$quiz->id, $question->id]) }}"
                                            class="text-primary text-decoration-none">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>

                                        <!-- Soft delete -->
                                        <a href="{{ route('quizzes.questions.delete', [$quiz->id, $question->id]) }}"
                                            onclick="return confirm('Bạn chắc chắn muốn xóa câu hỏi này?')"
                                            class="text-danger text-decoration-none">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                                <td class="text-center">{{ $question->id }}</td>
                                <td class="px-4 py-3 text-center">
                                    <a href="{{ route('quizzes.questions.show', [$quiz->id, $question->id]) }}"
                                        class="text-primary text-decoration-none">
                                        Xem
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    Chưa có câu hỏi nào
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
