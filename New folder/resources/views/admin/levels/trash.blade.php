@extends('admin.layouts.app')

@section('title', 'Thùng rác - Cấp độ')

@section('content')
    <div class="container-fluid p-4">

        <!-- ===== HEADER ===== -->
        <div class="d-flex align-items-center justify-content-between rounded border bg-white p-4 shadow-sm mb-4">
            <div>
                <h2 class="h4 fw-semibold mb-1 text-dark">
                    <i class="fa-solid fa-trash text-danger"></i> Thùng rác - Cấp độ
                </h2>
                <p class="text-muted mb-0 small">Tổng cộng: {{ $levels->total() }} mục đã xóa</p>
            </div>

            <div class="d-flex gap-2">
                <form action="{{ route('levels.trash.empty') }}" method="POST"
                    onsubmit="return confirm('Bạn có chắc muốn xóa vĩnh viễn TẤT CẢ các mục trong thùng rác?')">
                    @csrf
                    <button type="submit" class="btn btn-danger">
                        <i class="fa-solid fa-trash-can"></i> Xóa tất cả
                    </button>
                </form>
                <a href="{{ route('levels.index') }}" class="btn btn-secondary">
                    <i class="fa-solid fa-arrow-left"></i> Quay lại
                </a>
            </div>
        </div>

        <!-- ===== ALERT MESSAGES ===== -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fa-solid fa-circle-exclamation"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- ===== TABLE ===== -->
        <div class="rounded border bg-white shadow-sm">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th width="80">STT</th>
                            <th width="120">Mã cấp độ</th>
                            <th>Tên cấp độ</th>
                            <th width="120" class="text-center">Điểm mục tiêu</th>
                            <th width="120" class="text-center">Tổng từ vựng</th>
                            <th width="180" class="text-center">Ngày xóa</th>
                            <th width="180" class="text-center">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($levels as $index => $level)
                            <tr class="opacity-75">
                                <td>{{ $levels->firstItem() + $index }}</td>
                                <td>
                                    <span class="badge bg-secondary">{{ $level->level_code }}</span>
                                </td>
                                <td>
                                    <div class="fw-semibold">{{ $level->level_name }}</div>
                                    @if ($level->description)
                                        <small class="text-muted">{{ Str::limit($level->description, 50) }}</small>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <strong class="text-primary">{{ $level->target_score }}</strong>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-info">{{ $level->total_words ?? 0 }}</span>
                                </td>
                                <td class="text-center">
                                    <small class="text-muted">
                                        <i class="fa-solid fa-calendar"></i>
                                        {{ $level->deleted_at->format('d/m/Y H:i') }}
                                        <br>
                                        <span class="badge bg-light text-dark">
                                            {{ $level->deleted_at->diffForHumans() }}
                                        </span>
                                    </small>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex gap-2 justify-content-center">
                                        <form action="{{ route('levels.restore', $level->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success" title="Khôi phục"
                                                onclick="return confirm('Bạn có muốn khôi phục cấp độ này?')">
                                                <i class="fa-solid fa-rotate-left"></i> Khôi phục
                                            </button>
                                        </form>
                                        <form action="{{ route('levels.force-delete', $level->id) }}" method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Bạn có chắc muốn xóa VĨNH VIỄN cấp độ này? Hành động này không thể hoàn tác!')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Xóa vĩnh viễn">
                                                <i class="fa-solid fa-trash-can"></i> Xóa vĩnh viễn
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
                                    <i class="fa-solid fa-inbox fa-3x mb-3 d-block"></i>
                                    <p class="mb-0">Thùng rác trống</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="p-3 border-top">
                {{ $levels->links() }}
            </div>
        </div>

        <!-- Info Box -->
        <div class="alert alert-info mt-4">
            <i class="fa-solid fa-circle-info"></i>
            <strong>Lưu ý:</strong>
            Các mục trong thùng rác sẽ được xóa vĩnh viễn sau 30 ngày.
            Bạn có thể khôi phục hoặc xóa vĩnh viễn trước thời hạn đó.
        </div>
    </div>
@endsection
