@extends('admin.layouts.app')

@section('title', 'Quản lý Người dùng')

@section('content')
    <div class="container-fluid p-4">

        <!-- ===== HEADER ===== -->
        <div class="d-flex align-items-center justify-content-between rounded border bg-white p-4 shadow-sm mb-4">
            <h2 class="h4 fw-semibold mb-0 text-dark">
                Quản lý Người dùng
            </h2>

            <div class="d-flex align-items-center gap-3">

                <!-- Thêm người dùng -->
                <a href="{{ route('user.create') }}"
                    class="d-inline-flex align-items-center gap-2 rounded
                      bg-primary px-4 py-2 text-white text-decoration-none
                      shadow-sm transition hover:bg-primary-dark">
                    <i class="fa-solid fa-plus"></i>
                    <span>Thêm người dùng</span>
                </a>

                <!-- Thùng rác -->
                <a href="{{ route('user.trash') }}"
                    class="d-inline-flex align-items-center gap-2 rounded
                      bg-danger px-4 py-2 text-white text-decoration-none
                      shadow-sm transition hover:bg-danger-dark">
                    <i class="fa-solid fa-trash"></i>
                    <span>Thùng rác</span>
                </a>
            </div>
        </div>


        <!-- ===== TABLE ===== -->
        <div class="rounded border bg-white shadow-sm overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr class="text-secondary">
                            <th class="px-4 py-3" style="width: 50px;">
                                <input type="checkbox" id="select-all" class="form-check-input">
                            </th>
                            <th class="px-4 py-3">Người dùng</th>
                            <th class="px-4 py-3">Username</th>
                            <th class="px-4 py-3">Vai trò</th>
                            <th class="px-4 py-3 text-center">Mức độ</th>
                            <th class="px-4 py-3 text-center">Điểm mục tiêu</th>
                            <th class="px-4 py-3 text-center">Loại TK</th>
                            <th class="px-4 py-3 text-center"></th>

                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($list as $item)
                            <tr class="hover-bg-light">
                                <td class="px-4 py-3">
                                    <input type="checkbox" class="form-check-input user-checkbox"
                                        value="{{ $item->id }}" {{ $item->id === auth()->id() ? 'disabled' : '' }}>
                                </td>

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

                                <td class="px-4 py-3 ">
                                    <span class="px-3 py-2 badge bg-primary bg-opacity-10 text-secondary">
                                        {{ $item->role }}
                                    </span>
                                </td>

                                <td class="px-4 py-3 text-center">
                                    @if ($item->currentLevel)
                                        <span class="badge {{ $item->currentLevel->badge_class }} px-3 py-2">
                                            {{ $item->currentLevel->level_name }}
                                        </span>
                                    @else
                                        <span class="text-muted">Chưa chọn</span>
                                    @endif
                                </td>

                                <td class="px-4 py-3 text-center">
                                    @if ($item->target_score)
                                        <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2">
                                            {{ $item->target_score }}
                                        </span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>

                                <!-- Chức năng -->
                                <td class="px-4 py-3 text-center">
                                    <div class="d-inline-flex align-items-center gap-2">

                                        <!-- View Progress -->
                                        <a href="{{ route('user.progress', $item->id) }}"
                                            class="text-info text-decoration-none transition-transform hover-scale"
                                            title="Tiến độ học tập">
                                            <i class="fa-solid fa-chart-line"></i>
                                        </a>

                                        <!-- Edit -->
                                        <a href="{{ route('user.edit', $item->id) }}"
                                            class="text-primary text-decoration-none transition-transform hover-scale"
                                            title="Chỉnh sửa">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>

                                        <!-- Delete -->
                                        <a href="{{ route('user.delete', $item->id) }}"
                                            class="text-danger text-decoration-none transition-transform hover-scale"
                                            title="Xóa" onclick="return confirm('Bạn có chắc muốn xóa người dùng này?')">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>

                                    </div>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <!-- View -->
                                    <a href="{{ route('user.show', $item->id) }}" class="text-primary text-decoration-none"
                                        title="Xem chi tiết">
                                        Xem
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-5 text-muted">
                                    <i class="fa-solid fa-users fs-1 mb-3 d-block"></i>
                                    <p class="mb-0">Chưa có người dùng nào</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Bulk Actions & Pagination -->
            <div class="border-top p-4">
                <div class="row align-items-center">
                    <div class="col-md-6 d-flex justify-content-end">
                        {{ $list->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            .hover-scale:hover {
                transform: scale(1.1);
            }

            .hover-underline:hover {
                text-decoration: underline !important;
            }

            .hover-bg-light:hover {
                background-color: rgba(0, 0, 0, 0.02) !important;
            }

            .bg-primary-dark:hover {
                background-color: #0b5ed7 !important;
            }

            .bg-danger-dark:hover {
                background-color: #bb2d3b !important;
            }

            .badge-danger {
                background-color: #f8d7da !important;
                color: #842029 !important;
            }

            .badge-warning {
                background-color: #fff3cd !important;
                color: #664d03 !important;
            }

            .badge-primary {
                background-color: #cfe2ff !important;
                color: #084298 !important;
            }
        </style>
    @endpush
@endsection
