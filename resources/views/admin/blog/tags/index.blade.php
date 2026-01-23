@extends('admin.layouts.app')

@section('title', 'Tags Blog')

@section('content')
    <div class="container-fluid">

        <div class="d-flex justify-content-between mb-4">
            <h1 class="h3">🏷 Tags Blog</h1>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createTagModal">
                <i class="fas fa-plus"></i> Thêm tag
            </button>

        </div>

        <div class="card">
            <div class="card-body table-responsive">

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tên tag</th>
                            <th>Slug</th>
                            <th>Bài viết</th>
                            <th width="120">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tags as $tag)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $tag->name }}</td>
                                <td>{{ $tag->slug }}</td>
                                <td>
                                    <span class="badge bg-info">{{ $tag->posts_count }}</span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-warning editBtn" data-id="{{ $tag->id }}"
                                        data-name="{{ $tag->name }}" data-slug="{{ $tag->slug }}">
                                        <i class="fas fa-edit"></i>
                                    </button>

                                    <form action="{{ route('blog.tags.destroy', $tag) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Xóa tag này?')">
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

                {{ $tags->links() }}

            </div>
        </div>

    </div>

    @include('admin.blog.tags.modal-create')
    {{-- @include('admin.blog.tags.modal-edit') --}}

@endsection
