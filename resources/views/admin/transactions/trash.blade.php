@extends('admin.layouts.app')

@section('title', 'Thùng rác - Giao dịch')

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">Thùng rác - Giao dịch</h1>
            <div>
                <a href="{{ route('transactions.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Quay lại
                </a>
            </div>
        </div>

        <!-- Warning Alert -->
        <div class="alert alert-warning" role="alert">
            <i class="fas fa-exclamation-triangle"></i>
            <strong>Lưu ý:</strong> Các giao dịch trong thùng rác có thể được khôi phục hoặc xóa vĩnh viễn.
            Sau khi xóa vĩnh viễn, dữ liệu sẽ không thể khôi phục.
        </div>

        <!-- Transactions Table -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Mã GD</th>
                                <th>Người dùng</th>
                                <th>Gói</th>
                                <th>Số tiền</th>
                                <th>Trạng thái</th>
                                <th>Ngày xóa</th>
                                <th width="150">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transactions as $transaction)
                                <tr>
                                    <td>
                                        <strong>{{ $transaction->transaction_code }}</strong>
                                        <br>
                                        <span class="badge bg-danger">Đã xóa</span>
                                    </td>
                                    <td>
                                        <div>
                                            <strong>{{ $transaction->user->name ?? 'N/A' }}</strong>
                                            <br>
                                            <small class="text-muted">{{ $transaction->user->email ?? 'N/A' }}</small>
                                        </div>
                                    </td>
                                    <td>
                                        @if ($transaction->plan)
                                            <span class="badge bg-primary">{{ $transaction->plan->name }}</span>
                                        @else
                                            <span class="text-muted">N/A</span>
                                        @endif
                                    </td>
                                    <td>
                                        <strong>{{ number_format($transaction->amount) }}đ</strong>
                                    </td>
                                    <td>
                                        @php
                                            $statusColors = [
                                                'completed' => 'success',
                                                'pending' => 'warning',
                                                'failed' => 'danger',
                                                'refunded' => 'secondary',
                                            ];
                                            $statusLabels = [
                                                'completed' => 'Hoàn thành',
                                                'pending' => 'Đang chờ',
                                                'failed' => 'Thất bại',
                                                'refunded' => 'Đã hoàn tiền',
                                            ];
                                        @endphp
                                        <span class="badge bg-{{ $statusColors[$transaction->status] ?? 'secondary' }}">
                                            {{ $statusLabels[$transaction->status] ?? $transaction->status }}
                                        </span>
                                    </td>
                                    <td>
                                        {{ $transaction->deleted_at->format('d/m/Y H:i') }}
                                        <br>
                                        <small class="text-muted">{{ $transaction->deleted_at->diffForHumans() }}</small>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <form action="{{ route('transactions.restore', $transaction->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-success" title="Khôi phục">
                                                    <i class="fas fa-undo"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('transactions.forceDelete', $transaction->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" title="Xóa vĩnh viễn"
                                                    onclick="return confirm('Bạn có chắc muốn xóa vĩnh viễn? Hành động này không thể hoàn tác!')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4">
                                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                        <p class="text-muted">Thùng rác trống</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if ($transactions->hasPages())
                    <div class="mt-3">
                        {{ $transactions->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
