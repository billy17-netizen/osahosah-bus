<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" href="{{asset('frontend/assets/img/logo.png')}}">
    <title>OsahanBus</title>
    <!-- Bootstrap core CSS -->
    <link href="{{asset('frontend/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    {{--    <!-- Toastr css-->--}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"
          type="text/css"/>
    <!-- Icofont Icon-->
    <link href="{{asset('frontend/assets/vendor/icons/icofont.min.css')}}" rel="stylesheet" type="text/css">
    <!-- Slick Slider -->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/vendor/slick/slick.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/vendor/slick/slick-theme.min.css')}}"/>
    <!-- Select Tool -->
    <link href="{{asset('frontend/assets/vendor/select-tool/dist/css/select2.min.css')}}" rel="stylesheet">
    <!-- fancybox -->
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css"/>
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox-thumbs.css"/>
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox-buttons.css"/>
    <!-- Sweet Alert css-->
    <link href="{{asset('admin/assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css"/>


    <!-- Custom styles for this template -->
    <link href="{{asset('frontend/assets/css/custom.css')}}" rel="stylesheet">
    <!-- Sidebar CSS -->
    <link href="{{asset('frontend/assets/vendor/sidebar/demo.css')}}" rel="stylesheet">
</head>
<!-- Preloader -->
<div class="osahan-index bg-c d-flex align-items-center justify-content-center vh-100 index-page" id="preloader">
    <div class="text-center">
        <a href="javascript:">
            <i class="icofont-bus text-white display-1 bg-danger p-4 rounded-circle"></i>
        </a><br>
        <div class="spinner"></div>
    </div>
</div>
<body class="bg-light">
<!-- verification -->
@yield('content')
<!-- Footer Fixed -->
@if(!request()->routeIs('bus-route-details') && !request()->routeIs('list-bus-routes') && !request()->routeIs('book-bus-route')&& !request()->routeIs('bus-payment') && !request()->routeIs('your-ticket') &&  !request()->routeIs('generate.qrcode')&&  !request()->routeIs('confirmation') &&  !request()->routeIs('review.index')&&  !request()->routeIs('notice.index')&&  !request()->routeIs('no-available'))
    @include('frontend.layouts.footer')
@endif
<!-- sidebar -->
{{--@include('frontend.layouts.sidebar')--}}
<!-- Bootstrap core JavaScript -->
<script src="{{asset('frontend/assets/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('frontend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- slick Slider JS-->
<script type="text/javascript" src="{{asset('frontend/assets/vendor/slick/slick.min.js')}}"></script>
<!-- Select Tool -->
<script src="{{asset('frontend/assets/vendor/select-tool/dist/js/select2.min.js')}}"></script>
<!-- Sidebar JS-->
<script type="text/javascript" src="{{asset('frontend/assets/vendor/sidebar/hc-offcanvas-nav.js')}}"></script>
<!-- Custom scripts for all pages-->
<script src="{{asset('frontend/assets/js/custom.js')}}"></script>

<!-- fancybox JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox-thumbs.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox-buttons.js"></script>

<!-- Sweet Alerts js -->
<script src="{{asset('admin/assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>

{{--<!-- Toastr js -->--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
{{--Handle requirder--}}
@if($errors->any())
    <script>
        @foreach($errors->all() as $error)
        toastr.error('{{$error}}', 'Error', {
            closeButton: true,
            progressBar: true,
        });
        @endforeach
    </script>
@endif
<script>
    $(function () {
        var $preloader = $('#preloader');
        if ($preloader.length) {
            setTimeout(function () {
                $preloader.addClass('hidden');
            }, 1000); // Add a 2-second delay before hiding the preloader
        } else {
            console.log('The preloader element was not found');
        }
    });

</script>
@stack('scripts')
</body>
</html>
