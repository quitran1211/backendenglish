@extends('admin.layouts.app')

@section('title', 'Import từ vựng')

@section('content')
    <div class="container-fluid p-4">

        <h2 class="h4 mb-4">Import từ vựng từ Excel</h2>

        {{-- Hiển thị thông báo thành công --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Hiển thị thông báo lỗi --}}
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm rounded border p-3">
            <form action="{{ route('vocabularies.import') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <input type="file" name="file" class="form-control" accept=".xlsx,.xls,.csv" required>
                </div>

                <button class="btn btn-success">
                    <i class="fa-solid fa-file-import"></i> Import từ Excel
                </button>

                <div class="form-text mt-2">
                    File Excel gồm các cột: <code>word</code>, <code>pronunciation</code>, <code>word_type</code>,
                    <code>meaning_vi</code>, <code>meaning_en</code>
                </div>
            </form>
        </div>
    </div>
@endsection
