{{-- ====================================
     resources/views/admin/blog/create.blade.php
     ==================================== --}}
@extends('admin.layouts.app')

@section('title', 'Tạo bài viết mới')

@section('content')
    <div class="container-fluid">
        <div class="mb-4">
            <h1 class="h3">Tạo bài viết mới</h1>
        </div>

        <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-8">
                    {{-- Title --}}
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Tiêu đề <span class="text-danger">*</span></label>
                                <input type="text" name="title"
                                    class="form-control form-control-lg @error('title') is-invalid @enderror"
                                    value="{{ old('title') }}" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Slug (URL)</label>
                                <input type="text" name="slug"
                                    class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug') }}"
                                    placeholder="Tự động tạo từ tiêu đề">
                                @error('slug')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Content --}}
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Tóm tắt <span class="text-danger">*</span></label>
                                <textarea name="excerpt" rows="3" class="form-control @error('excerpt') is-invalid @enderror" required>{{ old('excerpt') }}</textarea>
                                @error('excerpt')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Nội dung <span class="text-danger">*</span></label>
                                <textarea name="content" id="content" rows="15" class="form-control @error('content') is-invalid @enderror"
                                    required>{{ old('content') }}</textarea>
                                @error('content')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    {{-- Publish --}}
                    <div class="card mb-4">
                        <div class="card-header">
                            <h6 class="mb-0">Xuất bản</h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input type="checkbox" name="is_published" value="1" class="form-check-input"
                                        id="isPublished" {{ old('is_published') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="isPublished">
                                        Xuất bản ngay
                                    </label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Ngày xuất bản</label>
                                <input type="datetime-local" name="published_at" class="form-control"
                                    value="{{ old('published_at') }}">
                            </div>

                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input type="checkbox" name="is_featured" value="1" class="form-check-input"
                                        id="isFeatured" {{ old('is_featured') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="isFeatured">
                                        Đánh dấu nổi bật
                                    </label>
                                </div>
                            </div>

                            <hr>

                            <button type="submit" class="btn btn-primary w-100 mb-2">
                                <i class="fas fa-save"></i> Lưu bài viết
                            </button>
                            <a href="{{ route('blog.index') }}" class="btn btn-secondary w-100">
                                <i class="fas fa-times"></i> Hủy
                            </a>
                        </div>
                    </div>

                    {{-- Category --}}
                    <div class="card mb-4">
                        <div class="card-header">
                            <h6 class="mb-0">Danh mục</h6>
                        </div>
                        <div class="card-body">
                            <select name="category_id" class="form-select @error('category_id') is-invalid @enderror"
                                required>
                                <option value="">Chọn danh mục...</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Tags --}}
                    <div class="card mb-4">
                        <div class="card-header">
                            <h6 class="mb-0">Tags</h6>
                        </div>
                        <div class="card-body">
                            <select name="tags[]" class="form-select" multiple size="8">
                                @foreach ($tags as $tag)
                                    <option value="{{ $tag->id }}"
                                        {{ in_array($tag->id, old('tags', [])) ? 'selected' : '' }}>
                                        {{ $tag->name }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="text-muted">Giữ Ctrl để chọn nhiều tags</small>
                        </div>
                    </div>

                    {{-- Featured Image --}}
                    <div class="card mb-4">
                        <div class="card-header">
                            <h6 class="mb-0">Ảnh đại diện</h6>
                        </div>
                        <div class="card-body">
                            <input type="file" name="image"
                                class="form-control @error('image') is-invalid @enderror" accept="image/*"
                                id="imageInput">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <div id="imagePreview" class="mt-3" style="display: none;">
                                <img src="" alt="Preview" class="img-fluid rounded">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    @push('scripts')
        <script>
            // Preview image
            document.getElementById('imageInput').addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const preview = document.getElementById('imagePreview');
                        preview.querySelector('img').src = e.target.result;
                        preview.style.display = 'block';
                    }
                    reader.readAsDataURL(file);
                }
            });

            // Auto generate slug from title
            document.querySelector('input[name="title"]').addEventListener('input', function(e) {
                const slug = e.target.value
                    .toLowerCase()
                    .replace(/[àáạảãâầấậẩẫăằắặẳẵ]/g, 'a')
                    .replace(/[èéẹẻẽêềếệểễ]/g, 'e')
                    .replace(/[ìíịỉĩ]/g, 'i')
                    .replace(/[òóọỏõôồốộổỗơờớợởỡ]/g, 'o')
                    .replace(/[ùúụủũưừứựửữ]/g, 'u')
                    .replace(/[ỳýỵỷỹ]/g, 'y')
                    .replace(/đ/g, 'd')
                    .replace(/[^a-z0-9]+/g, '-')
                    .replace(/^-+|-+$/g, '');

                if (!document.querySelector('input[name="slug"]').value) {
                    document.querySelector('input[name="slug"]').value = slug;
                }
            });
        </script>
    @endpush
@endsection
