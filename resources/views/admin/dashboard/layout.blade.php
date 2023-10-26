<!DOCTYPE html>
<html>

<head>
    @include('admin.dashboard.component.head')

</head>

    <body>
        <div id="wrapper">
            @include('admin.dashboard.component.sidebar')

            <div id="page-wrapper" class="gray-bg">
                @include('admin.dashboard.component.nav')
                @yield('content')
                @include('admin.dashboard.component.footer')
            </div>
        </div>
        @include('admin.dashboard.component.script')
    </body>
</html>
