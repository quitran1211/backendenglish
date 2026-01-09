@extends('admin.layouts.app')

@section('title', 'Chi tiết Cấp độ')

@section('content')
    <div class="container-fluid p-4">

        <!-- HEADER -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-semibold mb-0">Chi tiết Cấp độ</h4>
            <a href="{{ route('levels.index') }}" class="btn btn-secondary btn-sm">
                Quay lại
            </a>
        </div>

        <!-- BASIC INFO -->
        <div class="card mb-4">
            <div class="card-header fw-semibold">
                Thông tin cấp độ
            </div>
            <div class="card-body">
                <div class="row g-3 align-items-center">
                    <div class="col-md-3">
                        <label class="text-muted small">Mã cấp độ</label>
                        <div class="fw-semibold">{{ $level->level_code }}</div>
                    </div>

                    <div class="col-md-3">
                        <label class="text-muted small">Tên cấp độ</label>
                        <div class="fw-semibold">{{ $level->level_name }}</div>
                    </div>

                    <div class="col-md-3">
                        <label class="text-muted small">Trạng thái</label>
                        <div>
                            <span class="badge {{ $level->is_active ? 'bg-success' : 'bg-secondary' }}">
                                {{ $level->is_active ? 'Hoạt động' : 'Tạm tắt' }}
                            </span>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label class="text-muted small">Điểm mục tiêu</label>
                        <div>{{ $level->target_score }}</div>
                    </div>

                    <div class="col-md-3">
                        <label class="text-muted small">Tổng từ vựng</label>
                        <div>{{ $level->total_words ?? 0 }}</div>
                    </div>

                    <div class="col-md-3">
                        <label class="text-muted small">Thứ tự hiển thị</label>
                        <div>{{ $level->display_order ?? 0 }}</div>
                    </div>

                    <div class="col-md-3">
                        <label class="text-muted small">Màu sắc</label>
                        <div>
                            @if ($level->color)
                                <span class="badge text-white" style="background-color: {{ $level->color }}">
                                    {{ $level->color }}
                                </span>
                            @else
                                -
                            @endif
                        </div>
                    </div>

                    @if ($level->description)
                        <div class="col-12">
                            <label class="text-muted small">Mô tả</label>
                            <div class="border rounded p-2 bg-light">
                                {{ $level->description }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- LESSON LIST -->
        <div class="card mb-4">
            <div class="card-header fw-semibold">
                Danh sách bài học ({{ $level->lessons->count() }})
            </div>
            <div class="card-body p-0">
                @if ($level->lessons->isNotEmpty())
                    <div class="table-responsive">
                        <table class="table table-sm table-hover mb-0 text-center align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th width="60">#</th>
                                    <th class="text-start">Tiêu đề</th>
                                    <th width="120">Từ vựng</th>
                                    <th width="120">Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($level->lessons as $index => $lesson)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td class="text-start">{{ $lesson->title }}</td>
                                        <td>{{ $lesson->vocabularies_count ?? 0 }}</td>
                                        <td>
                                            <span class="badge {{ $lesson->is_active ? 'bg-success' : 'bg-secondary' }}">
                                                {{ $lesson->is_active ? 'Hoạt động' : 'Tắt' }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="p-3 text-muted text-center">
                        Chưa có bài học nào.
                    </div>
                @endif
            </div>
        </div>

        <!-- ACTIONS -->
        <div class="d-flex gap-2">
            <a href="{{ route('levels.edit', $level->id) }}" class="btn btn-primary">
                Chỉnh sửa
            </a>

            <form action="{{ route('levels.toggleStatus', $level->id) }}" method="POST">
                @csrf
                <button class="btn {{ $level->is_active ? 'btn-warning' : 'btn-success' }}">
                    {{ $level->is_active ? 'Tắt kích hoạt' : 'Kích hoạt' }}
                </button>
            </form>

            <form action="{{ route('levels.destroy', $level->id) }}" method="POST"
                onsubmit="return confirm('Xóa cấp độ này?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger">
                    Xóa
                </button>
            </form>
        </div>

    </div>
@endsection
