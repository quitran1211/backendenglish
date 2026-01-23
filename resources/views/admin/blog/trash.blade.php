@extends('admin.layouts.app')

@section('title', 'Thùng rác Blog')

@section('content')
    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">🗑 Thùng rác Blog</h1>
            <a href="{{ route('blog.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Quay lại
            </a>
        </div>

        <div class="card">
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>Tiêu đề</th>
                                <th>Danh mục</th>
                                <th>Tác giả</th>
                                <th>Ngày xóa</th>
                                <th width="200">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($posts as $post)
                                <tr>
                                    <td>
                                        <b>{{ $post->title }}</b><br>
                                        <small class="text-muted">{{ $post->slug }}</small>
                                    </td>
                                    <td>{{ $post->category->name }}</td>
                                    <td>{{ $post->author->name }}</td>
                                    <td>{{ $post->deleted_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <div class="btn-group btn-group-sm">

                                            {{-- Restore --}}
                                            <form action="{{ route('blog.restore', $post->id) }}" method="POST">
                                                @csrf
                                                <button class="btn btn-success" title="Khôi phục">
                                                    <i class="fas fa-undo"></i>
                                                </button>
                                            </form>

                                            {{-- Force Delete --}}
                                            <form action="{{ route('blog.force-delete', $post->id) }}" method="POST"
                                                onsubmit="return confirm('Xóa vĩnh viễn bài viết này?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger" title="Xóa vĩnh viễn">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">
                                        <i class="fas fa-inbox fa-3x mb-2"></i>
                                        <p>Thùng rác trống</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $posts->links() }}
                </div>

            </div>
        </div>

    </div>
@endsection
