<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('blog.categories.update', $category) }}" method="POST" id="editForm">
            @csrf
            @method('PUT')

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cập nhật danh mục</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body row g-3">

                    <div class="col-md-6">
                        <label class="form-label">Tên danh mục</label>
                        <input type="text" name="name" id="edit_name" class="form-control"
                            value="{{ $category->name }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Slug</label>
                        <input type="text" name="slug" id="edit_slug" class="form-control"
                            value="{{ $category->slug }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Icon</label>
                        <input type="text" name="icon" id="edit_icon" class="form-control"
                            placeholder="fas fa-book" value="{{ $category->icon }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Thứ tự</label>
                        <input type="number" name="order" id="edit_order" class="form-control"
                            value="{{ $category->order }}">
                    </div>

                    <div class="col-12">
                        <label class="form-label">Mô tả</label>
                        <textarea name="description" id="edit_description" class="form-control" rows="3">{{ $category->description }}"</textarea>
                    </div>

                    <div class="col-12">
                        <div class="form-check ">
                            <input type="checkbox" name="is_active" value="1" class="form-check-input"
                                {{ $category->is_active ? 'checked' : '' }}>
                            <label class="form-check-label">Hiển thị danh mục</label>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary">Lưu thay đổi</button>
                </div>

            </div>
        </form>
    </div>
</div>
