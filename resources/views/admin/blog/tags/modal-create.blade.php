<div class="modal fade" id="createTagModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <form action="{{ route('blog.tags.store') }}" method="POST" class="modal-content">
            @csrf

            <div class="modal-header">
                <h5 class="modal-title">Thêm tag mới</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                {{-- Name --}}
                <div class="mb-3">
                    <label class="form-label">Tên tag</label>
                    <input type="text" name="name" class="form-control" placeholder="Ví dụ: toeic-650, tu-vung"
                        required>
                </div>

                {{-- Slug --}}
                <div class="mb-3">
                    <label class="form-label">Slug</label>
                    <input type="text" name="slug" class="form-control" placeholder="Tự động nếu bỏ trống">
                    <small class="text-muted">
                        Nếu để trống, slug sẽ được tạo tự động từ tên tag
                    </small>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Hủy
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Lưu tag
                </button>
            </div>

        </form>
    </div>
</div>
