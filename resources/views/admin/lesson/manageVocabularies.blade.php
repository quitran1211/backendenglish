@extends('admin.layouts.app')

@section('title', 'Quản lý từ vựng')

@section('content')
    <div class="container-fluid p-4">

        <!-- ===== HEADER ===== -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-semibold mb-1">{{ $lesson->title }}</h4>
                <div class="text-muted">
                    @if ($lesson->level)
                        Level: <strong>{{ $lesson->level->level_name ?? '—' }}</strong> |
                    @endif
                    Tổng từ vựng: <strong>{{ $lesson->vocabularies_count }}</strong>
                </div>
            </div>

            <a href="{{ route('lesson.index') }}" class="btn btn-outline-secondary">
                <i class="fa-solid fa-arrow-left me-1"></i> Quay lại
            </a>
        </div>

        <div class="row g-4">

            <!-- ================== DANH SÁCH TỪ VỰNG TRONG BÀI ================== -->
            <div class="col-lg-7">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white fw-semibold">
                        Từ vựng trong bài học
                    </div>

                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Từ vựng</th>
                                    <th>Nghĩa</th>
                                    <th class="text-center">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($lesson->vocabularies as $index => $vocab)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td class="fw-medium">{{ $vocab->word }}</td>
                                        <td class="text-muted">{{ $vocab->meaning }}</td>
                                        <td class="text-center">
                                            <form method="POST"
                                                action="{{ route('lesson.removeVocabulary', [$lesson->id, $vocab->id]) }}"
                                                onsubmit="return confirm('Xóa từ vựng này khỏi bài học?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-outline-danger">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-4">
                                            Chưa có từ vựng nào
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- ================== THÊM TỪ VỰNG ================== -->
            <div class="col-lg-5">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white fw-semibold">
                        Thêm từ vựng vào bài
                    </div>

                    <form method="POST" action="{{ route('lesson.addVocabularies', $lesson->id) }}">
                        @csrf

                        <div class="card-body">
                            @if ($availableVocabularies->isEmpty())
                                <div class="text-muted text-center py-3">
                                    Không còn từ vựng để thêm
                                </div>
                            @else
                                <div class="mb-3">
                                    <label class="form-label">Chọn từ vựng</label>
                                    <select name="vocabulary_ids[]" class="form-select" multiple size="10" required>
                                        @foreach ($availableVocabularies as $vocab)
                                            <option value="{{ $vocab->id }}">
                                                {{ $vocab->word }} — {{ $vocab->meaning }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="form-text">
                                        Giữ Ctrl (Windows) hoặc Cmd (Mac) để chọn nhiều
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="card-footer bg-white text-end">
                            <button class="btn btn-primary" {{ $availableVocabularies->isEmpty() ? 'disabled' : '' }}>
                                <i class="fa-solid fa-plus me-1"></i> Thêm vào bài học
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
