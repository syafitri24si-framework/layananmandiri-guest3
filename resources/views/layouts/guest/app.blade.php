<!DOCTYPE html>
<html class="no-js" lang="id">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Bina Desa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Font Awesome 6 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
      integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
      crossorigin="anonymous" referrerpolicy="no-referrer" />

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
