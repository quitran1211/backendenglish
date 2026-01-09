<aside class="bg-dark text-white vh-100 p-3 position-sticky top-0 flex-shrink-0" style="width:260px;">
    <h5 class="text-center mb-4 fw-bold">ADMIN PANEL</h5>
    <ul class="nav nav-pills flex-column gap-2">
        <li>
            <a href="{{ route('admin.dashboard') }}"
                class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }} d-flex align-items-center gap-2">
                <i class="fa-solid fa-gauge"></i>
                Dashboard
            </a>
        </li>
        <li>
            <a href="{{ route('levels.index') }}"
                class="nav-link {{ request()->routeIs('course.*') ? 'active' : '' }} d-flex align-items-center gap-2">
                <i class="fa-solid fa-box"></i>
                Quản lý cấp độ
            </a>
        </li>
        <li>
            <a href="{{ route('lesson.index') }}"
                class="nav-link {{ request()->routeIs('course.*') ? 'active' : '' }} d-flex align-items-center gap-2">
                <i class="fa-solid fa-book"></i> Quản lý bài học
            </a>
        </li>
        <li>
            <a href="{{ route('vocabularies.index') }}"
                class="nav-link {{ request()->routeIs('post.*') ? 'active' : '' }} d-flex align-items-center gap-2">
                <i class="fa-solid fa-font"></i> Quản lý từ vựng
            </a>
        </li>
        <li>
            <a href="{{ route('quizzes.index') }}"
                class="nav-link {{ request()->routeIs('post.*') ? 'active' : '' }} d-flex align-items-center gap-2">
                <i class="fa-solid fa-circle-question"></i> Quản lý câu hỏi
            </a>
        </li>
        <li>
            <a href="{{ route('user.index') }}"
                class="nav-link {{ request()->routeIs('post.*') ? 'active' : '' }} d-flex align-items-center gap-2">
                <i class="fa-solid fa-user"></i> Quản lý người dùng
            </a>
        </li>
        <li>
            <a href="#"
                class="nav-link {{ request()->routeIs('theme.*') ? 'active' : '' }} d-flex align-items-center gap-2">
                <i class="fa-solid fa-palette"></i>
                Giao diện
            </a>
        </li>
    </ul>
</aside>
