@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid mt-4">
        <div class="row g-4">
            <div class="col-md-3">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h6 class="text-muted">Số bài học</h6>
                        {{-- <h2 class="fw-bold"> {{ $lesson->vocabularies_count }} </h2> --}}
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h6 class="text-muted">Số từ vựng</h6>
                        <h2 class="fw-bold">45</h2>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h6 class="text-muted">Số người dùng</h6>
                        <h2 class="fw-bold">8</h2>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h6 class="text-muted">Lượt truy cập</h6>
                        <h2 class="fw-bold">1,230</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
