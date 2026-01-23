@extends('admin.layouts.app')

@section('title', 'Thùng rác Exercise')

@section('content')
    <div class="container-fluid p-4">

        <!-- ===== HEADER ===== -->
        <div class="d-flex align-items-center justify-content-between rounded border bg-white p-4 shadow-sm mb-4">
            <h2 class="h4 fw-semibold mb-0 text-dark">
                Thùng rác Exercise
            </h2>

            <a href="{{ route('exercises.index') }}"
                class="d-inline-flex align-items-center gap-2 rounded bg-secondary px-4 py-2 text-white text-decoration-none shadow-sm">
                <i class="fa-solid fa-arrow-left"></i>
                <span>Quay lại</span>
            </a>
        </div>

        <!-- ===== TABLE ===== -->
        <div class="rounded border bg-white shadow-sm overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="table-light">
                        <tr class="text-secondary">
                            <th class="px-4 py-3">Câu hỏi</th>
                            <th class="px-4 py-3 text-center">Ngày xóa</th>
                            <th class="px-4 py-3 text-center">Thao tác</th>
                            <th class="px-4 py-3 text-center">ID</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($exercises as $item)
                            <tr>
                                <td class="px-4 py-3 fw-medium">
                                    {{ Str::limit($item->sentence, 60) }}
                                </td>

                                <td class="px-4 py-3 text-center text-secondary">
                                    {{ $item->deleted_at->format('d/m/Y H:i') }}
                                </td>

                                <td class="px-4 py-3 text-center">
                                    <div class="d-inline-flex align-items-center gap-3">
                                        <!-- Restore -->
                                        <form action="{{ route('exercises.restore', $item->id) }}" method="POST">
                                            @csrf
                                            <button class="btn p-0 border-0 bg-transparent text-success">
                                                <i class="fa-solid fa-rotate-left"></i>
                                            </button>
                                        </form>

                                        <!-- Force delete -->
                                        <form action="{{ route('exercises.force', $item->id) }}" method="POST"
                                            onsubmit="return confirm('Xóa vĩnh viễn exercise này?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn p-0 border-0 bg-transparent text-danger">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>

                                <td class="px-4 py-3 text-center text-secondary">
                                    {{ $item->id }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">
                                    Thùng rác trống
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="border-top p-4">
                {{ $exercises->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection
