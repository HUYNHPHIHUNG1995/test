@extends('admin.dashboard.layout')
@section('content')
@include('admin.dashboard.component.breadcrumb')
@include('admin.dashboard.component.formError')
@php
    $url = ($config['method'] == 'create') ? route('postAddPostCatalogue') : route('postEditPostCatalogue', $postCatalogue->id);
@endphp
<form action="{{ $url }}" method="post" class="box">
    @csrf
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-9">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Thông tin chung</h5>
                    </div>
                    <div class="ibox-content">
                        @include('admin.dashboard.component.content')
                    </div>
                </div>
               @include('admin.dashboard.component.album')
               @include('admin.dashboard.component.seo')
            </div>
            <div class="col-lg-3">
                @include('admin.post.catalogue.component.aside')
            </div>
        </div>
        @include('admin.dashboard.component.button')
    </div>
</form>
@endsection
@section('footer')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="backend/plugins/ckfinder_2/ckfinder.js"></script>
    <script src="backend/library/finder.js"></script>
    <script src="backend/library/seo.js"></script>
    <script src="backend/plugins/ckeditor/ckeditor.js"></script>
@endsection
@section('head')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
@endsection