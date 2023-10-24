@extends('admin.main')
@section('content')
        @include('admin.toolbox')
        @include('admin.users.search')
        <table class="table table-hover text-nowrap">
            <thead>
            <tr>
                <th ><input type="checkbox" value="" id="checkAll" class="input-checkbox"></th>
                <th style="width:100px">Ảnh</th>
                <th >Họ Tên</th>
                <th>Email</th>
                <th>Số điện thoại</th>
                <th class="text-center">Nhóm thành viên</th>
                <th class="text-center">Tình trạng</th>
                <th class="text-center">Thao tác</th>
            </tr>
            </thead>
            <tbody>
            @if(isset($listUsers) && is_object($listUsers))
                @foreach($listUsers as $listUser)
                <tr>
                    <td>
                        <input type="checkbox" value="{{ $listUser->id }}"  class="input-checkbox checkboxItem">
                    </td>
                    <td>
                        <span class="image img-cover"><img src="{{ asset($listUser->image) }}"></span>
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
                    <td class="text-center">
                        {{ $listUser->user_catalogues->name }}
                    </td>
                    <td class="text-center js-switch-{{ $listUser->id }}">
                        <input type="checkbox" class="js-switch status" data-field="publish" data-modelId="{{ $listUser->id }}" data-model="User" value="{{$listUser->publish}}"
                              {{($listUser->publish==1) ? 'checked' : ''}} />

                    </td>
                    <td class="text-center">
                        <a class="btn btn-primary btn-sm edit " href="{{route('editUser',$listUser->id)}}">Sửa
                            <i class="fas fa-edit"></i>
                        </a>
                        <button type="button" class="btn btn-danger btn-sm deleterow" value="{{$listUser->id}}"
                                data-target="">Xóa
                                <i class="fas fa-trash"></i>
                        </button>
                        {{--onclick="loadDeleteModal({{ $listUser->id }}, '{{ $listUser->email }}','/ajax/deleteUser')"--}}
                    </td>
                </tr>
                <input hidden class="value{{ $listUser->id }}" value="{{ $listUser->email }}">
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
    @include('modelAlert')
@endsection

@section('footer')
    <script src="{{ asset('/template/admin/js/library.js')}}"></script>
    <script src="{{ asset('/template/admin/js/switchery/switchery.js')}}"></script>
@endsection
@section('head')
    <link href="{{ asset('/template/admin/css/switchery/switchery.css')}}" rel="stylesheet">
@endsection
