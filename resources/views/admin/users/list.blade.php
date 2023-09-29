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
                        <input type="checkbox" class="js-switch" checked />

                    </td>
                    <td class="text-center">
                        <a class="btn btn-primary btn-sm edit" href="">Sửa
                            <i class="fas fa-edit"></i>
                        </a>
                        <a class="btn btn-danger btn-sm" href="">Xóa
                            <i class="fas fa-trash"></i>
                        </a>

                    </td>
                </tr>
                @endforeach
            @endif
            </tbody>
        </table>
        {{$listUsers->links('pagination::bootstrap-4')}}
    </div>
@endsection


@section('footer')
    <script>
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
