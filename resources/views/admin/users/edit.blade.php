@extends('admin.main')
@section('content')
    <form action="{{route('postEditUser',$userById->id)}}" method="POST">
        <div class="card-body">
            <div style="font-style: italic;font-weight: bold">
                Những trường đánh dấu <span class="text-danger" >(*)</span> là bắt buộc
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-6">
                        <label for="email" class="text-danger">(*)Email</label>
                        <input type="text" name="email" class="form-control" id="email" value="{{old('email',($userById->email))}}" placeholder="Nhập email" required>
                    </div>
                    <div class="col-sm-6">
                        <label for="name" class="text-danger">(*)Họ tên</label>
                        <input type="text" name="name" class="form-control" id="name" value="{{old('name',($userById->name))}}" placeholder="Nhập họ tên" required>
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
                                <option  {{$key==$userById->user_catalogue_id ? 'selected' : ''}}
                                    value="{{$key}}">{{$item}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label for="name">Ngày sinh</label>
                        <input type="date" name="birthday" class="form-control" id="birthday" value="{{isset($userById->birthday) ? date('Y-m-d',strtotime($userById->birthday)) : ''}}"  placeholder="Nhập ngày sinh">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-6">
                        <label for="name">Số điện thoại</label>
                        <input type="tel" name="phone" value="{{$userById->phone}}" class="form-control" id="phone" placeholder="Nhập số điện thoại" >
                    </div>
                    <div class="col-sm-6">
                        <label for="name" >Ảnh đại diện</label>
                        <input type="text" name="image" value="{{$userById->image}}" data-type="Images" class="form-control upload-image" id="image" placeholder="Ảnh đại diện">
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
                        <input type="text" name="address" value="{{$userById->address}}" class="form-control" id="address" placeholder="Nhập địa chỉ cụ thể">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label >Mô tả</label>
                <textarea name="description" value="{{$userById->description}}" class="form-control"></textarea>
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <div class="text-right">
                <button type="submit" class="btn btn-primary" name="send" value="send">Gửi</button>
            </div>
        </div>
        @csrf
    </form>
@endsection


@section('footer')
    <script>
        var province_id = '{{(isset($userById->province_id) ? $userById->province_id : old('province_id'))  }}'
        var district_id = '{{(isset($userById->district_id) ? $userById->district_id : old('district_id'))  }}'
        var ward_id = '{{(isset($userById->ward_id) ? $userById->ward_id : old('ward_id'))  }}'


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
    <script src="{{ asset('/library/location.js') }}"></script>
    <script src="{{ asset('/template/admin/ckfinder_2/ckfinder.js') }}"></script>
    <script src="{{ asset('/library/finder.js') }}"></script>
@endsection
@section('head')
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />--}}
@endsection
