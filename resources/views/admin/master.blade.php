<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INSPINIA | Dashboard v.2</title>

    @include('admin.components.css')
</head>

<body>
    <div id="wrapper">
        @include('admin.components.sidebar')
        <div id="page-wrapper" class="gray-bg">
            @include('admin.components.nav')
            @yield('content')
            @include('admin.components.footer')
        </div>

        @include('admin.components.js')
</body>

</html>
