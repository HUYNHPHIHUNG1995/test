@extends('admin.main')
@section('content')
    <form action="{{route('postAddUser')}}" method="POST">
        <div class="card-body">
            <div style="font-style: italic;font-weight: bold">
                Những trường đánh dấu <span class="text-danger" >(*)</span> là bắt buộc
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-6">
                        <label for="email" class="text-danger">(*)Email</label>
                        <input type="text" name="email" class="form-control" id="email" placeholder="Nhập email" required>
                    </div>
                    <div class="col-sm-6">
                        <label for="name" class="text-danger">(*)Họ tên</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Nhập họ tên" required>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-6">
                        <label class="text-danger">(*)Chọn nhóm thành viên</label>
                        <select class="form-control" name="role_id" required>
                            <option value="0">Quản trị viên</option>
                            <option value="1">Cộng tác viên</option>
                            <option value="2">Thành viên</option>
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label for="name">Ngày sinh</label>
                        <input type="date" name="birthday" class="form-control" id="birthday" placeholder="Nhập ngày sinh">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-6">
                        <label for="name">Số điện thoại</label>
                        <input type="tel" name="phone" class="form-control" id="phone" placeholder="Nhập số điện thoại" pattern="[0-9]{9}">
                    </div>
                    <div class="col-sm-6">
                        <label for="password" class="text-danger">(*)Mật khẩu</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Nhập mật khẩu" required>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-6">
                        <label for="name" >Ảnh đại diện</label>
                        <input type="file" name="image" class="form-control" id="image" placeholder="Ảnh đại diện">
                    </div>
                    <div class="col-sm-6">
                        <label for="repassword" class="text-danger">(*)Nhập lại Mật khẩu</label>
                        <input type="password" name="repassword" class="form-control" id="repassword" placeholder="Nhập lại mật khẩu" required>
                    </div>
                </div>
            </div>
            <div class="form-group" >
                <div class="row">
                    <div class="col-sm-6 ">
                        <label >Thành phố</label>
                        <select class="form-control setupSelect2 province" name="province_id ">
                            <option value="0" class="">[Chọn thành phố]</option>
                            @if(isset($provinces))
                                @foreach($provinces as $province)
                                <option value="{{$province->code}}" >{{$province->name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label >Quận/Huyện</label>
                        <select class="form-control district" name="district_id">

                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <label >Phường/Xã</label>
                        <select class="form-control" name="ward_id">
                            <option value="0">[Chọn Phường/Xã]</option>
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label for="address">Address</label>
                        <input type="text" name="address" class="form-control" id="address" placeholder="Nhập địa chỉ cụ thể">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label >Mô tả</label>
                <textarea name="description" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label>Kích Hoạt</label>
                <div class="row">
                    <div class="custom-control custom-radio" style="margin-right: 10px">
                        <input class="custom-control-input" value="1" type="radio" id="active" name="active" checked="">
                        <label for="active" class="custom-control-label">Có</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" value="0" type="radio" id="no_active" name="active" >
                        <label for="no_active" class="custom-control-label">Không</label>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <div class="text-right">
                <button type="submit" class="btn btn-primary" name="send" value="send">Tạo danh mục</button>
            </div>
        </div>
        @csrf
    </form>
@endsection


@section('footer')
    <script>
        province=()=>{
            $(document).on('change','.province',function () {
               let _this=$(this)
                let province_id=_this.val()
                $.ajax({
                    url:'ajax/location/getLocation',
                    data:{
                        'province_id':province_id
                    },
                    type:'GET',
                    dataType:'json',
                    success:function(res){
                        $('.district').html(res.html)
                    },
                    error:function(){

                    }
                });
            });
        }
        $(document).ready(function(){
            province();
        });
    </script>
    {{--<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        select2=()=>{
            $('.setupSelect2').select2();
        }
        $(document).ready(function(){
            select2();
        });
    </script>--}}

@endsection
@section('head')
   {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />--}}


@endsection
