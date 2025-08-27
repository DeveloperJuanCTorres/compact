<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Compact Seguridad') }}</title>

    <!-- Favicon básico -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <!-- Variantes para mejor compatibilidad -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('logo32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('logo16x16.png') }}">

    <!-- iOS / iPadOS -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('logo180x180.png') }}">

    <!-- Android / Chrome -->
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">

    <!-- Color de la barra en móviles -->
    <meta name="theme-color" content="#ffffff">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">  

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
     <?php
        $version = '1993.2.6';
    ?>

    <link href="{{asset('css/wpp.css')}}?v=<?php echo $version ?>" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">  -->
      
    <link href="{{asset('lib/animate/animate.min.css')}}?v=<?php echo $version ?>" rel="stylesheet">
    <link href="{{asset('lib/owlcarousel/assets/owl.carousel.min.css')}}?v=<?php echo $version ?>" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('css/style.css')}}?v=<?php echo $version ?>" rel="stylesheet">
    <link href="{{asset('css/phone.css')}}?v=<?php echo $version ?>" rel="stylesheet">

    
    

    <!-- Scripts -->
    <!-- vite(['resources/sass/app.scss', 'resources/js/app.js']) -->
</head>
<body>
    <div id="app" class="bg-light">        

        <main>
            @yield('content')
        </main>
    </div>

    <!-- JavaScript Libraries -->
     
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/fontawesome-iconpicker/3.2.0/js/fontawesome-iconpicker.min.js"></script> -->

    <script src="{{asset('lib/easing/easing.min.js')}}"></script>
    <script src="{{asset('lib/owlcarousel/owl.carousel.min.js')}}"></script>

    <!-- Contact Javascript File -->
    <script src="{{asset('mail/jqBootstrapValidation.min.js')}}"></script>
    <script src="{{asset('mail/contact.js')}}"></script>

    <!-- Template Javascript -->
    <script src="{{asset('js/main.js')}}"></script>
    <!-- <script src="{{asset('js/addcart.js')}}"></script> -->
    <script src="{{asset('js/phone.js')}}"></script>
    <script src="{{asset('js/ubigeo.js')}}"></script>
    <script src="{{asset('js/buscar.js')}}"></script>

    
    @stack('scripts')
</body>
</html>
