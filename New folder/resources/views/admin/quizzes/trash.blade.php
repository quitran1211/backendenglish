@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid p-4">

        <!-- ===== HEADER ===== -->
        <div class="d-flex align-items-center justify-content-between rounded border bg-white p-4 shadow-sm mb-4">
            <h2 class="h4 fw-semibold mb-0 text-dark">
                Thùng rác câu hỏi
            </h2>

            <a href="{{ route('quizzes.index') }}"
                class="d-inline-flex align-items-center gap-2 rounded bg-secondary px-4 py-2 text-white text-decoration-none shadow-sm">
                <i class="fa-solid fa-arrow-left"></i>
                <span>Quay lại danh sách</span>
            </a>
        </div>

        <!-- ===== TABLE ===== -->
        <div class="rounded border bg-white shadow-sm overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="table-light">
                        <tr class="text-secondary">
                            <th class="px-4 py-3">Tiêu đề</th>
                            <th class="px-4 py-3 text-center">Ngày xóa</th>
                            <th class="px-4 py-3 text-center">Thao tác</th>
                            <th class="px-4 py-3 text-center">ID</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse  ($quizzes as $quiz)
                            <tr class="hover-bg-light">

                                <td class="px-4 py-3 fw-medium text-danger">
                                    {{ $quiz->title }}
                                </td>

                                <td class="px-4 py-3 text-center text-secondary">
                                    {{ $quiz->deleted_at?->format('d/m/Y H:i') }}
                                </td>

                                <td class="px-4 py-3 text-center">
                                    <div class="d-inline-flex align-items-center gap-3">

                                        <!-- Restore -->
                                        <a href="{{ route('quizzes.restore', $quiz->id) }}" title="Khôi phục"
                                            class="text-success text-decoration-none">
                                            <i class="fa-solid fa-rotate-left fs-5"></i>
                                        </a>

                                        <!-- Force delete -->
                                        <form action="{{ route('quizzes.forceDelete', $quiz->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit">
                                                <a href=""><i class="fa-solid fa-trash text-red-500 px-2"></i></a>
                                            </button>
                                        </form>
                                    </div>
                                </td>

                                <td class="px-4 py-3 text-center text-secondary">
                                    {{ $quiz->id }}
                                </td>
                            </tr>
                        @empty

                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    Thùng rác trống
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="border-top p-4">
                {{ $quizzes->links() }}
            </div>
        </div>
    </div>

    <style>
        .hover-bg-light:hover {
            background-color: rgba(0, 0, 0, 0.02);
        }
    </style>
@endsection
