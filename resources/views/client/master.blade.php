<!DOCTYPE html>
<html lang="en">

<head>
    <title>Zay Shop - Product Listing Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('client.components.css')
</head>

<body>
    <!-- Start Top Nav -->
    @include('client.components.topnav')
    <!-- Close Top Nav -->


    <!-- Header -->
    @include('client.components.header')
    <!-- Close Header -->

    <!-- Content -->
    @yield('content')
    <!-- Close Content -->


    <!-- Start Footer -->
    @include('client.components.footer')
    <!-- End Footer -->

    <!-- Start Script -->
    @include('client.components.js')
    <!-- End Script -->
</body>

</html>
