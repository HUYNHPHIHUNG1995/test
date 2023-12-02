<form action="{{ route('getListPostCatalogue') }}">
    <div class="filter-wrapper">
        <div class="uk-flex uk-flex-middle uk-flex-space-between">
            @include('admin.dashboard.component.perpage')
            <div class="action">
                <div class="uk-flex uk-flex-middle">
                    @include('admin.dashboard.component.filterPublish')
                    @include('admin.dashboard.component.keyword')
                    {{-- <a href="{{ route('createPostCatalogue') }}" class="btn btn-danger"><i class="fa fa-plus mr5"></i>{{ __('messages.postCatalogue.create.title') }}</a> --}}
                    <a href="{{ route('createPostCatalogue') }}" class="btn btn-danger"><i class="fa fa-plus mr5"></i>Thêm mới</a>
                </div>
            </div>
        </div>
    </div>
</form>

