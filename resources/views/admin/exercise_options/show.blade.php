@extends('admin.layouts.app')

@section('title', 'Chi tiết đáp án')

@section('content')
    <div class="container-fluid p-4">

        <!-- ===== HEADER ===== -->
        <div class="d-flex align-items-center justify-content-between rounded border bg-white p-4 shadow-sm mb-4">
            <h2 class="h4 fw-semibold mb-0 text-dark">
                Chi tiết đáp án
            </h2>

            <div class="d-flex gap-3">
                <a href="{{ route('exercise.options.edit', [$exercise->id, $option->id]) }}"
                    class="d-inline-flex align-items-center gap-2 rounded bg-primary px-4 py-2 text-white text-decoration-none shadow-sm">
                    <i class="fa-solid fa-pen-to-square"></i>
                    Chỉnh sửa
                </a>

                <a href="{{ route('exercise.options.index', $exercise->id) }}"
                    class="d-inline-flex align-items-center gap-2 rounded bg-light px-4 py-2 text-dark text-decoration-none shadow-sm">
                    <i class="fa-solid fa-arrow-left"></i>
                    Quay lại
                </a>
            </div>
        </div>

        <!-- ===== CONTENT ===== -->
        <div class="rounded border bg-white shadow-sm p-4">

            <div class="row g-4">

                <!-- Nội dung đáp án -->
                <div class="col-md-8">
                    <div class="mb-3">
                        <label class="form-label text-secondary">Nội dung đáp án</label>
                        <div class="fw-medium fs-5">
                            {{ $option->option_text }}
                        </div>
                    </div>
                </div>

                <!-- Thông tin phụ -->
                <div class="col-md-4">
                    <div class="border rounded p-3 h-100">

                        <div class="mb-3">
                            <div class="text-secondary mb-1">Trạng thái</div>
                            @if ($option->is_correct)
                                <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill">
                                    Đáp án đúng
                                </span>
                            @else
                                <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-2 rounded-pill">
                                    Đáp án sai
                                </span>
                            @endif
                        </div>

                        <div class="mb-3">
                            <div class="text-secondary">Exercise ID</div>
                            <div class="fw-medium">{{ $exercise->id }}</div>
                        </div>

                        <div>
                            <div class="text-secondary">Option ID</div>
                            <div class="fw-medium">{{ $option->id }}</div>
                        </div>

                    </div>
                </div>

            </div>

            <!-- ===== ACTION ===== -->
            <div class="border-top pt-4 mt-4 d-flex gap-3">
                <a href="{{ route('exercise.options.edit', [$exercise->id, $option->id]) }}" class="btn btn-primary px-4">
                    Chỉnh sửa
                </a>

                <form action="{{ route('exercise.options.destroy', [$exercise->id, $option->id]) }}" method="POST"
                    onsubmit="return confirm('Bạn có chắc chắn muốn xóa đáp án này?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger px-4">
                        Xóa
                    </button>
                </form>
            </div>

        </div>
    </div>
@endsection
