<div class="ibox">
    <div class="ibox-title">
        {{-- <h5>{{ __('messages.seo') }}</h5> --}}
        <h5>Cấu hình SEO</h5>
    </div>
    <div class="ibox-content">
        <div class="seo-container">
            <div class="meta-title">
                {{ 
                    (old('meta-title',($postCatalogue->meta_title) ?? '')) ?? 'Bạn chưa có tiêu đề SEO'
                }} 
                </div>
            <div class="canonical">{{ (old('canonical', ($postCatalogue->canonical) ?? '')) ? config('app.url').old('canonical', ($postCatalogue->canonical) ?? '').config('apps.general.suffix') :  __('messages.seoCanonical')  }}</div>

            <div class="meta-description">
                {{ 
                    (old('meta-description',($postCatalogue->meta_description) ?? '')) ?? 'Bạn chưa có tiêu đề SEO'
                }} 
            </div>
        </div>
        <div class="seo-wrapper">
            <div class="row mb15">
                <div class="col-lg-12">
                    <div class="form-row">
                        <label for="" class="control-label text-left">
                            <div class="uk-flex uk-flex-middle uk-flex-space-between">
                                {{-- <span>{{ __('messages.seoMetaTitle') }}</span>
                                <span class="count_meta-title">0 {{ __('messages.character') }}</span> --}}
                                <span>Mô tả SEO</span>
                                <span class="count_meta-title">0 ký tự</span>

                            </div>
                        </label>
                        <input 
                            type="text"
                            name="meta_title"
                            value="{{ old('meta_title', ($postCatalogue->meta_title) ?? '' ) }}"
                            class="form-control"
                            placeholder=""
                            autocomplete="off"
                            {{ (isset($disabled)) ? 'disabled' : '' }}
                        >
                    </div>
                </div>
            </div>
            <div class="row mb15">
                <div class="col-lg-12">
                    <div class="form-row">
                        <label for="" class="control-label text-left">
                            {{-- <span>{{ __('messages.seoMetaKeyword') }}</span> --}}
                            <span>Từ khóa SEO</span>
                        </label>
                        <input 
                            type="text"
                            name="meta_keyword"
                            value="{{ old('meta_keyword', ($postCatalogue->meta_keyword) ?? '' ) }}"
                            class="form-control"
                            placeholder=""
                            autocomplete="off"
                            {{ (isset($disabled)) ? 'disabled' : '' }}
                        >
                    </div>
                </div>
            </div>
            <div class="row mb15">
                <div class="col-lg-12">
                    <div class="form-row">
                        <label for="" class="control-label text-left">
                            <div class="uk-flex uk-flex-middle uk-flex-space-between">
                                {{-- <span>{{ __('messages.seoMetaDescription') }}</span>
                                <span class="count_meta-description">0 {{ __('messages.character') }}</span> --}}
                                <span>Mô tả SEO</span>
                                <span class="count_meta-description">0 ký tự</span>
                            </div>
                        </label>
                        <textarea 
                            name="meta_description"
                            class="form-control"
                            placeholder=""
                            autocomplete="off"
                            {{ (isset($disabled)) ? 'disabled' : '' }}
                        >{{ old('meta_description', ($postCatalogue->meta_description) ?? '') }}</textarea>
                    </div>
                </div>
            </div>
            <div class="row mb15">
                <div class="col-lg-12">
                    <div class="form-row">
                        <label for="" class="control-label text-left">
                            {{-- <span>{{ __('messages.canonical') }} <span class="text-danger">*</span></span> --}}
                            <span>Canonical <span class="text-danger">*</span></span>
                        </label>
                       <div class="input-wrapper">
                            <input 
                                type="text"
                                name="canonical"
                                value="{{ old('canonical', ($postCatalogue->canonical) ?? '' ) }}"
                                class="form-control seo-canonical"
                                placeholder=""
                                autocomplete="off"
                                {{ (isset($disabled)) ? 'disabled' : '' }}
                            >
                            <span class="baseUrl">{{ config('app.url') }}</span>
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>