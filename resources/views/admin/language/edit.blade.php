@extends('admin.main')
@section('content')
    <form action="{{route('postEditLanguage',$languageById->id)}}" method="POST">
        <div class="card-body">
            <div style="font-style: italic;font-weight: bold">
                Những trường đánh dấu <span class="text-danger" >(*)</span> là bắt buộc
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-6">
                        <label for="name" class="text-danger">(*)Tên ngôn ngữ</label>
                        <input type="text" name="name" class="form-control" id="name" value="{{old('name',($languageById->name))}}" placeholder="Nhập tên ngôn ngữ" required>
                    </div>
                    <div class="col-sm-6">
                        <label class="text-danger">(*)Canonical</label>
                        <input class="form-control" name="canonical"  value="{{old('canonical',($languageById->canonical))}}" placeholder="Canonical" required>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-6">
                        <label for="name" >Ảnh đại diện</label>
                        <input type="text" name="image" class="form-control upload-image" id="image" value="{{old('image',($languageById->image))}}" placeholder="Ảnh đại diện">
                    </div>
                    <div class="col-sm-6">
                        <label >Mô tả</label>
                        <input name="description" value="{{$languageById->description}}" class="form-control">
                    </div>
                </div>
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
<script src="{{ asset('/template/admin/ckfinder_2/ckfinder.js') }}"></script>
    <script src="{{ asset('/library/finder.js') }}"></script>
@endsection
