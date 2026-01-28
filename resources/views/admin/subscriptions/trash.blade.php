@extends('admin.layouts.app')

@section('title', 'Thùng rác - Đăng ký')

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">
                <i class="fas fa-trash"></i> Thùng rác - Đăng ký
            </h1>
            <a href="{{ route('subscriptions.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Quay lại danh sách
            </a>
        </div>

        <!-- Alert Info -->
        <div class="alert alert-info mb-4">
            <i class="fas fa-info-circle"></i>
            <strong>Lưu ý:</strong> Các đăng ký trong thùng rác sẽ được xóa vĩnh viễn sau 30 ngày.
            Bạn có thể khôi phục hoặc xóa vĩnh viễn chúng trước thời hạn đó.
        </div>

        <!-- Bulk Actions -->
        @if ($subscriptions->count() > 0)
            <div class="card mb-4">
                <div class="card-body">
                    <form id="bulkActionForm" action="{{ route('subscriptions.bulkAction') }}" method="POST">
                        @csrf
                        <div class="row align-items-end">
                            <div class="col-md-4">
                                <label class="form-label">Thao tác hàng loạt</label>
                                <select name="action" class="form-select" required>
                                    <option value="">Chọn thao tác...</option>
                                    <option value="restore">Khôi phục</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-bolt"></i> Thực hiện
                                </button>
                            </div>
                            <div class="col-md-5 text-end">
                                <span class="text-muted">
                                    Đã chọn: <strong id="selectedCount">0</strong> mục
                                </span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endif

        <!-- Subscriptions Table -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="50">
                                    <input type="checkbox" id="selectAll">
                                </th>
                                <th>ID</th>
                                <th>Người dùng</th>
                                <th>Gói dịch vụ</th>
                                <th>Trạng thái</th>
                                <th>Ngày xóa</th>
                                <th width="200">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($subscriptions as $subscription)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="ids[]" value="{{ $subscription->id }}"
                                            class="subscription-checkbox" form="bulkActionForm">
                                    </td>
                                    <td>{{ $subscription->id }}</td>
                                    <td>
                                        <div>
                                            <strong>{{ $subscription->user->name }}</strong>
                                            <br>
                                            <small class="text-muted">{{ $subscription->user->email }}</small>
                                        </div>
                                    </td>
                                    <td>
                                        @if ($subscription->plan)
                                            <span class="badge bg-primary">{{ $subscription->plan->name }}</span>
                                        @else
                                            <span class="badge bg-secondary">N/A</span>
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                            $statusColors = [
                                                'active' => 'success',
                                                'expired' => 'danger',
                                                'cancelled' => 'secondary',
                                            ];
                                            $statusLabels = [
                                                'active' => 'Hoạt động',
                                                'expired' => 'Hết hạn',
                                                'cancelled' => 'Đã hủy',
                                            ];
                                        @endphp
                                        <span class="badge bg-{{ $statusColors[$subscription->status] ?? 'secondary' }}">
                                            {{ $statusLabels[$subscription->status] ?? $subscription->status }}
                                        </span>
                                    </td>
                                    <td>
                                        {{ $subscription->deleted_at->format('d/m/Y H:i') }}
                                        <br>
                                        <small class="text-muted">
                                            {{ $subscription->deleted_at->diffForHumans() }}
                                        </small>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <!-- Restore -->
                                            <form action="{{ route('subscriptions.restore', $subscription->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-success" title="Khôi phục"
                                                    onclick="return confirm('Khôi phục đăng ký này?')">
                                                    <i class="fas fa-undo"></i> Khôi phục
                                                </button>
                                            </form>

                                            <!-- Force Delete -->
                                            <form action="{{ route('subscriptions.forceDelete', $subscription->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" title="Xóa vĩnh viễn"
                                                    onclick="return confirm('CẢNH BÁO: Hành động này không thể hoàn tác! Bạn có chắc chắn muốn xóa vĩnh viễn?')">
                                                    <i class="fas fa-times"></i> Xóa vĩnh viễn
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5">
                                        <i class="fas fa-trash-alt fa-3x text-muted mb-3"></i>
                                        <p class="text-muted">Thùng rác trống</p>
                                        <a href="{{ route('subscriptions.index') }}" class="btn btn-primary">
                                            <i class="fas fa-list"></i> Về danh sách đăng ký
                                        </a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if ($subscriptions->count() > 0)
                    <div class="mt-3">
                        {{ $subscriptions->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Select all checkboxes
            const selectAll = document.getElementById('selectAll');
            const checkboxes = document.querySelectorAll('.subscription-checkbox');
            const selectedCount = document.getElementById('selectedCount');

            if (selectAll) {
                selectAll.addEventListener('change', function() {
                    checkboxes.forEach(checkbox => {
                        checkbox.checked = this.checked;
                    });
                    updateSelectedCount();
                });
            }

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateSelectedCount);
            });

            function updateSelectedCount() {
                const count = document.querySelectorAll('.subscription-checkbox:checked').length;
                if (selectedCount) {
                    selectedCount.textContent = count;
                }

                // Update select all checkbox
                if (selectAll) {
                    selectAll.checked = count === checkboxes.length && count > 0;
                }
            }

            // Initial count
            updateSelectedCount();
        </script>
    @endpush
@endsection
