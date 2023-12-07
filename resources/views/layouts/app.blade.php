<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Restaurant Test</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="icon" type="image/png" href="img/favicon.png">
    <!-- Bootstrap core CSS-->
    <link href="{{ asset('frontend/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome-->
    <link href="{{ asset('frontend/vendor/fontawesome/css/all.min.css') }}" rel="stylesheet">
    <!-- Font Awesome-->
    <link href="{{ asset('frontend/vendor/icofont/icofont.min.css') }}" rel="stylesheet">
    <!-- Select2 CSS-->
    <link href="{{ asset('frontend/vendor/select2/css/select2.min.css') }}" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="{{ asset('frontend/css/osahan.css') }}" rel="stylesheet">
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="{{ asset('frontend/vendor/owl-carousel/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/vendor/owl-carousel/owl.theme.css') }}">
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        a{
            text-decoration: none;
        }
        .p-20{
            padding: 5%;
        }
        </style>
        
</head>
<body>
    
    <div id="app">
@include('layouts.frontend.navbar')

        <main>
            @yield('content')
        </main>

        <div id="layoutAuthentication_footer">
            @include('layouts.frontend.footer')
        </div>

    </div>


      <!-- jQuery -->
      <script src="{{ asset('frontend/vendor/jquery/jquery-3.3.1.slim.min.js') }}"></script>
      <!-- Bootstrap core JavaScript-->
      <script src="{{ asset('frontend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
      <!-- Select2 JavaScript-->
      <script src="{{ asset('frontend/vendor/select2/js/select2.min.js') }}"></script>
      <!-- Owl Carousel -->
      <script src="{{ asset('frontend/vendor/owl-carousel/owl.carousel.js') }}"></script>
      <!-- Custom scripts for all pages-->
      <script src="{{ asset('frontend/js/custom.js') }}"></script>

    <!-- Initialize Toastr -->
<script>
    // Ensure Toastr is available before calling toastr() function
    if (typeof toastr === 'function') {
        // Initialize Toastr options (customize as needed)
        toastr.options = {
            closeButton: true,
            progressBar: true,
            positionClass: 'toast-top-right',
            timeOut: 5000,
        };
    }
</script>

<script>
    window.addEventListener('message', event => {
        console.log('Message event triggered');
        console.log('Event details:', event.detail);
        const eventData = event.detail[0];
        alertify.set('notifier', 'position', 'top-right');
        alertify.notify(eventData.text, eventData.type);
    });
</script>


</body>
</html>
