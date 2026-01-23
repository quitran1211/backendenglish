@extends('admin.layouts.app')

@section('title', 'Thêm đáp án')

@section('content')
    <div class="container-fluid p-4">
        <div class="rounded border bg-white p-4 shadow-sm">

            <h4 class="fw-semibold mb-4">Thêm đáp án mới</h4>

            <form action="{{ route('exercise.options.store', $exercise->id) }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nội dung đáp án</label>
                    <input type="text" name="option_text" class="form-control" value="{{ old('option_text') }}" required>
                </div>

                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" name="is_correct" value="1">
                    <label class="form-check-label">
                        Đây là đáp án đúng
                    </label>
                </div>

                <div class="d-flex gap-3">
                    <button class="btn btn-primary px-4">Lưu</button>
                    <a href="{{ route('exercise.options.index', $exercise->id) }}" class="btn btn-light px-4">
                        Quay lại
                    </a>
                </div>
            </form>

        </div>
    </div>
@endsection
