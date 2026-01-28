@extends('admin.layouts.app')

@section('title', 'Chi tiết Giao dịch')

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-0">Chi tiết Giao dịch</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('transactions.index') }}">Giao dịch</a></li>
                        <li class="breadcrumb-item active">Chi tiết</li>
                    </ol>
                </nav>
            </div>
            <div>
                <a href="{{ route('transactions.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Quay lại
                </a>
            </div>
        </div>

        <div class="row">
            <!-- Main Information -->
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Thông tin giao dịch</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th width="30%">Mã giao dịch</th>
                                    <td><strong>{{ $transaction->transaction_code }}</strong></td>
                                </tr>
                                <tr>
                                    <th>Gói dịch vụ</th>
                                    <td>
                                        @if ($transaction->plan)
                                            <span class="badge bg-primary">{{ $transaction->plan->name }}</span>
                                        @else
                                            <span class="text-muted">N/A</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Số tiền</th>
                                    <td><strong class="text-primary">{{ number_format($transaction->amount) }}đ</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Phương thức thanh toán</th>
                                    <td>
                                        <span class="badge bg-secondary">
                                            {{ strtoupper($transaction->payment_method) }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Trạng thái</th>
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
                                </tr>
                                <tr>
                                    <th>Ngày tạo</th>
                                    <td>{{ $transaction->created_at->format('d/m/Y H:i:s') }}</td>
                                </tr>
                                <tr>
                                    <th>Ngày thanh toán</th>
                                    <td>
                                        @if ($transaction->paid_at)
                                            {{ $transaction->paid_at->format('d/m/Y H:i:s') }}
                                        @else
                                            <span class="text-muted">Chưa thanh toán</span>
                                        @endif
                                    </td>
                                </tr>
                                @if ($transaction->subscription)
                                    <tr>
                                        <th>Mã đăng ký</th>
                                        <td>#{{ $transaction->subscription->id }}</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- User Information -->
                @if ($transaction->user)
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Thông tin khách hàng</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th width="30%">ID người dùng</th>
                                        <td>#{{ $transaction->user->id }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tên</th>
                                        <td><strong>{{ $transaction->user->username }}</strong></td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{ $transaction->user->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Ngày đăng ký</th>
                                        <td>{{ $transaction->user->created_at->format('d/m/Y') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar Actions -->
            <div class="col-md-4">
                <!-- Status Actions -->
                @if ($transaction->status == 'pending')
                    <div class="card mb-4">
                        <div class="card-header bg-warning text-white">
                            <h5 class="mb-0">Xác nhận giao dịch</h5>
                        </div>
                        <div class="card-body">
                            <p class="text-muted">Giao dịch đang chờ xử lý. Vui lòng xác nhận hoặc từ chối.</p>
                            <form action="{{ route('transactions.updateStatus', $transaction) }}" method="POST"
                                class="mb-2">
                                @csrf
                                <input type="hidden" name="status" value="completed">
                                <button type="submit" class="btn btn-success w-100">
                                    <i class="fas fa-check"></i> Xác nhận hoàn thành
                                </button>
                            </form>
                            <form action="{{ route('transactions.updateStatus', $transaction) }}" method="POST">
                                @csrf
                                <input type="hidden" name="status" value="failed">
                                <button type="submit" class="btn btn-danger w-100">
                                    <i class="fas fa-times"></i> Đánh dấu thất bại
                                </button>
                            </form>
                        </div>
                    </div>
                @endif

                @if ($transaction->status == 'completed')
                    <div class="card mb-4">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0">Giao dịch thành công</h5>
                        </div>
                        <div class="card-body">
                            <p class="text-muted">Giao dịch đã được hoàn thành thành công.</p>
                            <form action="{{ route('transactions.refund', $transaction) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-warning w-100"
                                    onclick="return confirm('Bạn có chắc muốn hoàn tiền giao dịch này?')">
                                    <i class="fas fa-undo"></i> Hoàn tiền
                                </button>
                            </form>
                        </div>
                    </div>
                @endif

                @if ($transaction->status == 'failed')
                    <div class="card mb-4">
                        <div class="card-header bg-danger text-white">
                            <h5 class="mb-0">Giao dịch thất bại</h5>
                        </div>
                        <div class="card-body">
                            <p class="text-muted">Giao dịch đã thất bại và không thể xử lý.</p>
                        </div>
                    </div>
                @endif

                @if ($transaction->status == 'refunded')
                    <div class="card mb-4">
                        <div class="card-header bg-secondary text-white">
                            <h5 class="mb-0">Đã hoàn tiền</h5>
                        </div>
                        <div class="card-body">
                            <p class="text-muted">Giao dịch đã được hoàn tiền cho khách hàng.</p>
                        </div>
                    </div>
                @endif

                <!-- Delete Action -->
                <div class="card">
                    <div class="card-header bg-danger text-white">
                        <h5 class="mb-0">Xóa giao dịch</h5>
                    </div>
                    <div class="card-body">
                        <p class="text-muted">Xóa giao dịch này khỏi hệ thống. Có thể khôi phục từ thùng rác.</p>
                        <form action="{{ route('transactions.destroy', $transaction) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100"
                                onclick="return confirm('Bạn có chắc muốn xóa giao dịch này?')">
                                <i class="fas fa-trash"></i> Xóa giao dịch
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
