@extends('admin.dashboard.layout')
@section('content')
@include('admin.dashboard.component.breadcrumb')
<div class="row mt20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>{{ $title }} </h5>
                @include('admin.dashboard.component.toolbox', ['model' => 'User'])
            </div>
            <div class="ibox-content">
                @include('admin.user.user.filter')
                @include('admin.user.user.table')
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('/backend/js/plugins/switchery/switchery.js')}}"></script>
@endsection
@section('head')
    <link href="{{ asset('/backend/css/plugins/switchery/switchery.css')}}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
@endsection