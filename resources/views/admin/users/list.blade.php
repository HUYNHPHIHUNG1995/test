@extends('admin.main')
@section('content')
    <div class="card-body table-responsive p-0">
        @include('admin.users.search')
        <table class="table table-hover text-nowrap">
            <thead>
            <tr>
                <th ><input type="checkbox" value="" id="checkAll" class="input-checkbox"></th>
                <th >Họ Tên</th>
                <th>Email</th>
                <th>Số điện thoại</th>
                <th>Địa chỉ</th>
                <th class="text-center">Tình trạng</th>
                <th class="text-center">Thao tác</th>
            </tr>
            </thead>
            <tbody>
            @if(isset($listUsers) && is_object($listUsers))
                @foreach($listUsers as $listUser)
                <tr>
                    <td>
                        <input type="checkbox" value="" class="input-checkbox checkboxItem">
                    </td>
                    <td>
                        {{$listUser->name}}
                    </td>
                    <td>
                        {{$listUser->email}}
                    </td>
                    <td>
                        {{$listUser->phone}}
                    </td>
                    <td>
                        {{$listUser->adress}}
                    </td>
                    <td class="text-center">
                        <input type="checkbox" class="js-switch" value="{{$listUser->publish}}"
                              {{($listUser->publish==1) ? 'checked' : ''}} />

                    </td>
                    <td class="text-center">
                        <a class="btn btn-primary btn-sm edit " href="{{route('editUser',$listUser->id)}}">Sửa
                            <i class="fas fa-edit"></i>
                        </a>
                        <button type="button" class="btn btn-danger deleteUser" value="{{$listUser->id}}"
                                data-target="">Xóa
                        </button>
                        {{--onclick="loadDeleteModal({{ $listUser->id }}, '{{ $listUser->email }}','/ajax/deleteUser')"--}}
                    </td>
                </tr>
                @endforeach
            @endif
            </tbody>
        </table>
        {{$listUsers->links('pagination::bootstrap-4')}}
    </div>
    <div class="modal fade" id="deleteCategory" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="deleteCategory" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <form action="{{route('postDelete')}}" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title">This action is not reversible.</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Bạn chắc chắn muốn xóa: <span id="modal-category_name"></span>?
                    <input type="hidden" id="user_id" name="user_id">
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
@endsection

@section('footer')
    <script>
        $(document).ready(function () {
            $('.deleteUser').click(function (e) {
                e.preventDefault();
                var id = $(this).val();
                $('#modal-category_name').html(id);
                $('#user_id').val(id);
                $('#deleteCategory').modal('show');
            })
        });



        //
        var HT={};
        switchery=()=>{
            $('.js-switch').each(function(){
                var switchery = new Switchery(this, { color: '#1AB394' });
            });
        }
        $(document).ready(function(){

            switchery();

        });
    </script>

    <script src="/template/admin/js/switchery/switchery.js"></script>
@endsection
@section('head')
    <link href="/template/admin/css/switchery/switchery.css" rel="stylesheet">
@endsection
