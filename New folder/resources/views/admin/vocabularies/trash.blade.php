@extends('admin.layouts.app')

@section('title', 'Thùng rác - Từ vựng')

@section('content')
    <div class="container-fluid p-4">

        {{-- ===== HEADER ===== --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="h4 fw-semibold mb-1 text-danger">
                    <i class="fa-solid fa-trash"></i> Thùng rác từ vựng
                </h2>
                <div class="text-muted">Danh sách từ vựng đã bị xóa</div>
            </div>

            <a href="{{ route('vocabularies.index') }}" class="btn btn-secondary">
                <i class="fa-solid fa-arrow-left"></i> Quay lại
            </a>
        </div>

        {{-- ===== TABLE ===== --}}
        <div class="rounded border bg-white shadow-sm">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Từ vựng</th>
                            <th>Loại từ</th>
                            <th>Nghĩa (VI)</th>
                            <th class="text-center">Ngày xóa</th>
                            <th class="text-center">Thao tác</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($vocabularies as $vocab)
                            <tr>
                                <td class="fw-semibold">{{ $vocab->word }}</td>

                                <td>
                                    <span class="badge bg-info text-dark">
                                        {{ $vocab->word_type ?? 'N/A' }}
                                    </span>
                                </td>

                                <td>{{ $vocab->meaning_vi }}</td>

                                <td class="text-center text-muted">
                                    {{ $vocab->deleted_at?->format('d/m/Y H:i') }}
                                </td>

                                <td class="text-center">
                                    <div class="d-inline-flex gap-2">

                                        {{-- Restore --}}
                                        <form action="{{ route('vocabularies.restore', $vocab->id) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-sm btn-success">
                                                <i class="fa-solid fa-rotate-left"></i> Khôi phục
                                            </button>
                                        </form>

                                        {{-- Force delete --}}
                                        <form action="{{ route('vocabularies.forceDelete', $vocab->id) }}" method="POST"
                                            onsubmit="return confirm('Xóa vĩnh viễn từ vựng này?')">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm btn-danger">
                                                <i class="fa-solid fa-trash"></i> Xóa hẳn
                                            </button>
                                        </form>

                                    </div>
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

            {{-- PAGINATION --}}
            @if ($vocabularies->hasPages())
                <div class="p-3 border-top">
                    {{ $vocabularies->links() }}
                </div>
            @endif
        </div>

    </div>
@endsection
