@extends('admin.layouts.app')

@section('title', 'Quản lý Gói đăng ký')

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">
                <i class="fas fa-tags"></i> Quản lý Gói đăng ký
            </h1>
            <div>
                <a href="{{ route('subscription-plans.trash') }}" class="btn btn-secondary">
                    <i class="fas fa-trash"></i> Thùng rác
                </a>
                <a href="{{ route('subscription-plans.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tạo gói mới
                </a>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h6 class="card-title">Tổng số gói</h6>
                        <h2 class="mb-0">{{ $plans->total() }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h6 class="card-title">Gói đang hoạt động</h6>
                        <h2 class="mb-0">{{ $plans->where('is_active', true)->count() }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <h6 class="card-title">Gói vô hiệu hóa</h6>
                        <h2 class="mb-0">{{ $plans->where('is_active', false)->count() }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <h6 class="card-title">Tổng đăng ký</h6>
                        <h2 class="mb-0">{{ $plans->sum('subscriptions_count') }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- Plans Table -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fas fa-list"></i> Danh sách gói đăng ký</h5>
                <div class="text-muted small">
                    <i class="fas fa-info-circle"></i> Kéo thả để sắp xếp thứ tự hiển thị
                </div>
            </div>
            <div class="card-body">
                @if ($plans->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover align-middle" id="plansTable">
                            <thead class="table-light">
                                <tr>
                                    <th width="50">
                                        <i class="fas fa-sort"></i>
                                    </th>
                                    <th>ID</th>
                                    <th>Tên gói</th>
                                    <th>Thời hạn</th>
                                    <th>Giá</th>
                                    <th>Số đăng ký</th>
                                    <th>Trạng thái</th>
                                    <th>Thứ tự</th>
                                    <th width="200">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody id="sortable">
                                @foreach ($plans as $plan)
                                    <tr data-id="{{ $plan->id }}"
                                        class="{{ !$plan->is_active ? 'table-secondary' : '' }}">
                                        <td class="text-center drag-handle" style="cursor: move;">
                                            <i class="fas fa-grip-vertical text-muted"></i>
                                        </td>
                                        <td>
                                            <strong>{{ $plan->id }}</strong>
                                        </td>
                                        <td>
                                            <div>
                                                <strong>{{ $plan->name }}</strong>
                                                @if ($plan->description)
                                                    <br>
                                                    <small class="text-muted">
                                                        {{ Str::limit($plan->description, 60) }}
                                                    </small>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-info">
                                                {{ $plan->duration_days }} ngày
                                            </span>
                                            <br>
                                            <small class="text-muted">
                                                (~{{ round($plan->duration_days / 30, 1) }} tháng)
                                            </small>
                                        </td>
                                        <td>
                                            <strong class="text-success">
                                                {{ number_format($plan->price) }} đ
                                            </strong>
                                            <br>
                                            <small class="text-muted">
                                                {{ number_format($plan->price / $plan->duration_days) }} đ/ngày
                                            </small>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-primary fs-6">
                                                {{ $plan->subscriptions_count }}
                                            </span>
                                        </td>
                                        <td>
                                            @if ($plan->is_active)
                                                <span class="badge bg-success">
                                                    <i class="fas fa-check-circle"></i> Hoạt động
                                                </span>
                                            @else
                                                <span class="badge bg-secondary">
                                                    <i class="fas fa-times-circle"></i> Vô hiệu
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-dark">{{ $plan->sort_order ?? '-' }}</span>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm gap-2">
                                                <!-- View -->
                                                <a href="{{ route('subscription-plans.show', $plan) }}"
                                                    class="btn btn-info btn rounded border-1" title="Chi tiết">
                                                    <i class="fas fa-eye"></i>
                                                </a>

                                                <!-- Edit -->
                                                <a href="{{ route('subscription-plans.edit', $plan) }}"
                                                    class="btn btn-primary rounded" title="Sửa">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <!-- Toggle Active -->
                                                <form action="{{ route('subscription-plans.toggleActive', $plan) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit"
                                                        class="btn btn-{{ $plan->is_active ? 'warning' : 'success' }}"
                                                        title="{{ $plan->is_active ? 'Vô hiệu hóa' : 'Kích hoạt' }}">
                                                        <i class="fas fa-{{ $plan->is_active ? 'ban' : 'check' }}"></i>
                                                    </button>
                                                </form>

                                                <!-- Delete -->
                                                <form action="{{ route('subscription-plans.destroy', $plan) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger" title="Xóa"
                                                        onclick="return confirm('Xóa gói này?\nLưu ý: Chỉ có thể xóa nếu không còn đăng ký đang hoạt động.')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-3">
                        {{ $plans->links() }}
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                        <p class="text-muted">Chưa có gói đăng ký nào</p>
                        <a href="{{ route('subscription-plans.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Tạo gói đầu tiên
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Popular Plans Highlight -->
        @if ($plans->count() > 0)
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0"><i class="fas fa-star"></i> Gói phổ biến nhất</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach ($plans->sortByDesc('subscriptions_count')->take(3) as $popularPlan)
                                    <div class="col-md-4">
                                        <div class="card h-100 {{ $loop->first ? 'border-warning shadow' : '' }}">
                                            <div class="card-body">
                                                @if ($loop->first)
                                                    <div class="badge bg-warning text-dark mb-2">
                                                        <i class="fas fa-crown"></i> Phổ biến nhất
                                                    </div>
                                                @endif
                                                <h5 class="card-title">{{ $popularPlan->name }}</h5>
                                                <p class="card-text text-muted small">
                                                    {{ Str::limit($popularPlan->description, 80) }}
                                                </p>
                                                <hr>
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <small class="text-muted">Số đăng ký</small>
                                                        <h4 class="mb-0 text-primary">
                                                            {{ $popularPlan->subscriptions_count }}</h4>
                                                    </div>
                                                    <div class="text-end">
                                                        <small class="text-muted">Giá</small>
                                                        <h4 class="mb-0 text-success">
                                                            {{ number_format($popularPlan->price / 1000) }}K</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    @push('styles')
        <style>
            .drag-handle {
                cursor: move;
            }

            .sortable-ghost {
                opacity: 0.4;
                background-color: #f8f9fa;
            }

            .table tbody tr:hover .drag-handle {
                color: #0d6efd !important;
            }
        </style>
    @endpush

    @push('scripts')
        <!-- Sortable.js for drag & drop (optional) -->
        <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
        <script>
            // Enable drag & drop sorting
            const tbody = document.getElementById('sortable');
            if (tbody) {
                new Sortable(tbody, {
                    handle: '.drag-handle',
                    animation: 150,
                    ghostClass: 'sortable-ghost',
                    onEnd: function(evt) {
                        // TODO: Send AJAX request to update sort order
                        console.log('New order:', evt.newIndex, 'Old order:', evt.oldIndex);

                        // You can implement AJAX call here to save the new order
                        // Example:
                        // const items = [...tbody.querySelectorAll('tr')];
                        // const order = items.map((tr, index) => ({
                        //     id: tr.dataset.id,
                        //     sort_order: index
                        // }));
                        // Send order to backend
                    }
                });
            }
        </script>
    @endpush
@endsection
