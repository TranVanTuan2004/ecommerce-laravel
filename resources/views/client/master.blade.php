<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
