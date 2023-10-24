@extends('admin.main')
@section('content')
    <form action="{{route('postAddCatalogueUser')}}" method="POST">
        <div class="card-body">
            <div style="font-style: italic;font-weight: bold">
                Những trường đánh dấu <span class="text-danger" >(*)</span> là bắt buộc
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-6">
                        <label for="name" class="text-danger">(*)Tên nhóm</label>
                        <input type="text" name="name" class="form-control" id="name" value="{{old('name')}}" placeholder="Nhập họ tên" required>
                    </div>
                    <div class="col-sm-6">
                        <label >Mô tả</label>
                        <input class="form-control" name="description" value="{{old('description')}}" placeholder="Ghi chú">
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

