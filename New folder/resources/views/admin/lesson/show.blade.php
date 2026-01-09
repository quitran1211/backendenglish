@extends('admin.layouts.app')

@section('title', 'Chi tiết bài học')

@section('content')
    <div class="container-fluid p-4">

        <!-- ===== HEADER ===== -->
        <div class="d-flex align-items-center justify-content-between rounded border bg-white p-4 shadow-sm mb-4">
            <div>
                <h2 class="h4 fw-semibold mb-1 text-dark">
                    {{ $lesson->title }}
                </h2>
                <div class="text-muted">
                    Level: <strong>{{ $lesson->level?->level_name ?? '—' }}</strong>
                </div>
            </div>

            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('lesson.index') }}" class="btn btn-secondary">
                    <i class="fa-solid fa-arrow-left"></i>
                    Quay lại
                </a>

                <a href="{{ route('lesson.edit', $lesson->id) }}" class="btn btn-primary">
                    <i class="fa-solid fa-pen-to-square"></i>
                    Chỉnh sửa
                </a>

                <a href="{{ route('lesson.manageVocabularies', $lesson->id) }}" class="btn btn-success">
                    <i class="fa-solid fa-book"></i>
                    Từ vựng
                </a>
            </div>
        </div>

        <!-- ===== STATS ===== -->
        <div class="row g-4 mb-4">
            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h6 class="text-muted">Tổng từ vựng</h6>
                        <h2 class="fw-bold text-primary">
                            {{ $stats['total_vocabularies'] }}
                        </h2>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h6 class="text-muted">Số học viên</h6>
                        <h2 class="fw-bold text-success">
                            {{ $stats['total_students'] }}
                        </h2>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h6 class="text-muted">Hoàn thành</h6>
                        <h2 class="fw-bold text-warning">
                            {{ $stats['completion_rate'] }}
                        </h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- ===== INFO ===== -->
        <div class="row g-4 mb-4">
            <div class="col-md-8">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="fw-semibold mb-3">Thông tin bài học</h5>

                        <div class="mb-2">
                            <strong>Chủ đề:</strong>
                            <div class="text-muted">
                                {{ $lesson->topic }}
                            </div>
                        </div>

                        <div class="mb-2">
                            <strong>Mô tả:</strong>
                            <div class="text-muted">
                                {{ $lesson->description ?? '—' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="fw-semibold mb-3">Trạng thái</h5>

                        <div class="mb-2">
                            <strong>Kích hoạt:</strong>
                            @if ($lesson->is_active)
                                <span class="badge bg-success">Hoạt động</span>
                            @else
                                <span class="badge bg-danger">Tạm ẩn</span>
                            @endif
                        </div>

                        <div class="mb-2">
                            <strong>Loại:</strong>
                            @if ($lesson->is_free)
                                <span class="badge bg-primary">Miễn phí</span>
                            @else
                                <span class="badge bg-warning text-dark">Trả phí</span>
                            @endif
                        </div>

                        <div class="mb-2">
                            <strong>Số từ:</strong>
                            {{ $lesson->vocabularies_count }}
                        </div>

                        <div class="mb-2">
                            <strong>Thứ tự hiển thị:</strong>
                            {{ $lesson->display_order }}
                        </div>

                        <div class="mb-2">
                            <strong>Ngày tạo:</strong>
                            {{ $lesson->created_at->format('d/m/Y H:i') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ===== VOCABULARY LIST ===== -->
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="fw-semibold mb-3">Danh sách từ vựng</h5>

                @if ($lesson->vocabularies->count())
                    <ul class="list-group list-group-flush">
                        @foreach ($lesson->vocabularies as $vocab)
                            <li class="list-group-item d-flex justify-content-between">
                                <div>
                                    <strong>{{ $vocab->word }}</strong>
                                    <span class="text-muted ms-2">
                                        {{ $vocab->meaning }}
                                    </span>
                                </div>

                                <span class="text-muted">
                                    #{{ $vocab->pivot->display_order }}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="text-muted">
                        Chưa có từ vựng nào trong bài học
                    </div>
                @endif
            </div>
        </div>

    </div>
@endsection
