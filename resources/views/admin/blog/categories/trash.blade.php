@extends('admin.layouts.app')

@section('title', 'Thùng rác danh mục')

@section('content')
    <div class="container-fluid">

        <div class="d-flex justify-content-between mb-4">
            <h1 class="h3">Thùng rác danh mục Blog</h1>
            <a href="{{ route('blog.categories.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Quay lại
            </a>
        </div>

        <div class="card">
            <div class="card-body table-responsive">

                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tên</th>
                            <th>Slug</th>
                            <th>Bài viết</th>
                            <th>Ngày xóa</th>
                            <th width="200">Thao tác</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->slug }}</td>
                                <td>
                                    <span class="badge bg-info">{{ $category->posts_count }}</span>
                                </td>
                                <td>{{ $category->deleted_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <form action="{{ route('blog.categories.restore', $category->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        <button class="btn btn-sm btn-success">
                                            <i class="fas fa-undo"></i> Khôi phục
                                        </button>
                                    </form>
                                    {{--
                                    <form action="{{ route('blog.categories.force-delete', $category->id) }}" method="POST"
                                        class="d-inline" onsubmit="return confirm('Xóa vĩnh viễn danh mục này?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i> Xóa vĩnh viễn
                                        </button>
                                    </form> --}}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">
                                    Không có danh mục nào trong thùng rác
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>

            </div>
        </div>

    </div>
@endsection
