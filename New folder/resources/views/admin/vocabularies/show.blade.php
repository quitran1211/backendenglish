@extends('admin.layouts.app')

@section('title', 'Chi tiết từ vựng')

@section('content')
    <div class="container-fluid p-4">

        {{-- ===== HEADER ===== --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="h4 fw-semibold mb-1">Chi tiết từ vựng</h2>
                <div class="text-muted">Thông tin chi tiết của từ vựng</div>
            </div>

            <div class="d-flex gap-2">
                <a href="{{ route('vocabularies.index') }}" class="btn btn-secondary">
                    <i class="fa-solid fa-arrow-left"></i> Quay lại
                </a>
                <a href="{{ route('vocabularies.edit', $vocab->id) }}" class="btn btn-primary">
                    <i class="fa-solid fa-pen"></i> Chỉnh sửa
                </a>
            </div>
        </div>

        {{-- ===== CONTENT ===== --}}
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">

                <div class="row mb-3">
                    <div class="col-md-3 fw-semibold text-muted">Từ vựng</div>
                    <div class="col-md-9 fs-5 fw-bold">{{ $vocab->word }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3 fw-semibold text-muted">Phiên âm</div>
                    <div class="col-md-9">{{ $vocab->pronunciation ?? '—' }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3 fw-semibold text-muted">Loại từ</div>
                    <div class="col-md-9">
                        <span class="badge bg-info text-dark">
                            {{ $vocab->word_type ?? 'N/A' }}
                        </span>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3 fw-semibold text-muted">Nghĩa (VI)</div>
                    <div class="col-md-9">{{ $vocab->meaning_vi }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3 fw-semibold text-muted">Nghĩa (EN)</div>
                    <div class="col-md-9 text-muted">{{ $vocab->meaning_en }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3 fw-semibold text-muted">Trạng thái</div>
                    <div class="col-md-9">
                        @if ($vocab->is_active)
                            <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill">
                                Hoạt động
                            </span>
                        @else
                            <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2 rounded-pill">
                                Tạm ẩn
                            </span>
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3 fw-semibold text-muted">ID</div>
                    <div class="col-md-9">{{ $vocab->id }}</div>
                </div>

            </div>
        </div>

    </div>
@endsection
