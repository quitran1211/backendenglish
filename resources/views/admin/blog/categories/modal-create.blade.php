<div class="modal fade" id="createModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('blog.categories.store') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Thêm danh mục</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body row g-3">

                <div class="col-md-6">
                    <label>Tên danh mục</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label>Slug</label>
                    <input type="text" name="slug" class="form-control">
                </div>

                <div class="col-md-6">
                    <label>Icon (Font Awesome)</label>
                    <input type="text" name="icon" class="form-control" placeholder="VD: fas fa-plus">
                    <small class="text-muted">
                        Ví dụ: fas fa-plus, far fa-user, fa-solid fa-book
                    </small>
                </div>


                <div class="col-md-6">
                    <label>Thứ tự</label>
                    <input type="number" name="order" class="form-control" value="0">
                </div>

                <div class="col-12">
                    <label>Mô tả</label>
                    <textarea name="description" class="form-control"></textarea>
                </div>

                <div class="col-12">
                    <div class="form-check">
                        <input type="checkbox" name="is_active" value="1" checked class="form-check-input">
                        <label class="form-check-label">Hiển thị</label>
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <button class="btn btn-primary">Lưu</button>
            </div>
        </form>
    </div>
</div>
