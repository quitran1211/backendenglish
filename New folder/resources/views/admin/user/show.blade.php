@extends('admin.layouts.app')

@section('title', 'Chi tiết Người dùng')

@section('content')
    <div class="container-fluid p-4">

        <!-- ===== HEADER ===== -->
        <div class="d-flex align-items-center justify-content-between rounded border bg-white p-4 shadow-sm mb-4">
            <h2 class="h4 fw-semibold mb-0 text-dark">
                Chi tiết Người dùng
            </h2>

            <div class="d-flex gap-2">
                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary">
                    <i class="fa-solid fa-pen-to-square"></i> Chỉnh sửa
                </a>
                <a href="{{ route('user.index') }}" class="btn btn-secondary">
                    <i class="fa-solid fa-arrow-left"></i> Quay lại
                </a>
            </div>
        </div>

        <div class="row g-4">
            <!-- Left Column - Info -->
            <div class="col-lg-8">
                <!-- Thông tin cá nhân -->
                <div class="rounded border bg-white p-4 shadow-sm mb-4">
                    <h5 class="fw-bold mb-4">Thông tin cá nhân</h5>

                    <div class="row">
                        <!-- Avatar -->
                        <div class="col-md-3 text-center mb-4">
                            <img src="{{ $user->avatar }}" alt="{{ $user->full_name }}" class="rounded-circle mb-3"
                                style="width: 120px; height: 120px; object-fit: cover; border: 3px solid #ddd;">
                            <div>
                                <span class="badge {{ $user->role_badge_class }} px-3 py-2">
                                    {{ $user->role_text }}
                                </span>
                            </div>
                        </div>

                        <!-- Info -->
                        <div class="col-md-9">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <span class="text-muted d-block mb-1">Họ và tên:</span>
                                        <span class="fw-semibold">{{ $user->full_name ?? 'Chưa cập nhật' }}</span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <span class="text-muted d-block mb-1">Email:</span>
                                        <span class="fw-semibold">{{ $user->email }}</span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <span class="text-muted d-block mb-1">Username:</span>
                                        <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-2">
                                            {{ $user->username }}
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <span class="text-muted d-block mb-1">Mức độ hiện tại:</span>
                                        @if ($user->currentLevel)
                                            <span class="badge {{ $user->currentLevel->badge_class }} px-3 py-2">
                                                {{ $user->currentLevel->level_name }}
                                            </span>
                                        @else
                                            <span class="text-muted">Chưa chọn</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <span class="text-muted d-block mb-1">Điểm mục tiêu:</span>
                                        <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2">
                                            {{ $user->target_score ?? 'Chưa đặt' }}
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <span class="text-muted d-block mb-1">Ngày tham gia:</span>
                                        <span
                                            class="fw-semibold">{{ $user->created_at ? $user->created_at->format('d/m/Y') : 'Chưa cập nhật' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Reset Password Modal -->
        <div class="modal fade" id="resetPasswordModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST" action="{{ route('user.resetPassword', $user->id) }}">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title">Đặt lại mật khẩu</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Mật khẩu mới</label>
                                <input type="password" name="new_password" class="form-control" required minlength="8">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Xác nhận mật khẩu</label>
                                <input type="password" name="new_password_confirmation" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                            <button type="submit" class="btn btn-primary">Đặt lại mật khẩu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection
