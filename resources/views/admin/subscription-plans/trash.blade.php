@extends('admin.layouts.app')

@section('title', 'Thùng rác - Gói đăng ký')

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">
                <i class="fas fa-trash"></i> Thùng rác - Gói đăng ký
            </h1>
            <a href="{{ route('subscription-plans.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Quay lại danh sách
            </a>
        </div>

        <!-- Alert Info -->
        <div class="alert alert-info mb-4">
            <i class="fas fa-info-circle"></i>
            <strong>Lưu ý:</strong> Các gói trong thùng rác sẽ được xóa vĩnh viễn sau 30 ngày.
            Bạn có thể khôi phục hoặc xóa vĩnh viễn chúng trước thời hạn đó.
        </div>

        <!-- Plans Table -->
        <div class="card">
            <div class="card-body">
                @if ($plans->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Tên gói</th>
                                    <th>Thời hạn</th>
                                    <th>Giá</th>
                                    <th>Số đăng ký</th>
                                    <th>Ngày xóa</th>
                                    <th width="200">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($plans as $plan)
                                    <tr>
                                        <td><strong>{{ $plan->id }}</strong></td>
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
                                            <span class="badge bg-info">{{ $plan->duration_days }} ngày</span>
                                        </td>
                                        <td>
                                            <strong class="text-success">{{ number_format($plan->price) }} đ</strong>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-primary">
                                                {{ $plan->subscriptions()->count() }}
                                            </span>
                                        </td>
                                        <td>
                                            {{ $plan->deleted_at->format('d/m/Y H:i') }}
                                            <br>
                                            <small class="text-muted">
                                                {{ $plan->deleted_at->diffForHumans() }}
                                            </small>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <!-- Restore -->
                                                <form action="{{ route('subscription-plans.restore', $plan->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-success" title="Khôi phục"
                                                        onclick="return confirm('Khôi phục gói này?')">
                                                        <i class="fas fa-undo"></i> Khôi phục
                                                    </button>
                                                </form>

                                                <!-- Force Delete -->
                                                <form action="{{ route('subscription-plans.forceDelete', $plan->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger" title="Xóa vĩnh viễn"
                                                        onclick="return confirm('CẢNH BÁO: Hành động này không thể hoàn tác!\n\nXóa vĩnh viễn gói này?\n\nLưu ý: Không thể xóa nếu còn đăng ký liên quan.')">
                                                        <i class="fas fa-times"></i> Xóa vĩnh viễn
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
                        <i class="fas fa-trash-alt fa-3x text-muted mb-3"></i>
                        <p class="text-muted">Thùng rác trống</p>
                        <a href="{{ route('subscription-plans.index') }}" class="btn btn-primary">
                            <i class="fas fa-list"></i> Về danh sách gói
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Information Card -->
        @if ($plans->count() > 0)
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="card border-warning">
                        <div class="card-header bg-warning text-dark">
                            <h5 class="mb-0"><i class="fas fa-exclamation-triangle"></i> Lưu ý quan trọng</h5>
                        </div>
                        <div class="card-body">
                            <ul class="mb-0">
                                <li>Gói đã xóa sẽ tự động bị xóa vĩnh viễn sau 30 ngày</li>
                                <li>Khôi phục gói sẽ đưa nó về trạng thái "Vô hiệu hóa"</li>
                                <li>Không thể xóa vĩnh viễn gói còn đăng ký liên quan</li>
                                <li>Hành động xóa vĩnh viễn không thể hoàn tác</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card border-info">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0"><i class="fas fa-question-circle"></i> Câu hỏi thường gặp</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <strong>Khôi phục gói có ảnh hưởng đến đăng ký cũ?</strong>
                                <p class="small text-muted mb-0">Không, các đăng ký cũ vẫn giữ nguyên thông tin.</p>
                            </div>
                            <div class="mb-3">
                                <strong>Có thể xóa gói đang có người dùng?</strong>
                                <p class="small text-muted mb-0">Không, phải chờ tất cả đăng ký hết hạn hoặc chuyển sang gói
                                    khác.</p>
                            </div>
                            <div class="mb-0">
                                <strong>Gói đã khôi phục có hiển thị ngay?</strong>
                                <p class="small text-muted mb-0">Không, cần kích hoạt lại trong trang chỉnh sửa.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
