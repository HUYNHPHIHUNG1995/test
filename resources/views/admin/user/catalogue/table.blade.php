<table class="table table-striped table-bordered">
    <thead>
    <tr>
        <th>
            <input type="checkbox" value="" id="checkAll" class="input-checkbox">
        </th>
        <th>Tên Nhóm Thành Viên</th>
        <th class="text-center">Số thành viên</th>
        <th>Mô tả</th>
        <th class="text-center">Tình Trạng</th>
        <th class="text-center">Thao tác</th>
    </tr>
    </thead>
    <tbody>
        @if(isset($userCatalogues) && is_object($userCatalogues))
            @foreach($userCatalogues as $userCatalogue)
            <tr >
                <td>
                    <input type="checkbox" value="{{ $userCatalogue->id }}" class="input-checkbox checkBoxItem">
                </td>
                <td>
                    {{ $userCatalogue->name }}
                </td>
                <td class="text-center">
                    {{ $userCatalogue->users_count }} người
                </td>
                <td>
                    {{ $userCatalogue->description }}
                </td>
                <td class="text-center js-switch-{{ $userCatalogue->id }}"> 
                    <input type="checkbox" value="{{ $userCatalogue->publish }}" class="js-switch status " data-field="publish" data-model="{{ $model }}" {{ ($userCatalogue->publish == 1) ? 'checked' : '' }} data-modelId="{{ $userCatalogue->id }}" />
                </td>
                <td class="text-center"> 
                    <a href="{{ route('editCatalogueUser', $userCatalogue->id) }}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                    <button href="" class="btn btn-danger deleterow" value="{{$userCatalogue->id}}"><i class="fa fa-trash"></i></button>
                </td>
            </tr>
            <input hidden class="value{{ $userCatalogue->id }}" value="{{ $userCatalogue->name }}">
            @endforeach
        @endif
    </tbody>
</table>
{{  $userCatalogues->links('pagination::bootstrap-4') }}
<div class="modal fade" id="deleteCategory" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="deleteCategory" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <form action="{{route('postDeleteCatalogue')}}" method="POST">
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
                    <button type="submit" class="btn btn-danger" id="modal-confirm_delete">Delete</button>
                </div>
                    @csrf
                </form>
            </div>
        </div>
    </div>
