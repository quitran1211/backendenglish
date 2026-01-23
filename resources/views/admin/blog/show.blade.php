@extends('admin.layouts.app')

@section('title', 'Chi tiết bài viết')

@section('content')
    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">📄 Chi tiết bài viết</h1>
            <div>
                <a href="{{ route('blog.edit', $post) }}" class="btn btn-primary">
                    <i class="fas fa-edit"></i> Chỉnh sửa
                </a>
                <a href="{{ route('blog.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Quay lại
                </a>
            </div>
        </div>

        <div class="row">

            {{-- Nội dung --}}
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-body">

                        <h2 class="fw-bold"> Tiêu đề: {{ $post->title }}</h2>

                        <div class="text-muted mb-3">
                            <i class="fas fa-user"></i> Tác giả: {{ $post->author->name }} |
                            <i class="fas fa-calendar"></i> {{ $post->created_at->format('d/m/Y') }} |
                            <i class="fas fa-eye"></i> {{ number_format($post->views) }} lượt xem
                        </div>

                        <p class="fw-bold"> Tóm tắt: {{ $post->excerpt }}</p>

                        <hr>

                        <div class="blog-content">
                            Nội dung: {!! nl2br(e($post->content)) !!}
                        </div>

                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="col-md-4">

                {{-- Ảnh --}}
                <div class="card mb-4">
                    <div class="card-header fw-bold">Ảnh đại diện</div>
                    <div class="card-body text-center">
                        @if ($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid rounded">
                        @else
                            <div class="text-muted">
                                <i class="fas fa-image fa-3x mb-2"></i>
                                <p>Không có ảnh</p>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Thông tin --}}
                <div class="card mb-4">
                    <div class="card-header fw-bold">Thông tin bài viết</div>
                    <div class="card-body">

                        <p><b>Danh mục:</b> {{ $post->category->name }}</p>

                        <p>
                            <b>Trạng thái:</b>
                            @if ($post->is_published)
                                <span class="badge bg-success">Đã xuất bản</span>
                            @else
                                <span class="badge bg-secondary">Nháp</span>
                            @endif
                        </p>

                        <p>
                            <b>Nổi bật:</b>
                            @if ($post->is_featured)
                                <span class="badge bg-warning">⭐ Có</span>
                            @else
                                <span class="badge bg-light text-dark">Không</span>
                            @endif
                        </p>

                        <p><b>Slug:</b> {{ $post->slug }}</p>
                        <p><b>Thời gian đọc:</b> {{ $post->read_time }}</p>

                    </div>
                </div>

                {{-- Tags --}}
                <div class="card">
                    <div class="card-header fw-bold">Tags</div>
                    <div class="card-body">
                        @forelse($post->tags as $tag)
                            <span class="badge bg-info mb-1">{{ $tag->name }}</span>
                        @empty
                            <span class="text-muted">Chưa có tag</span>
                        @endforelse
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
