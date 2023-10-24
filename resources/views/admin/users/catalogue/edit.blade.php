@extends('admin.main')
@section('content')
    <form action="{{route('postEditCatalogueUser',$userCatalogueById->id)}}" method="POST">
        <div class="card-body">
            <div style="font-style: italic;font-weight: bold">
                Những trường đánh dấu <span class="text-danger" >(*)</span> là bắt buộc
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-6">
                        <label for="name" class="text-danger">(*)Họ tên</label>
                        <input type="text" name="name" class="form-control" id="name" value="{{old('name',($userCatalogueById->name))}}" placeholder="Nhập họ tên" required>
                    </div>
                    <div class="col-sm-6">
                        <label >Mô tả</label>
                        <input name="description" value="{{$userCatalogueById->description}}" class="form-control">
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

