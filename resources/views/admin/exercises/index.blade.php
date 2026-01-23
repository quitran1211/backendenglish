@extends('admin.layouts.app')

@section('title', 'Exercise')

@section('content')
    <div class="container-fluid p-4">

        <!-- ===== HEADER ===== -->
        <div class="d-flex align-items-center justify-content-between rounded border bg-white p-4 shadow-sm mb-4">
            <h2 class="h4 fw-semibold mb-0 text-dark">
                Quản lý Exercise
            </h2>
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('exercises.create') }}"
                    class="d-inline-flex align-items-center gap-2 rounded bg-primary px-4 py-2 text-white text-decoration-none shadow-sm">
                    <i class="fa-solid fa-plus"></i>
                    <span>Thêm exercise</span>
                </a>

                <a href="{{ route('exercises.trash') }}"
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
                            <th class="px-4 py-3">Câu hỏi</th>
                            <th class="px-4 py-3">Bài học</th>
                            <th class="px-4 py-3 text-center">Độ khó</th>
                            <th class="px-4 py-3 text-center">Thao tác</th>
                            <th class="px-4 py-3 text-center">ID</th>
                            <th class="px-4 py-3 text-center"></th>
                            <th class="px-4 py-3 text-center"></th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($exercises as $item)
                            <tr class="hover-bg-light">
                                <td class="px-4 py-3 fw-medium">
                                    {{ Str::limit($item->sentence, 60) }}
                                </td>

                                <td class="px-4 py-3 text-secondary">
                                    {{ $item->lesson->title ?? '—' }}
                                </td>

                                <!-- Difficulty -->
                                <td class="px-4 py-3 text-center">
                                    @php
                                        $colors = [
                                            'easy' => 'success',
                                            'medium' => 'warning',
                                            'hard' => 'danger',
                                        ];
                                    @endphp
                                    <span
                                        class="badge bg-{{ $colors[$item->difficulty] ?? 'secondary' }}
                                             bg-opacity-10
                                             text-{{ $colors[$item->difficulty] ?? 'secondary' }}
                                             px-3 py-2 rounded-pill">
                                        {{ ucfirst($item->difficulty) }}
                                    </span>
                                </td>

                                <!-- Actions -->
                                <td class="px-4 py-3 text-center">
                                    <div class="d-inline-flex align-items-center gap-3">
                                        <!-- Edit -->
                                        <a href="{{ route('exercises.edit', $item) }}"
                                            class="text-primary text-decoration-none">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>

                                        <!-- Soft delete -->
                                        <form action="{{ route('exercises.destroy', $item) }}" method="POST"
                                            onsubmit="return confirm('Xóa exercise này?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn p-0 border-0 bg-transparent text-danger">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>


                                <td class="px-4 py-3 text-center text-secondary">
                                    {{ $item->id }}
                                </td>
                                <td>
                                    <a href="{{ route('exercise.options.index', $item) }}"
                                        class="text-info text-decoration-none" title="Quản lý đáp án">
                                        <i class="fa-solid fa-list-check"></i>
                                    </a>
                                </td>

                                <td class="px-4 py-3 text-center">
                                    <a href="{{ route('exercises.show', $item) }}"
                                        class="text-primary text-decoration-none">
                                        Xem
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    Không có exercise nào
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="border-top p-4">
                {{ $exercises->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection
