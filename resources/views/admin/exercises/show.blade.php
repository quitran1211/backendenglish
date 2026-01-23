@extends('admin.layouts.app')

@section('title', 'Chi tiết Exercise')

@section('content')
    <div class="container-fluid p-4">

        <!-- ===== HEADER ===== -->
        <div class="d-flex align-items-center justify-content-between rounded border bg-white p-4 shadow-sm mb-4">
            <h2 class="h4 fw-semibold mb-0 text-dark">
                Chi tiết Exercise #{{ $exercise->id }}
            </h2>

            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('exercises.edit', $exercise) }}"
                    class="d-inline-flex align-items-center gap-2 rounded bg-warning px-4 py-2 text-white text-decoration-none shadow-sm">
                    <i class="fa-solid fa-pen-to-square"></i>
                    <span>Sửa</span>
                </a>

                <a href="{{ route('exercises.index') }}"
                    class="d-inline-flex align-items-center gap-2 rounded bg-secondary px-4 py-2 text-white text-decoration-none shadow-sm">
                    <i class="fa-solid fa-arrow-left"></i>
                    <span>Quay lại</span>
                </a>
            </div>
        </div>

        <!-- ===== CONTENT ===== -->
        <div class="rounded border bg-white shadow-sm p-4">

            <div class="row mb-3">
                <div class="col-md-3 text-secondary">Bài học</div>
                <div class="col-md-9 fw-medium">{{ $exercise->lesson->title ?? '—' }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 text-secondary">Câu có chỗ trống</div>
                <div class="col-md-9 fw-medium">{{ $exercise->sentence }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 text-secondary">Câu đầy đủ</div>
                <div class="col-md-9">{{ $exercise->sentence_full }}</div>
            </div>

            <div class="row mb-4">
                <div class="col-md-3 text-secondary">Độ khó</div>
                <div class="col-md-9">
                    <span class="badge bg-info bg-opacity-10 text-info px-3 py-2 rounded-pill">
                        {{ ucfirst($exercise->difficulty) }}
                    </span>
                </div>
            </div>

            <!-- OPTIONS -->
            <div>
                <h6 class="fw-semibold mb-3">Danh sách đáp án</h6>

                <ul class="list-group">
                    @foreach ($exercise->options as $opt)
                        <li class="list-group-item d-flex align-items-center justify-content-between">
                            <span>{{ $opt->option_text }}</span>

                            @if ($opt->is_correct)
                                <span class="badge bg-success bg-opacity-10 text-success rounded-pill">
                                    Đúng
                                </span>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>

        </div>
    </div>
@endsection
