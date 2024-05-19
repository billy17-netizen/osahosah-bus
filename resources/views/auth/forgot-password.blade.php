{{--<x-guest-layout>--}}
{{--    <div class="mb-4 text-sm text-gray-600">--}}
{{--        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}--}}
{{--    </div>--}}

{{--    <!-- Session Status -->--}}
{{--    <x-auth-session-status class="mb-4" :status="session('status')" />--}}

{{--    <form method="POST" action="{{ route('password.email') }}">--}}
{{--        @csrf--}}

{{--        <!-- Email Address -->--}}
{{--        <div>--}}
{{--            <x-input-label for="email" :value="__('Email')" />--}}
{{--            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />--}}
{{--            <x-input-error :messages="$errors->get('email')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <div class="flex items-center justify-end mt-4">--}}
{{--            <x-primary-button>--}}
{{--                {{ __('Email Password Reset Link') }}--}}
{{--            </x-primary-button>--}}
{{--        </div>--}}
{{--    </form>--}}
{{--</x-guest-layout>--}}

        <!DOCTYPE html>
<html lang="en">

<!-- Mirrored from mobileui.store/preview/osahanbus/signin.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 07 Jul 2021 07:30:12 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" href="{{asset('frontend/assets/img/logo.png')}}">
    <title>OsahanBus - Bus Booking HTML Mobile Template</title>
    <!-- Bootstrap core CSS -->
    <link href="{{asset('frontend/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Icofont Icon-->
    <link href="{{asset('frontend/assets/vendor/icons/icofont.min.css')}}" rel="stylesheet" type="text/css">
    <!-- Slick Slider -->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/vendor/slick/slick.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/vendor/slick/slick-theme.min.css')}}"/>
    <!-- Custom styles for this template -->
    <link href="{{asset('frontend/assets/css/custom.css')}}" rel="stylesheet">
    <!-- Sidebar CSS -->
    <link href="{{asset('frontend/assets/vendor/sidebar/demo.css')}}" rel="stylesheet">
</head>
<body>
<!-- sign up -->
<div class="osahan-signup">
    <div class="osahan-header-nav shadow-sm p-3 d-flex align-items-center bg-danger">
        <h5 class="font-weight-normal mb-0 text-white">
            <a class="text-danger mr-3" href="javascript:history.back()"><i class="icofont-rounded-left back-page"></i></a>
            Forgot Password
        </h5>
    </div>
    <div class="px-3 pt-3 pb-5">
        <form action="{{route('password.email')}}" method="post">
            @csrf
            <div class="form-group">
                <label class="text-muted f-10 mb-1">Your Email</label>
                <input type="email" class="form-control" name="email" placeholder="Enter Your Email"
                       value="{{old('email')}}" required>
                <small class="form-text text-info">We will send a password reset link to this email address.</small>
            </div>
            <button type="submit" class="btn btn-danger btn-block osahanbus-btn mb-4 rounded-1 loading">EMAIL PASSWORD
                RESET
                LINK
            </button>
        </form>
    </div>
</div>
<!-- sidebar -->
{{--@include('frontend.layouts.sidebar')--}}
<!-- Bootstrap core JavaScript -->
<script src="{{asset('frontend/assets/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('frontend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- slick Slider JS-->
<script type="text/javascript" src="{{asset('frontend/assets/vendor/slick/slick.min.js')}}"></script>
<!-- Sidebar JS-->
<script type="text/javascript" src="{{asset('frontend/assets/vendor/sidebar/hc-offcanvas-nav.js')}}"></script>
<!-- Custom scripts for all pages-->
<script src="{{asset('frontend/assets/js/custom.js')}}"></script>

<script>
    $(document).ready(function () {
        $('.loading').click(function () {
            $(this).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> LOADING...');
            $(this).attr('disabled', true);
            $(this).closest('form').submit();
        });
    })
</script>

</body>

<!-- Mirrored from mobileui.store/preview/osahanbus/signin.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 07 Jul 2021 07:30:12 GMT -->
</html>
