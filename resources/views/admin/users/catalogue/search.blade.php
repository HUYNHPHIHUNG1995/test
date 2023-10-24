<form action="{{route('getListCatalogueUser')}}">
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
            @php
                $publishArray=[
                    'UnPublish',
                    'Publish'
                ];
                $publish=request('publish') ?: old('publish')


            @endphp
            <div class="col-sm-4">
                <div class="form-group">
                    <select
                            class="form-control select2 select2-hidden-accessible"
                            style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true"
                             name="publish"
                        >
                        <option selected data-select2-id="3" value="-1">[Tất cả]</option>
                        @foreach($publishArray as $key=>$item)
                            <option {{ (request('publish')!='' && $publish==$key) ? 'selected' : '' }} value="{{$key}}">{{$item}}</option>
                        @endforeach
                </select>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="row">
            <div class="col-sm-6 ">
                <div class="form-group" >
                    <div class="input-group input-group-lg " >
                        <input type="search"
                               class="form-control form-control-lg text-sm"
                               placeholder="Tìm kiếm tài khoản"
                               style="height: 38px"
                               name="keyword"
                               value="{{request('keyword') ?: old('keyword')}}"
                        >
                        <div class="input-group-append" style="height: 38px">
                            <button type="submit" class="btn btn-default" >
                                <i class="fa fa-search fa-sm" ></i>
                            </button>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-sm-6" >
                <a class="btn btn-danger " href="{{route('createCatalogueUser')}}" style="font-size: 13px">
                    <i class="fas fa-plus"></i>
                    Thêm mới Nhóm
                </a>
            </div>
        </div>
    </div>
</div>
</form>
