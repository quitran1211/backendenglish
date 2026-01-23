<aside class="bg-dark text-white vh-100 p-3 position-sticky top-0 flex-shrink-0" style="width:260px;">
    <h5 class="text-center mb-4 fw-bold">ADMIN PANEL</h5>

    <ul class="nav nav-pills flex-column gap-2">

        {{-- Dashboard --}}
        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}"
                class="nav-link d-flex align-items-center gap-2
               {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-gauge"></i>
                Dashboard
            </a>
        </li>

        {{-- Cấp độ --}}
        <li class="nav-item">
            <a href="{{ route('levels.index') }}"
                class="nav-link d-flex align-items-center gap-2
               {{ request()->routeIs('levels.*') ? 'active' : '' }}">
                <i class="fa-solid fa-box"></i>
                Quản lý cấp độ
            </a>
        </li>

        {{-- Bài học --}}
        <li class="nav-item">
            <a href="{{ route('lesson.index') }}"
                class="nav-link d-flex align-items-center gap-2
               {{ request()->routeIs('lesson.*') ? 'active' : '' }}">
                <i class="fa-solid fa-book"></i>
                Quản lý bài học
            </a>
        </li>

        {{-- Từ vựng --}}
        <li class="nav-item">
            <a href="{{ route('vocabularies.index') }}"
                class="nav-link d-flex align-items-center gap-2
               {{ request()->routeIs('vocabularies.*') ? 'active' : '' }}">
                <i class="fa-solid fa-font"></i>
                Quản lý từ vựng
            </a>
        </li>

        {{-- Câu hỏi --}}
        <li class="nav-item">
            <a href="{{ route('exercises.index') }}"
                class="nav-link d-flex align-items-center gap-2
               {{ request()->routeIs('exercises.*') ? 'active' : '' }}">
                <i class="fa-solid fa-circle-question"></i>
                Quản lý luyện tập
            </a>
        </li>

        {{-- BLOG (MENU CHA + SỔ) --}}
        <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2
               {{ request()->routeIs('blog.*') ? 'active' : '' }}"
                data-bs-toggle="collapse" href="#blogMenu" role="button"
                aria-expanded="{{ request()->routeIs('blog.*') ? 'true' : 'false' }}">
                <i class="fa-solid fa-blog"></i>
                Quản lý blog
                <i class="fa-solid fa-chevron-down ms-auto"></i>
            </a>

            <ul class="collapse nav flex-column ms-4 mt-1
                {{ request()->routeIs('blog.*') ? 'show' : '' }}"
                id="blogMenu">

                <li class="nav-item">
                    <a href="{{ route('blog.index') }}"
                        class="nav-link text-white-50
                       {{ request()->routeIs('blog.index') ? 'active' : '' }}">
                        Blog
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('blog.categories.index') }}"
                        class="nav-link text-white-50
                       {{ request()->routeIs('blog.categories.index') ? 'active' : '' }}">
                        Danh mục
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('blog.tags.index') }}"
                        class="nav-link text-white-50
                       {{ request()->routeIs('blog.tags.index') ? 'active' : '' }}">
                        Tags
                    </a>
                </li>
            </ul>
        </li>

        {{-- Người dùng --}}
        <li class="nav-item">
            <a href="{{ route('user.index') }}"
                class="nav-link d-flex align-items-center gap-2
               {{ request()->routeIs('user.*') ? 'active' : '' }}">
                <i class="fa-solid fa-user"></i>
                Quản lý người dùng
            </a>
        </li>


    </ul>
</aside>
