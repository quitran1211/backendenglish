@extends('admin.layouts.app')

@section('title', 'Thùng rác - Người dùng')

@section('content')
    <div class="container-fluid p-4">

        <!-- ===== HEADER ===== -->
        <div class="d-flex align-items-center justify-content-between rounded border bg-white p-4 shadow-sm mb-4">
            <h2 class="h4 fw-semibold mb-0 text-dark">
                <i class="fa-solid fa-trash text-danger"></i> Thùng rác - Người dùng
            </h2>

            <a href="{{ route('user.index') }}"
                class="d-inline-flex align-items-center gap-2 rounded
                  bg-secondary px-4 py-2 text-white text-decoration-none
                  shadow-sm transition">
                <i class="fa-solid fa-arrow-left"></i>
                <span>Quay lại</span>
            </a>
        </div>

        <!-- ===== TABLE ===== -->
        <div class="rounded border bg-white shadow-sm overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr class="text-secondary">
                            <th class="px-4 py-3">Người dùng</th>
                            <th class="px-4 py-3">Username</th>
                            <th class="px-4 py-3">Vai trò</th>
                            <th class="px-4 py-3 text-center">Mức độ</th>
                            <th class="px-4 py-3 text-center">Loại TK</th>
                            <th class="px-4 py-3 text-center">Ngày xóa</th>
                            <th class="px-4 py-3 text-center">Chức năng</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($list as $item)
                            <tr class="hover-bg-light">
                                <td class="px-4 py-3">
                                    <div class="d-flex align-items-center gap-3">
                                        <img src="{{ $item->avatar }}" alt="{{ $item->full_name }}" class="rounded-circle"
                                            style="width: 40px; height: 40px; object-fit: cover;">
                                        <div>
                                            <div class="fw-medium">{{ $item->full_name ?? 'Chưa cập nhật' }}</div>
                                            <small class="text-muted">{{ $item->email }}</small>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-4 py-3">
                                    <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-2">
                                        {{ $item->username }}
                                    </span>
                                </td>

                                <td class="px-4 py-3">
                                    <span class="badge {{ $item->role_badge_class }} px-3 py-2">
                                        {{ $item->role }}
                                    </span>
                                </td>

                                <td class="px-4 py-3 text-center">
                                    @if ($item->currentLevel)
                                        <span class="badge {{ $item->currentLevel->badge_class }} px-3 py-2">
                                            {{ $item->currentLevel->level_name }}
                                        </span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>

                                <td class="px-4 py-3 text-center text-muted">
                                    {{ $item->deleted_at ? $item->deleted_at->format('d/m/Y') : 'Chưa cập nhật' }}

                                </td>

                                <!-- Chức năng -->
                                <td class="px-4 py-3 text-center">
                                    <div class="d-inline-flex align-items-center gap-3">
                                        <!-- Restore -->
                                        <form method="POST" action="{{ route('user.restore', $item->id) }}"
                                            style="display: inline;">
                                            @csrf
                                            <button type="submit"
                                                class="btn btn-link text-success text-decoration-none p-0 transition-transform hover-scale"
                                                title="Khôi phục"
                                                onclick="return confirm('Bạn có chắc muốn khôi phục người dùng này?')">
                                                <i class="fa-solid fa-rotate-left"></i>
                                            </button>
                                        </form>

                                        <!-- Force Delete -->
                                        <form method="POST" action="{{ route('user.destroy', $item->id) }}"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-link text-danger text-decoration-none p-0 transition-transform hover-scale"
                                                title="Xóa vĩnh viễn"
                                                onclick="return confirm('Bạn có chắc muốn xóa vĩnh viễn người dùng này?')">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    Không có người dùng nào trong thùng rác.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination (nếu có) -->
            @if ($list->hasPages())
                <div class="p-3 border-top d-flex justify-content-end">
                    {{ $list->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
