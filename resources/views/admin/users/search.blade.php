<form action="{{route('getListUser')}}">
<div class="row col-sm-12" style="margin-bottom: 10px;margin-top: 30px;">
    <div class="col-sm-6">
        <div class="row">
            <div class="col-sm-4">
                @php
                    $perpage=request('perpage') ?: old('perpage')
                @endphp
                <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true"
                        name="perpage"
                >
                    @for($i=20;$i<=200;$i+=20)
                    <option
                        {{($perpage==$i) ? 'selected' : ''}}
                        value="{{$i}}">{{$i}} Bản ghi</option>
                    @endfor
                </select>
            </div>
            <div class="col-sm-8">
                <div class="form-group">
                    <select
                        class="form-control select2 select2-hidden-accessible"
                        style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true"
                        name="user_catalogue_id"
                    >
                        <option selected="selected" data-select2-id="3" value="0">Nhóm thành viên</option>
                        <option data-select2-id="35" value="1">Quản trị viên</option>
                        <option data-select2-id="35" value="2">Cộng tác viên</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group" >
                    <div class="input-group input-group-lg" >
                        <input type="search"
                               class="form-control form-control-lg"
                               placeholder="Tìm kiếm tài khoản"
                               style="height: 38px"
                               name="keyword"
                               value="{{request('keyword') ?: old('keyword')}}"
                        >
                        <div class="input-group-append" style="height: 38px">
                            <button type="submit" class="btn btn-lg btn-default" >
                                <i class="fa fa-search" ></i>
                            </button>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-sm-6" >
                <a class="btn btn-danger " href="{{route('createUser')}}" style="font-size: 13px">
                    <i class="fas fa-plus"></i>
                    Thêm mới thành viên
                </a>
            </div>
        </div>
    </div>
</div>
</form>
