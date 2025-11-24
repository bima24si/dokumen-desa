<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="author" content="Untree.co" />
    <link rel="shortcut icon" href="{{ asset('assets-guest/favicon.png') }}" />

    <meta name="description" content="" />
    <meta name="keywords" content="bootstrap, bootstrap4" />

    <!-- Bootstrap CSS -->
    @include('layouts.guest.css')

    <title>Dokumen Desa Ku</title>
  </head>

  <body>
    <!-- Start Header/Navigation -->
    @include('layouts.guest.navbar')

    <!-- Main Konten -->
     @yield('content')



    <!-- Start Footer Section -->
    @include('layouts.guest.footer')

    <!-- Start JS Section -->
    @include('layouts.guest.js')
  </body>
</html>
