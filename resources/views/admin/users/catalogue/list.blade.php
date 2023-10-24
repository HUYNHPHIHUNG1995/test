@extends('admin.main')
@section('content')
        @include('admin.toolbox')
        @include('admin.users.catalogue.search')
        
        
       
        <table class="table table-hover text-nowrap">
            <thead>
            <tr>
                <th ><input type="checkbox" value="" id="checkAll" class="input-checkbox"></th>
                <th >Tên nhóm thành viên</th>
                <th >Ghi chú</th>
                <th class="text-center">Số thành viên</th>
                <th class="text-center">Tình trạng</th>
                <th class="text-center">Thao tác</th>
            </tr>
            </thead>
            <tbody>
            @if(isset($listCatalogueUsers) && is_object($listCatalogueUsers))
                @foreach($listCatalogueUsers as $listCatalogueUser)
                <tr>
                    <td>
                        <input type="checkbox" value="{{ $listCatalogueUser->id }}"  class="input-checkbox checkboxItem">
                    </td>
                    <td>
                        {{$listCatalogueUser->name}}
                    </td>
                    <td>
                        {{$listCatalogueUser->description}}
                    </td>
                    <td class="text-center">
                        {{$listCatalogueUser->users_count}} thành viên
                    </td>
                    <td class="text-center js-switch-{{ $listCatalogueUser->id }}">
                        <input type="checkbox" class="js-switch status" data-field="publish" data-modelId="{{ $listCatalogueUser->id }}" data-model="UserCatalogue" value="{{$listCatalogueUser->publish}}"
                              {{($listCatalogueUser->publish==1) ? 'checked' : ''}} />

                    </td>
                    <td class="text-center">
                        <a class="btn btn-primary btn-sm edit " href="{{route('editCatalogueUser',$listCatalogueUser->id)}}">Sửa
                            <i class="fas fa-edit"></i>
                        </a>
                        <button type="button" class="btn btn-danger btn-sm deleterow" value="{{$listCatalogueUser->id}}"
                                data-target="">Xóa
                                <i class="fas fa-trash"></i>
                        </button>
                        {{--onclick="loadDeleteModal({{ $listUser->id }}, '{{ $listUser->email }}','/ajax/deleteUser')"--}}
                    </td>
                </tr>
                <input hidden class="value{{ $listCatalogueUser->id }}" value="{{ $listCatalogueUser->name }}">
                @endforeach
            @endif
            </tbody>
        </table>
        {{$listCatalogueUsers->links('pagination::bootstrap-4')}}
    </div>
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
    @include('modelAlert')
@endsection

@section('footer')
<script src="{{ asset('/template/admin/js/library.js') }}"></script>
<script src="{{ asset('/template/admin/js/switchery/switchery.js') }}"></script>
@endsection
@section('head')
    <link href="{{ asset('/template/admin/css/switchery/switchery.css') }}" rel="stylesheet">
@endsection