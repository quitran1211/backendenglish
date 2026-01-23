@extends('admin.layouts.app')

@section('title', 'Exercise Options')

@section('content')
    <div class="container-fluid p-4">

        <!-- ===== HEADER ===== -->
        <div class="d-flex align-items-center justify-content-between rounded border bg-white p-4 shadow-sm mb-4">
            <h2 class="h4 fw-semibold mb-0 text-dark">
                Quản lý đáp án
            </h2>

            <div class="d-flex gap-3">
                <a href="{{ route('exercise.options.create', ['exercise' => $exercise->id]) }}"
                    class="d-inline-flex align-items-center gap-2 rounded bg-primary px-4 py-2 text-white">
                    <i class="fa-solid fa-plus"></i>
                    Thêm đáp án
                </a>

                <a href="{{ route('exercise.options.trash', ['exercise' => $exercise->id]) }}"
                    class="d-inline-flex align-items-center gap-2 rounded bg-danger px-4 py-2 text-white">
                    <i class="fa-solid fa-trash"></i>
                    Thùng rác
                </a>

            </div>
        </div>

        <!-- ===== TABLE ===== -->
        <div class="rounded border bg-white shadow-sm overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="table-light">
                        <tr class="text-secondary">
                            <th class="px-4 py-3">Nội dung đáp án</th>
                            <th class="px-4 py-3 text-center">Đúng / Sai</th>
                            <th class="px-4 py-3 text-center">Thao tác</th>
                            <th class="px-4 py-3 text-center">ID</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($list as $item)
                            <tr>
                                <td class="px-4 py-3 fw-medium">
                                    {{ $item->option_text }}
                                </td>

                                <td class="px-4 py-3 text-center">
                                    @if ($item->is_correct)
                                        <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill">
                                            Đúng
                                        </span>
                                    @else
                                        <span
                                            class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-2 rounded-pill">
                                            Sai
                                        </span>
                                    @endif
                                </td>

                                <td class="px-4 py-3 text-center">
                                    <div class="d-inline-flex gap-3">
                                        <a href="{{ route('exercise.options.edit', [
                                            'exercise' => $exercise->id,
                                            'option' => $item->id,
                                        ]) }}"
                                            class="text-primary">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>

                                        <form
                                            action="{{ route('exercise.options.destroy', [
                                                'exercise' => $exercise->id,
                                                'option' => $item->id,
                                            ]) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn p-0 text-danger">
                                                <i class="fa-solid fa-trash"></i>
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
                                    Chưa có đáp án nào
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="border-top p-4">
                {{ $list->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection
