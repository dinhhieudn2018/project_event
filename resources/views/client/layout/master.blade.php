<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Shoppers &mdash; Colorlib e-Commerce Template</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <base href="{{ asset('')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mukta:300,400,700"> 
    <link rel="stylesheet" href="assets/client/fonts/icomoon/style.css">

    <link rel="stylesheet" href="assets/client/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/client/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/client/css/jquery-ui.css">
    <link rel="stylesheet" href="assets/client/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/client/css/owl.theme.default.min.css">

    <link rel="stylesheet" type="text/css" href="assets/admin/dist/css/toastr.min.css">
    <link rel="stylesheet" href="assets/client/css/aos.css">

    <link rel="stylesheet" href="assets/client/css/style.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
  </head>
  <body>
  
  <div class="site-wrap">
    @include('client.layout.header')

    @yield('slide')

    {{-- @include('client.layout.content') --}}
    @yield('content')
    @include('client.layout.footer')
    @yield('script')
  </div>

  
    
  </body>
</html>