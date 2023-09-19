@extends('admin.main')

@section('head')
    <script src="/ckeditor/ckeditor.js"></script>
@endsection

@section('content')
    <form action="{{route('postAddMenu')}}" method="POST">
        <div class="card-body">
            <div class="form-group">
                <label for="menu">Tên danh mục</label>
                <input type="text" name="name" value="{{$menu->name}}" class="form-control" placeholder="Nhập tên danh mục">
            </div>
            <div class="form-group">
                <label >Danh mục</label>
                <select class="form-control" name="parent_id">
                    <option value="0" {{$menu->parent_id==0 ? 'selected' : ''}}>Danh mục cha</option> {{--neu la danh muc cha thi chon danh muc cha--}}
                    @foreach($menus as $menuParent)
                        <option value="{{$menuParent->id}}" {{$menu->parent_id==$menuParent->id ? 'selected' : ''}}>{{$menuParent->name}}</option> {{--neu la danh muc con thi chon ten danh muc cha--}}
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label >Mô tả</label>
                <textarea name="description" class="form-control"> {{$menu->description}}</textarea>
            </div>
            <div class="form-group">
                <label >Nội dung</label>
                <textarea name="content" id="content" class="form-control">{{$menu->content}}</textarea>
            </div>
            <div class="form-group">
                <label>Kích Hoạt</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="1" type="radio" id="active" name="active" checked="" {{$menu->active==1 ? 'checked=""' : ''}}>
                    <label for="active" class="custom-control-label">Có</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="0" type="radio" id="no_active" name="active" {{$menu->active==0 ? 'checked=""' : ''}}>
                    <label for="no_active" class="custom-control-label">Không</label>
                </div>
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Cập nhật danh mục danh mục</button>
        </div>
        @csrf
    </form>
@endsection


@section('footer')
    {{-- thay the form content --}}
    <script>
        ClassicEditor
            .create( document.querySelector( '#content' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endsection
