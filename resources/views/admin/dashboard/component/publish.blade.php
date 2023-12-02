
<div class="ibox w">
    <div class="ibox-title">
        {{-- <h5>{{ __('messages.image') }}</h5> --}}
        <h5>Chọn ảnh đại diện</h5>
    </div>
    <div class="ibox-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="form-row">
                    <span class="image img-cover image-target"><img src="{{ (old('image', ($postCatalogue->image) ?? '' ) ? old('image', ($postCatalogue->image) ?? '')   :  'backend/img/not-found.jpg') }}" alt=""></span>
                    <input type="hidden" name="image" value="{{ old('image', ($postCatalogue->image) ?? '' ) }}">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="ibox w">
    <div class="ibox-title">
        {{-- <h5>{{ __('messages.advange') }}</h5> --}}
        <h5>Chọn tình trạng</h5>
    </div>
    <div class="ibox-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="form-row">
                    {{-- <div class="mb15">
                        <select name="publish" class="form-control setupSelect2" id="">
                            @foreach(__('messages.publish') as $key => $val)
                            <option {{ 
                                $key == old('publish', (isset($model->publish)) ? $model->publish : '') ? 'selected' : '' 
                                }} value="{{ $key }}">{{ $val }}</option>
                            @endforeach
                        </select>
                    </div>
                    <select name="follow" class="form-control setupSelect2" id="">
                        @foreach(__('messages.follow') as $key => $val)
                        <option {{ 
                            c value="{{ $key }}">{{ $val }}</option>
                        @endforeach
                    </select> --}}
                    <div class="mb15">
                        <select name="publish" class="form-control setupSelect2" id="">
                            @foreach(config('apps.general.publish') as $key => $val)
                            <option {{ 
                                $key == old('publish', (isset($postCatalogue->publish)) ? $postCatalogue->publish : '') ? 'selected' : '' 
                                }}  
                                value="{{ $key }}">{{ $val }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb15">
                        <select name="follow" class="form-control setupSelect2" id="">
                            @foreach(config('apps.general.follow') as $key => $val)
                            <option {{ 
                                $key == old('publish', (isset($postCatalogue->follow)) ? $postCatalogue->follow : '') ? 'selected' : '' 
                                }} 
                                value="{{ $key }}">{{ $val }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>