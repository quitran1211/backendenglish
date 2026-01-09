@extends('admin.layouts.app')

@section('title', 'Thêm Người dùng mới')

@section('content')
    <div class="container-fluid p-4">

        <!-- ===== HEADER ===== -->
        <div class="d-flex align-items-center justify-content-between rounded border bg-white p-4 shadow-sm mb-4">
            <h2 class="h4 fw-semibold mb-0 text-dark">
                Thêm Người dùng mới
            </h2>

            <a href="{{ route('user.index') }}"
                class="d-inline-flex align-items-center gap-2 rounded
                  bg-secondary px-4 py-2 text-white text-decoration-none
                  shadow-sm transition">
                <i class="fa-solid fa-arrow-left"></i>
                <span>Quay lại</span>
            </a>
        </div>

        <!-- ===== FORM ===== -->
        <div class="rounded border bg-white p-4 shadow-sm">
            <form method="POST" action="{{ route('user.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="row g-4">

                    <!-- Email -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            Email <span class="text-danger">*</span>
                        </label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email') }}" placeholder="example@email.com" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Username -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            Username <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror"
                            value="{{ old('username') }}" placeholder="username123" required>
                        <small class="text-muted">Chỉ chữ cái, số và dấu gạch dưới</small>
                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            Mật khẩu <span class="text-danger">*</span>
                        </label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                            placeholder="Tối thiểu 8 ký tự" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password Confirmation -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            Xác nhận mật khẩu <span class="text-danger">*</span>
                        </label>
                        <input type="password" name="password_confirmation" class="form-control"
                            placeholder="Nhập lại mật khẩu" required>
                    </div>

                    <!-- Full Name -->
                    <div class="col-md-12">
                        <label class="form-label fw-semibold">Họ và tên</label>
                        <input type="text" name="full_name" class="form-control @error('full_name') is-invalid @enderror"
                            value="{{ old('full_name') }}" placeholder="Nguyễn Văn A">
                        @error('full_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Role -->
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">
                            Vai trò <span class="text-danger">*</span>
                        </label>
                        <select name="role" class="form-select @error('role') is-invalid @enderror" required>
                            <option value="">-- Chọn vai trò --</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Quản trị viên</option>
                            <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>Người dùng</option>
                        </select>
                        @error('role')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Current Level -->
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Mức độ hiện tại</label>
                        <select name="current_level_id" class="form-select @error('current_level_id') is-invalid @enderror">
                            <option value="">-- Chọn mức độ --</option>
                            @foreach ($levels as $level)
                                <option value="{{ $level->id }}"
                                    {{ old('current_level_id') == $level->id ? 'selected' : '' }}>
                                    {{ $level->level_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('current_level_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Target Score -->
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Điểm TOEIC mục tiêu</label>
                        <input type="number" name="target_score"
                            class="form-control @error('target_score') is-invalid @enderror"
                            value="{{ old('target_score') }}" min="0" max="990" step="5"
                            placeholder="VD: 650">
                        @error('target_score')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Buttons -->
                    <div class="col-md-12">
                        <div class="d-flex gap-2 justify-content-end">
                            <a href="{{ route('user.index') }}" class="btn btn-secondary px-4">
                                <i class="fa-solid fa-xmark"></i> Hủy
                            </a>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fa-solid fa-check"></i> Thêm người dùng
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            // Avatar preview
            document.getElementById('avatar-input')?.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('avatar-preview').src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            });
        </script>
    @endpush
@endsection
