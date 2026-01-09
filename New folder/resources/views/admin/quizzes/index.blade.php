@extends('admin.layouts.app')

@section('title', 'Quiz')

@section('content')
    <div class="container-fluid p-4">

        <!-- ===== HEADER ===== -->
        <div class="d-flex align-items-center justify-content-between rounded border bg-white p-4 shadow-sm mb-4">
            <h2 class="h4 fw-semibold mb-0 text-dark">
                Quản lý câu hỏi
            </h2>

            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('quizzes.create') }}"
                    class="d-inline-flex align-items-center gap-2 rounded bg-primary px-4 py-2 text-white text-decoration-none shadow-sm">
                    <i class="fa-solid fa-plus"></i>
                    <span>Thêm câu hỏi</span>
                </a>

                <a href="{{ route('quizzes.trash') }}"
                    class="d-inline-flex align-items-center gap-2 rounded bg-danger px-4 py-2 text-white text-decoration-none shadow-sm">
                    <i class="fa-solid fa-trash"></i>
                    <span>Thùng rác</span>
                </a>
            </div>
        </div>

        <!-- ===== TABLE ===== -->
        <div class="rounded border bg-white shadow-sm overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="table-light">
                        <tr class="text-secondary">
                            <th class="px-4 py-3">Tiêu đề</th>
                            <th class="px-4 py-3">Lesson</th>
                            <th class="px-4 py-3">Level</th>
                            <th class="px-4 py-3">Loại</th>
                            <th class="px-4 py-3 text-center">Trạng thái</th>
                            <th class="px-4 py-3 text-center">Thao tác</th>
                            <th class="px-4 py-3 text-center">ID</th>
                            <th class="px-4 py-3 text-center"></th>
                            <th class="px-4 py-3 text-center">Quản lý câu hỏi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($quizzes as $item)
                            <tr class="hover-bg-light">
                                <td class="px-4 py-3 fw-medium">
                                    {{ $item->title }}
                                </td>
                                <td class="px-4 py-3">
                                    {{ $item->lesson?->title ?? '—' }}
                                </td>
                                <td class="px-4 py-3">
                                    {{ $item->level?->level_name ?? '—' }}
                                </td>

                                <td class="px-4 py-3">
                                    {{ $item->quiz_type }}
                                </td>

                                <!-- Trạng thái -->
                                <td class="px-4 py-3 text-center">
                                    @if ($item->is_active)
                                        <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill">
                                            Hoạt động
                                        </span>
                                    @else
                                        <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2 rounded-pill">
                                            Tạm ẩn
                                        </span>
                                    @endif
                                </td>

                                <!-- Thao tác -->
                                <td class="px-4 py-3 text-center">
                                    <div class="d-inline-flex align-items-center gap-3">

                                        <!-- Toggle status -->
                                        <a href="{{ route('quizzes.toggleStatus', $item->id) }}" title="Bật / Tắt"
                                            class="text-decoration-none">
                                            @if ($item->is_active)
                                                <i class="fa-solid fa-toggle-on text-success fs-5"></i>
                                            @else
                                                <i class="fa-solid fa-toggle-off text-danger fs-5"></i>
                                            @endif
                                        </a>

                                        <!-- Edit -->
                                        <a href="{{ route('quizzes.edit', $item->id) }}"
                                            class="text-primary text-decoration-none">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>

                                        <!-- Soft delete -->
                                        <a href="{{ route('quizzes.delete', $item->id) }}"
                                            onclick="return confirm('Bạn chắc chắn muốn xóa bài học này?')"
                                            class="text-danger text-decoration-none">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </div>
                                </td>

                                <td class="px-4 py-3 text-center text-secondary">
                                    {{ $item->id }}
                                </td>

                                <td class="px-4 py-3 text-center">
                                    <a href="{{ route('quizzes.show', $item->id) }}"
                                        class="text-primary text-decoration-none">
                                        Xem
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('quizzes.questions.index', $item->id) }}"
                                        class="btn btn-sm btn-primary">
                                        Quản lý câu hỏi
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    Không có bài học nào
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
@endsection
