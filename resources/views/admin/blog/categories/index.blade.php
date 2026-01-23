@extends('admin.layouts.app')

@section('title', 'Danh mục Blog')

@section('content')
    <div class="container-fluid">

        <div class="d-flex justify-content-between mb-4">
            <h1 class="h3">Danh mục Blog</h1>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                <i class="fas fa-plus"></i> Thêm danh mục
            </button>
        </div>

        {{-- Table --}}
        <div class="card">
            <div class="card-body table-responsive">

                <table class="table table-hover align-middle" id="sortableTable">
                    <thead>
                        <tr>
                            <th width="50">#</th>
                            <th>Tên</th>
                            <th>Icon</th> {{-- THÊM --}}
                            <th>Slug</th>
                            <th>Bài viết</th>
                            <th>Hiển thị</th>
                            <th width="150">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr data-id="{{ $category->id }}">
                                <td class="handle">
                                    <i class="fas fa-grip-vertical"></i>
                                </td>

                                <td>{{ $category->name }}</td>
                                {{-- ICON --}}
                                <td class="text-align-center fs-5">
                                    @if ($category->icon)
                                        <i class="{{ $category->icon }}" style="color: #FFD43B"></i>
                                    @else
                                        <i class="fas fa-circle-question text-muted"></i>
                                    @endif
                                </td>
                                <td>{{ $category->slug }}</td>

                                <td>
                                    <span class="badge bg-info">{{ $category->posts_count }}</span>
                                </td>

                                <td>
                                    @if ($category->is_active)
                                        <span class="badge bg-success">Hiển thị</span>
                                    @else
                                        <span class="badge bg-secondary">Ẩn</span>
                                    @endif
                                </td>

                                <td>
                                    <button class="btn btn-sm btn-warning editBtn" data-id="{{ $category->id }}"
                                        data-name="{{ $category->name }}" data-slug="{{ $category->slug }}"
                                        data-icon="{{ $category->icon }}" data-description="{{ $category->description }}"
                                        data-order="{{ $category->order }}" data-active="{{ $category->is_active }}"
                                        data-bs-toggle="modal" data-bs-target="#editModal">
                                        <i class="fas fa-edit"></i>
                                    </button>

                                    <form action="{{ route('blog.categories.destroy', $category) }}" method="POST"
                                        class="d-inline" onsubmit="return confirm('Xóa danh mục này?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>

            </div>
        </div>

    </div>

    {{-- Create Modal --}}
    @include('admin.blog.categories.modal-create')

    {{-- Edit Modal --}}
    @include('admin.blog.categories.modal-edit')

@endsection
