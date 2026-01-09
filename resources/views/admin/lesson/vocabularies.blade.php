@extends('admin.layouts.app')

@section('title', 'Quản lý từ vựng')

@section('content')
    <div class="container-fluid p-4">

        <!-- ===== HEADER ===== -->
        <div class="d-flex align-items-center justify-content-between rounded border bg-white p-4 shadow-sm mb-4">
            <div>
                <h2 class="h4 fw-semibold mb-1">
                    Quản lý từ vựng
                </h2>
                <div class="text-muted">
                    Bài học: <strong>{{ $lesson->title }}</strong>
                    @if ($lesson->level)
                        • Level: <strong>{{ $lesson->level->level_name }}</strong>
                    @endif
                </div>
            </div>

            <a href="{{ route('lesson.index') }}" class="btn btn-outline-secondary">
                <i class="fa-solid fa-arrow-left"></i> Quay lại
            </a>
        </div>

        <div class="row g-4">

            <!-- ================= TỪ VỰNG TRONG BÀI ================= -->
            <div class="col-12">
                <div class="rounded border bg-white shadow-sm">

                    <div class="p-3 border-bottom fw-semibold">
                        Từ vựng trong bài ({{ $lesson->vocabularies->count() }})
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="px-3">#</th>
                                    <th>Từ vựng</th>
                                    <th>Phiên âm</th>
                                    <th>Loại từ</th>
                                    <th>Nghĩa (VI)</th>
                                    <th>Nghĩa (EN)</th>
                                    <th class="text-center">Thao tác</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($lesson->vocabularies as $index => $vocab)
                                    <tr>
                                        <td class="px-3">{{ $index + 1 }}</td>

                                        <td class="fw-semibold">
                                            {{ $vocab->word }}
                                        </td>

                                        <td class="fst-italic text-muted">
                                            {{ $vocab->pronunciation ?? '-' }}
                                        </td>

                                        <td>
                                            <span class="badge bg-info text-dark">
                                                {{ $vocab->word_type ?? 'N/A' }}
                                            </span>
                                        </td>

                                        <td>
                                            {{ $vocab->meaning_vi ?? '-' }}
                                        </td>

                                        <td class="text-muted">
                                            {{ $vocab->meaning_en ?? '-' }}
                                        </td>

                                        <td class="text-center">
                                            <form
                                                action="{{ route('lesson.removeVocabulary', [$lesson->id, $vocab->id]) }}"
                                                method="POST" onsubmit="return confirm('Xóa từ vựng này khỏi bài học?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-outline-danger">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-4">
                                            Chưa có từ vựng nào
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            {{-- ===== ALERT ===== --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    <i class="fa-solid fa-circle-check me-1"></i>
                    {{ session('success') }}
                    <button class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <i class="fa-solid fa-triangle-exclamation me-1"></i>
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- ================= IMPORT EXCEL ================= -->
            <div class="col-12">
                <div class="rounded border bg-white shadow-sm">
                    <div class="p-3 border-bottom fw-semibold">
                        Import từ vựng từ Excel
                    </div>

                    <div class="p-3">
                        <form action="{{ route('lesson.importVocabularies', $lesson->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <input type="file" name="file" class="form-control" accept=".xlsx,.xls,.csv" required>
                            </div>

                            <button class="btn btn-success w-100">
                                <i class="fa-solid fa-file-import"></i>
                                Import từ Excel
                            </button>

                            <div class="form-text mt-2">
                                File Excel gồm các cột:
                                <code>word</code>,
                                <code>pronunciation</code>,
                                <code>word_type</code>,
                                <code>meaning_vi</code>,
                                <code>meaning_en</code>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
