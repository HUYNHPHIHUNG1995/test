@extends('admin.main')


@section('content')
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
            <tr>
                <th >ID</th>
                <th>Name</th>
                <th>Active</th>
                <th>Update</th>
                <th>&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            {!! \App\Helpers\Helper::menu($menus) !!}
            </tbody>
        </table>
    </div>
@endsection
