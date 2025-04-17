<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INSPINIA | Dashboard v.2</title>

    @include('admin.dashboard.components.css')
</head>

<body>
    <div id="wrapper">
        @include('admin.dashboard.components.sidebar')
        <div id="page-wrapper" class="gray-bg">
            @include('admin.dashboard.components.nav')
            @yield('content')
            @include('admin.dashboard.components.footer')
        </div>
    </div>

    @include('admin.dashboard.components.js')
</body>

</html>
