{{-- ====================================
     resources/views/admin/blog/index.blade.php
     ==================================== --}}
@extends('admin.layouts.app')

@section('title', 'Quản lý Blog')

@section('content')
    <div class="container-fluid">
        <!-- ===== HEADER ===== -->
        <div class="d-flex align-items-center justify-content-between rounded border bg-white p-4 shadow-sm mb-4">
            <h2 class="h4 fw-semibold mb-0 text-dark">
                Quản lý blog
            </h2>

            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('blog.create') }}"
                    class="d-inline-flex align-items-center gap-2 rounded bg-primary px-4 py-2 text-white text-decoration-none shadow-sm">
                    <i class="fa-solid fa-plus"></i>
                    <span>Thêm bài viết mới</span>
                </a>

                <a href="{{ route('blog.trash') }}"
                    class="d-inline-flex align-items-center gap-2 rounded bg-danger px-4 py-2 text-white text-decoration-none shadow-sm">
                    <i class="fa-solid fa-trash"></i>
                    <span>Thùng rác</span>
                </a>
            </div>
        </div>

        {{-- Filters --}}
        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('blog.index') }}" method="GET" class="row g-3">
                    <div class="col-md-3">
                        <input type="text" name="search" class="form-control" placeholder="Tìm kiếm..."
                            value="{{ request('search') }}">
                    </div>
                    <div class="col-md-2">
                        <select name="category" class="form-select">
                            <option value="">Tất cả danh mục</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="status" class="form-select">
                            <option value="">Tất cả trạng thái</option>
                            <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Đã xuất bản
                            </option>
                            <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Nháp</option>
                            <option value="featured" {{ request('status') == 'featured' ? 'selected' : '' }}>Nổi bật
                            </option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="sort_by" class="form-select">
                            <option value="created_at">Ngày tạo</option>
                            <option value="published_at" {{ request('sort_by') == 'published_at' ? 'selected' : '' }}>Ngày
                                xuất bản</option>
                            <option value="views" {{ request('sort_by') == 'views' ? 'selected' : '' }}>Lượt xem</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-filter"></i> Lọc
                        </button>
                        <a href="{{ route('blog.index') }}" class="btn btn-secondary">
                            <i class="fas fa-redo"></i> Reset
                        </a>
                    </div>
                </form>
            </div>
        </div>

        {{-- Bulk Actions --}}
        <form action="{{ route('blog.bulk') }}" method="POST" id="bulkForm">
            @csrf
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex gap-2">
                        <select name="action" class="form-select w-auto">
                            <option value="">Chọn hành động...</option>
                            <option value="publish">Xuất bản</option>
                            <option value="unpublish">Hủy xuất bản</option>
                            <option value="feature">Đánh dấu nổi bật</option>
                            <option value="unfeature">Bỏ nổi bật</option>
                            <option value="delete">Xóa</option>
                        </select>
                        <button type="submit" class="btn btn-primary">Thực hiện</button>
                        <span class="ms-auto text-muted" id="selectedCount">0 mục được chọn</span>
                    </div>
                </div>
            </div>

            {{-- Posts Table --}}
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th width="30">
                                        <input type="checkbox" id="selectAll">
                                    </th>
                                    <th width="80">Ảnh</th>
                                    <th>Tiêu đề</th>
                                    <th>Danh mục</th>
                                    <th>Tác giả</th>
                                    <th>Trạng thái</th>
                                    <th>Lượt xem</th>
                                    <th>Ngày</th>
                                    <th width="150">Thao tác</th>
                                    <th>ID</th>
                                    <th></th>


                                </tr>
                            </thead>
                            <tbody>
                                @forelse($posts as $post)
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="ids[]" value="{{ $post->id }}"
                                                class="select-item">
                                        </td>
                                        <td>
                                            @if ($post->image)
                                                <img src="{{ asset('storage/' . $post->image) }}" alt=""
                                                    class="img-thumbnail"
                                                    style="width: 60px; height: 60px; object-fit: cover;">
                                            @else
                                                <div class="bg-light d-flex align-items-center justify-content-center"
                                                    style="width: 60px; height: 60px;">
                                                    <i class="fas fa-image text-muted"></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="fw-bold">{{ $post->title }}</div>
                                            <small class="text-muted">{{ Str::limit($post->excerpt, 60) }}</small>
                                            @if ($post->is_featured)
                                                <span class="badge bg-warning ms-1">⭐ Nổi bật</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge bg-info">{{ $post->category->name }}</span>
                                        </td>
                                        <td>{{ $post->author->username }}</td>
                                        <td>
                                            @if ($post->is_published)
                                                <span class="badge bg-success">Đã xuất bản</span>
                                            @else
                                                <span class="badge bg-secondary">Nháp</span>
                                            @endif
                                        </td>
                                        <td>
                                            <i class="fas fa-eye"></i> {{ number_format($post->views) }}
                                        </td>
                                        <td>
                                            <small>{{ $post->created_at->format('d/m/Y') }}</small>
                                        </td>
                                        <td>
                                            <div class="d-inline-flex align-items-center gap-2">
                                                <a href="{{ route('blog.edit', $post) }}"
                                                    class="text-primary text-decoration-none" title="Sửa">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="{{ route('blog.toggle-published', $post) }}" title="Bật / Tắt"
                                                    class="text-decoration-none">
                                                    @if ($post->is_published)
                                                        <i class="fa-solid fa-toggle-on text-success fs-5"></i>
                                                    @else
                                                        <i class="fa-solid fa-toggle-off text-danger fs-5"></i>
                                                    @endif
                                                </a>
                                                <form action="{{ route('blog.destroy', $post) }}" method="POST"
                                                    class="d-inline" onsubmit="return confirm('Xác nhận xóa?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button
                                                        class="text-danger text-decoration-none border-0 bg-transparent">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </form>

                                            </div>
                                        </td>
                                        <td>
                                            {{ $post->id }}

                                        </td>
                                        <td>
                                            <a href="{{ route('blog.show', $post->id) }}"
                                                class="text-primary text-decoration-none">
                                                Xem
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center py-4">
                                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                            <p class="text-muted">Chưa có bài viết nào</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </form>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const selectAll = document.getElementById('selectAll');
                const selectItems = document.querySelectorAll('.select-item');
                const selectedCount = document.getElementById('selectedCount');

                function updateCount() {
                    const checked = document.querySelectorAll('.select-item:checked').length;
                    selectedCount.textContent = checked + ' mục được chọn';
                }

                selectAll.addEventListener('change', function() {
                    selectItems.forEach(item => item.checked = this.checked);
                    updateCount();
                });

                selectItems.forEach(item => {
                    item.addEventListener('change', updateCount);
                });
            });
        </script>
    @endpush
@endsection
