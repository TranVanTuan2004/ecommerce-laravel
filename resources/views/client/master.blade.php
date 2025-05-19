<!DOCTYPE html>
<html lang="en">

<head>
    <title>Zay Shop - Product Listing Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('client.components.css')
    @push('styles')

    @endpush
</head>

<body>
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
    @yield('scripts')
    <!-- End Script -->
</body>

</html>