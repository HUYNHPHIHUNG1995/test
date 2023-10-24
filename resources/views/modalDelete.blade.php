<div class="modal fade" id="deleteAllModal" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="deleteCategory" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hành động này sẽ không thể khôi phục lại</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Bạn chắc chắn muốn xóa mục đã chọn <span id="modal-category_name" style="bold"></span>?
                    <input type="hidden" id="getId" name="getId">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-white" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger deleteAll" id="modal-confirm_delete ">Delete</button>
                </div>
            </div>
        </div>
    </div>