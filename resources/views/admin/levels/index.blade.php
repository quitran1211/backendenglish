@extends('admin.layouts.app')

@section('title', 'Quản lý Cấp độ')

@section('content')
    <div class="container-fluid p-4">

        <!-- ===== HEADER ===== -->
        <div class="d-flex align-items-center justify-content-between rounded border bg-white p-4 shadow-sm mb-4">
            <div>
                <h2 class="h4 fw-semibold mb-1 text-dark">Quản lý Cấp độ</h2>
                <p class="text-muted mb-0 small">Tổng cộng: {{ $levels->total() }} cấp độ</p>
            </div>

            <div class="d-flex gap-2">
                <a href="{{ route('levels.trash') }}" class="btn btn-outline-secondary">
                    <i class="fa-solid fa-trash"></i> Thùng rác
                </a>
                <a href="{{ route('levels.create') }}" class="btn btn-primary">
                    <i class="fa-solid fa-plus"></i> Thêm cấp độ
                </a>
            </div>
        </div>


        <!-- ===== FILTER ===== -->
        <div class="rounded border bg-white p-3 shadow-sm mb-4">
            <form method="GET">
                <div class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label class="form-label small fw-semibold">Tìm kiếm</label>
                        <input type="text" name="search" class="form-control" placeholder="Mã hoặc tên cấp độ"
                            value="{{ request('search') }}">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label small fw-semibold">Trạng thái</label>
                        <select name="status" class="form-select">
                            <option value="">-- Tất cả --</option>
                            <option value="1" @selected(request('status') === '1')>Hoạt động</option>
                            <option value="0" @selected(request('status') === '0')>Tắt</option>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label small fw-semibold">Sắp xếp</label>
                        <select name="sort" class="form-select">
                            <option value="display_order">Thứ tự</option>
                            <option value="target_score">Điểm</option>
                            <option value="created_at">Mới nhất</option>
                        </select>
                    </div>

                    <div class="col-md-3 d-flex gap-2">
                        <button class="btn btn-primary flex-grow-1">
                            <i class="fa-solid fa-magnifying-glass"></i> Tìm
                        </button>
                        <a href="{{ route('levels.index') }}" class="btn btn-secondary">
                            <i class="fa-solid fa-rotate-right"></i>
                        </a>
                    </div>
                </div>
            </form>
        </div>

        <!-- ===== TABLE ===== -->
        <div class="rounded border bg-white shadow-sm">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center" width="120">Mã</th>
                            <th>Tên cấp độ</th>
                            <th class="text-center">Màu</th>
                            <th class="text-center" width="140">Điểm</th>
                            <th class="text-center">Từ vựng</th>
                            <th class="text-center">Thứ tự</th>
                            <th class="text-center">Trạng thái</th>
                            <th class="text-center" width="140">Thao tác</th>
                            <th class="text-center" width="60">ID</th>
                            <th class="text-center" width="60"></th>

                        </tr>
                    </thead>

                    <tbody>
                        @forelse($levels as $index => $level)
                            <tr>
                                <td class="px-4 py-3 ">
                                    <span class="badge bg-secondary">{{ $level->level_code }}</span>
                                </td>
                                <td>
                                    <div class="fw-semibold">{{ $level->level_name }}</div>
                                    @if ($level->description)
                                        <small class="text-muted">
                                            {{ Str::limit($level->description, 50) }}
                                        </small>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($level->color)
                                        <span class="badge" style="background-color: {{ $level->color }}">
                                            {{ $level->color }}
                                        </span>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="text-center text-primary fw-semibold">
                                    {{ $level->target_score }}
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-info">{{ $level->total_words ?? 0 }}</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-dark">{{ $level->display_order }}</span>
                                </td>
                                <!-- Trạng thái -->
                                <td class="text-center">
                                    @if ($level->is_active)
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
                                        <a href="{{ route('levels.toggleStatus', $level->id) }}" title="Bật / Tắt"
                                            class="text-decoration-none">
                                            @if ($level->is_active)
                                                <i class="fa-solid fa-toggle-on text-success fs-5"></i>
                                            @else
                                                <i class="fa-solid fa-toggle-off text-danger fs-5"></i>
                                            @endif
                                        </a>
                                        <a href="{{ route('levels.edit', $level->id) }}"
                                            class="text-primary text-decoration-none">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                        <form action="{{ route('levels.destroy', $level->id) }}" method="POST"
                                            class="d-inline" onsubmit="return confirm('Bạn có chắc muốn xóa cấp độ này?')">
                                            @csrf @method('DELETE')
                                            <button class="text-danger text-decoration-none border-0 bg-transparent">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                                <td class="text-center px-4 py-3">
                                    {{ $level->id }}
                                </td>

                                <td class="px-4 py-3 text-center">
                                    <a href="{{ route('levels.show', $level->id) }}"
                                        class="text-primary text-decoration-none">
                                        Xem
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-5 text-muted">
                                    Chưa có cấp độ nào
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-3 border-top">
                {{ $levels->appends(request()->query())->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection
