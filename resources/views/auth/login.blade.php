{{--<x-guest-layout>--}}
{{--    <!-- Session Status -->--}}
{{--    <x-auth-session-status class="mb-4" :status="session('status')" />--}}

{{--    <form method="POST" action="{{ route('login') }}">--}}
{{--        @csrf--}}

{{--        <!-- Email Address -->--}}
{{--        <div>--}}
{{--            <x-input-label for="email" :value="__('Email')" />--}}
{{--            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />--}}
{{--            <x-input-error :messages="$errors->get('email')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <!-- Password -->--}}
{{--        <div class="mt-4">--}}
{{--            <x-input-label for="password" :value="__('Password')" />--}}

{{--            <x-text-input id="password" class="block mt-1 w-full"--}}
{{--                            type="password"--}}
{{--                            name="password"--}}
{{--                            required autocomplete="current-password" />--}}

{{--            <x-input-error :messages="$errors->get('password')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <!-- Remember Me -->--}}
{{--        <div class="block mt-4">--}}
{{--            <label for="remember_me" class="inline-flex items-center">--}}
{{--                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">--}}
{{--                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>--}}
{{--            </label>--}}
{{--        </div>--}}

{{--        <div class="flex items-center justify-end mt-4">--}}
{{--            @if (Route::has('password.request'))--}}
{{--                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">--}}
{{--                    {{ __('Forgot your password?') }}--}}
{{--                </a>--}}
{{--            @endif--}}

{{--            <x-primary-button class="ms-3">--}}
{{--                {{ __('Log in') }}--}}
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
            <a class="text-danger mr-3" href="{{url()->previous()}}"><i class="icofont-rounded-left back-page"></i></a>
            Sign in to your account
        </h5>
    </div>
    <div class="px-3 pt-3 pb-5">
        <form action="{{route('login')}}" method="post">
            @csrf
            <div class="form-group">
                <label class="text-muted f-10 mb-1">Your Email</label>
                <input type="email" class="form-control" name="email" placeholder="Enter Your Email"
                       value="{{old('email')}}" required>
                @error('email') <span class="text-danger">{{$message}}</span> @enderror
            </div>
            <div class=" form-group">
                <label class="text-muted f-10 mb-1">Password</label>
                <input type="password" class="form-control" placeholder="Enter Your Password" name="password" required>
                @error('password') <span class="text-danger">{{$message}}</span> @enderror
            </div>
            <div class="text-right mb-3">
                <a href="{{route('password.request')}}" class="text-muted small">Forgot your password?</a>
            </div>
            <button type="submit" class="btn btn-danger btn-block osahanbus-btn mb-4 rounded-1 loading">SIGN IN</button>
        </form>
        <div class="sign-or d-flex align-items-center justify-content-center mb-4">
            <hr class="mr-4">
            <p class="text-muted text-center py-2 m-0">OR</p>
            <hr class="ml-4">
        </div>
        <a href="verification.html" class="btn btn-block rounded-1 google-btn osahanbus-social">
            <i class="icofont-google-plus"></i> LOGIN WITH GOOGLE
        </a>
        <a href="verification.html" class="my-3 btn btn-block rounded-1 fb-btn osahanbus-social">
            <i class="icofont-facebook"></i> LOGIN WITH FACEBOOK
        </a>
        <div class="osahan-signin text-center p-1">
            <p class="m-0">Not a member ? <a href="{{route('register')}}" class="text-danger ml-2">Sign Up</a></p>
        </div>
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