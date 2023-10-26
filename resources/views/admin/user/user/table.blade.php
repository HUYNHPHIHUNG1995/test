<table class="table table-striped table-bordered">
    <thead>
    <tr>
        <th>
            <input type="checkbox" value="" id="checkAll" class="input-checkbox">
        </th>
        <th>Họ Tên</th>
        <th>Email</th>
        <th>Số điện thoại</th>
        <th class="text-center">Nhóm thành viên</th>
        <th class="text-center">Tình Trạng</th>
        <th class="text-center">Thao tác</th>
    </tr>
    </thead>
    <tbody>
        @if(isset($users) && is_object($users))
            @foreach($users as $user)
            <tr >
                <td>
                    <input type="checkbox" value="{{ $user->id }}" class="input-checkbox checkBoxItem">
                </td>
                <td>
                    {{ $user->name }}
                </td>
                <td>
                    {{ $user->email }}
                </td>
                <td>
                    {{ $user->phone }}
                </td>

                <td class="text-center">
                    {{ $user->user_catalogues->name }}
                </td>
                <td class="text-center js-switch-{{ $user->id }}"> 
                    <input type="checkbox" value="{{ $user->publish }}" class="js-switch status " data-field="publish" data-model="{{ $model }}" {{ ($user->publish == 1) ? 'checked' : '' }} data-modelId="{{ $user->id }}" />
                </td>
                <td class="text-center"> 
                    <a href="{{ route('editUser', $user->id) }}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                    <button href="" class="btn btn-danger deleterow" value="{{$user->id}}"><i class="fa fa-trash"></i></button>
                </td>
            </tr>
            <input hidden class="value{{ $user->id }}" value="{{ $user->email }}">
            @endforeach
        @endif
    </tbody>
</table>
{{  $users->links('pagination::bootstrap-4') }}
<div class="modal fade" id="deleteCategory" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="deleteCategory" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <form action="{{route('postDeleteUser')}}" method="POST">
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
