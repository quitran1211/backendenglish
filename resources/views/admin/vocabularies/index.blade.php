@extends('admin.layouts.app')

@section('title', 'Quản lý từ vựng')

@section('content')
    <div class="container-fluid p-4">

        {{-- ===== HEADER ===== --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="h4 fw-semibold mb-1">Quản lý từ vựng</h2>
                <div class="text-muted">Danh sách toàn bộ từ vựng trong hệ thống</div>
            </div>

            <div class="d-flex gap-2">
                <a href="{{ route('vocabularies.create') }}" class="btn btn-primary">
                    <i class="fa-solid fa-plus"></i> Thêm từ vựng
                </a>

                <a href="{{ route('vocabularies.importExcel') }}" class="btn btn-success">
                    <i class="fa-solid fa-file-import"></i> Import Excel
                </a>
                <a href="{{ route('vocabularies.trash') }}"
                    class="d-inline-flex align-items-center gap-2 rounded
                      bg-danger px-4 py-2 text-white text-decoration-none
                      shadow-sm transition hover:bg-danger-dark">
                    <i class="fa-solid fa-trash"></i>
                    <span>Thùng rác</span>
                </a>
            </div>
        </div>

        {{-- ===== TABLE ===== --}}
        <div class="rounded border bg-white shadow-sm">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center">Từ vựng</th>
                            <th>Phiên âm</th>
                            <th>Loại từ</th>
                            <th>Nghĩa (VI)</th>
                            <th>Nghĩa (EN)</th>
                            <th class="text-center">Trạng thái</th>
                            <th class="text-center">Thao tác</th>
                            <th class="px-3 text-center">ID</th>
                            <th class="text-center"></th>

                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($vocabularies as $index => $vocab)
                            <tr>

                                <td class="fw-semibold text-center">
                                    {{ $vocab->word }}
                                </td>

                                <td class="text-muted">
                                    {{ $vocab->pronunciation ?? '—' }}
                                </td>

                                <td>
                                    <span class="badge bg-info text-dark">
                                        {{ $vocab->word_type ?? 'N/A' }}
                                    </span>
                                </td>

                                <td>{{ $vocab->meaning_vi }}</td>
                                <td class="text-muted">{{ $vocab->meaning_en }}</td>

                                <!-- Trạng thái -->
                                <td class="text-center">
                                    @if ($vocab->is_active)
                                        <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill">
                                            Hoạt động
                                        </span>
                                    @else
                                        <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2 rounded-pill">
                                            Tạm ẩn
                                        </span>
                                    @endif
                                </td>

                                <td class="text-center">
                                    <div class="d-inline-flex align-items-center gap-3">

                                        <!-- Toggle status -->
                                        <a href="{{ route('vocabularies.toggleStatus', $vocab->id) }}" title="Bật / Tắt"
                                            class="text-decoration-none">
                                            @if ($vocab->is_active)
                                                <i class="fa-solid fa-toggle-on text-success fs-5"></i>
                                            @else
                                                <i class="fa-solid fa-toggle-off text-danger fs-5"></i>
                                            @endif
                                        </a>
                                        <a href="{{ route('vocabularies.edit', $vocab->id) }}"
                                            class="text-primary text-decoration-none">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                        <form action="{{ route('vocabularies.destroy', $vocab->id) }}" method="POST"
                                            class="d-inline" onsubmit="return confirm('Bạn có chắc muốn xóa từ vựng này?')">
                                            @csrf @method('DELETE')
                                            <button class="text-danger text-decoration-none bg-transparent border-0 ">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    {{ $vocab->id }}
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <a href="{{ route('vocabularies.show', $vocab->id) }}"
                                        class="text-primary text-decoration-none">
                                        Xem
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">
                                    Chưa có từ vựng nào
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- ===== PAGINATION ===== --}}
            @if ($vocabularies->hasPages())
                <div class="p-3 border-top">
                    {{ $vocabularies->appends(request()->query())->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </div>
@endsection
