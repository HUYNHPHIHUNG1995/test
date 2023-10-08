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
                        <input type="text" name="email" class="form-control" id="email" value="{{old('email')}}" placeholder="Nhập email" required>
                    </div>
                    <div class="col-sm-6">
                        <label for="name" class="text-danger">(*)Họ tên</label>
                        <input type="text" name="name" class="form-control" id="name" value="{{old('name')}}" placeholder="Nhập họ tên" required>
                    </div>
                </div>
            </div>
            @php
                $userCatalogue=[
                    '[Chọn nhóm thành viên]',
                    'Quản trị viên',
                    'Cộng tác viên'
                ];
            @endphp
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-6">
                        <label class="text-danger">(*)Chọn nhóm thành viên</label>
                        <select class="form-control user_catalogue_id" name="user_catalogue_id" required>
                            @foreach($userCatalogue as $key=>$item)
                            <option @if(old('user_catalogue_id')==$key)
                                selected @endif value="{{$key}}">{{$item}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label for="name">Ngày sinh</label>
                        <input type="date" name="birthday" class="form-control" id="birthday" value="{{old('birthday')}}"  placeholder="Nhập ngày sinh">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-6">
                        <label for="name">Số điện thoại</label>
                        <input type="tel" name="phone" value="{{old('phone')}}" class="form-control" id="phone" placeholder="Nhập số điện thoại" >
                    </div>
                    <div class="col-sm-6">
                        <label for="password" class="text-danger">(*)Mật khẩu</label>
                        <input type="password" name="password" value="{{old('password')}}" class="form-control" id="password" placeholder="Nhập mật khẩu" required>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-6">
                        <label for="name" >Ảnh đại diện</label>
                        <input type="text" name="image" value="{{old('image')}}" data-upload="Images" class="form-control input-image" id="image" placeholder="Ảnh đại diện">
                    </div>
                    <div class="col-sm-6">
                        <label for="repassword" class="text-danger">(*)Nhập lại Mật khẩu</label>
                        <input type="password" name="repassword" value="{{old('repassword')}}" class="form-control" id="repassword" placeholder="Nhập lại mật khẩu" required>
                    </div>
                </div>
            </div>
            <div class="form-group" >
                <div class="row">
                    <div class="col-sm-6 ">
                        <label >Thành phố</label>
                        <select class="form-control setupSelect2 province location"  name="province_id" data-target="districts">
                            <option value="0" class="">[Chọn thành phố]</option>
                            @if(isset($provinces))
                                @foreach($provinces as $province)
                                <option
                                value="{{$province->code}}" >{{$province->name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label >Quận/Huyện</label>
                        <select class="form-control districts location" name="district_id" data-target="wards">

                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <label >Phường/Xã</label>
                        <select class="form-control wards" name="ward_id">
                            <option value="0">[Chọn Phường/Xã]</option>
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label for="address">Address</label>
                        <input type="text" name="address" value="{{old('address')}}" class="form-control" id="address" placeholder="Nhập địa chỉ cụ thể">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label >Mô tả</label>
                <textarea name="description" value="{{old('description')}}" class="form-control"></textarea>
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
        var province_id = '{{ old('province_id') }}'
        var district_id = '{{ old('district_id') }}'
        var ward_id = '{{ old('ward_id') }}'


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
    <script src="/library/location.js"></script>
    <script src="/ckfinder/ckfinder.js"></script>
    <script src="/library/finder.js"></script>
@endsection
@section('head')
   {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />--}}
@endsection
