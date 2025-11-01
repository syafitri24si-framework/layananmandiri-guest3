<!DOCTYPE html>
<html class="no-js" lang="id">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Bina Desa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- ========================= CSS here ========================= -->
   @include('layouts.guest.css')
</head>

<body>
    <!-- ========================= Header start ========================= -->
    @include('layouts.guest.header')
    <!-- ========================= Header end ========================= -->

    @yield('content')

    <!-- ========================= Footer ========================= -->
   @include('layouts.guest.footer')

    <!-- ========================= JS ========================= -->
   @include('layouts.guest.js')
</body>
</html>
