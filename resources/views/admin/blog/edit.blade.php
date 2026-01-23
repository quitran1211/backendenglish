@extends('admin.layouts.app')

@section('title', 'Chỉnh sửa bài viết')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">Chỉnh sửa bài viết</h1>
            <a href="{{ route('blog.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Quay lại
            </a>
        </div>

        <form action="{{ route('blog.update', $post) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                {{-- Nội dung --}}
                <div class="col-md-8">
                    <div class="card mb-4">
                        <div class="card-header fw-bold">Nội dung bài viết</div>
                        <div class="card-body">

                            <div class="mb-3">
                                <label class="form-label">Tiêu đề</label>
                                <input type="text" name="title" class="form-control" value="{{ $post->title }}"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Slug</label>
                                <input type="text" name="slug" class="form-control" value="{{ $post->slug }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Mô tả ngắn</label>
                                <textarea name="excerpt" rows="3" class="form-control" required>{{ $post->excerpt }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Nội dung</label>
                                <textarea name="content" rows="10" class="form-control" required>{{ $post->content }}</textarea>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- Sidebar --}}
                <div class="col-md-4">

                    {{-- Xuất bản --}}
                    <div class="card mb-4">
                        <div class="card-header fw-bold">Trạng thái</div>
                        <div class="card-body">

                            <div class="form-check mb-2">
                                <input type="checkbox" name="is_published" value="1" class="form-check-input"
                                    {{ $post->is_published ? 'checked' : '' }}>
                                <label class="form-check-label">Xuất bản</label>
                            </div>

                            <div class="form-check mb-2">
                                <input type="checkbox" name="is_featured" value="1" class="form-check-input"
                                    {{ $post->is_featured ? 'checked' : '' }}>
                                <label class="form-check-label">Nổi bật</label>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-save"></i> Cập nhật
                            </button>
                        </div>
                    </div>

                    {{-- Danh mục --}}
                    <div class="card mb-4">
                        <div class="card-header fw-bold">Danh mục</div>
                        <div class="card-body">
                            <select name="category_id" class="form-select" required>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $post->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Tags --}}
                    <div class="card mb-4">
                        <div class="card-header fw-bold">Tags</div>
                        <div class="card-body">
                            <select name="tags[]" class="form-select" multiple>
                                @foreach ($tags as $tag)
                                    <option value="{{ $tag->id }}"
                                        {{ $post->tags->contains($tag->id) ? 'selected' : '' }}>
                                        {{ $tag->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Ảnh --}}
                    <div class="card mb-4">
                        <div class="card-header fw-bold">Ảnh đại diện</div>
                        <div class="card-body">
                            @if ($post->image)
                                <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid mb-2 rounded">
                            @endif
                            <input type="file" name="image" class="form-control">
                        </div>
                    </div>

                </div>
            </div>

        </form>
    </div>
@endsection
