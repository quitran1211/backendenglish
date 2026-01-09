<header class="navbar navbar-light bg-white shadow-sm px-4  position-sticky top-0">
    <span class="navbar-brand fw-semibold">Dashboard</span>

    <div class="d-flex align-items-center gap-3">
        <span class="text-secondary">
            <i class="fa-solid fa-user"></i>
            {{ Auth::guard('admin')->user()->username }}
        </span>
        <a href="{{ route('admin.logout') }}" class="btn btn-outline-danger btn-sm">
            <i class="fa-solid fa-right-from-bracket"></i> Đăng xuất
        </a>
    </div>
</header>
