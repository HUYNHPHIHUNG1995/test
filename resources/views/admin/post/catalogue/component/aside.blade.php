<div class="ibox w">
    <div class="ibox-title">
        {{-- <h5>{{ __('messages.parent') }}</h5> --}}
        <h5>Chọn danh mục cha</h5>
    </div>
    <div class="ibox-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="form-row">
                    {{-- <span class="text-danger notice" >*{{ __('messages.parentNotice') }}</span> --}}
                    <span class="text-danger notice" >*Chọn root nếu không có danh mục cha</span>
                    <select name="parent_id" class="form-control setupSelect2" id="">
                        @foreach($dropdown as $key => $val)
                        <option {{ 
                            $key == old('parent_id', (isset($postCatalogue->parent_id)) ? $postCatalogue->parent_id : '') ? 'selected' : '' 
                            }} value="{{ $key }}">{{ $val }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.dashboard.component.publish')