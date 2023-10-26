@include('admin.dashboard.component.breadcrumb')
@include('admin.dashboard.component.formError')
@php
    $url = ($config['method'] == 'create') ? route('post.catalogue.store') : route('post.catalogue.update', $postCatalogue->id);
@endphp
<form action="{{ $url }}" method="post" class="box">
    @csrf
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-9">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>{{ __('messages.tableHeading') }}</h5>
                    </div>
                    <div class="ibox-content">
                        @include('backend.dashboard.component.content', ['model' => ($postCatalogue) ?? null])
                    </div>
                </div>
               @include('admin.dashboard.component.album', ['model' => ($postCatalogue) ?? null])
               @include('admin.dashboard.component.seo', ['model' => ($postCatalogue) ?? null])
            </div>
            <div class="col-lg-3">
                @include('admin.post.catalogue.component.aside')
            </div>
        </div>
        @include('admin.dashboard.component.button')
    </div>
</form>
