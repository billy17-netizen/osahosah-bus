{{--<x-guest-layout>--}}
{{--    <form method="POST" action="{{ route('register') }}">--}}
{{--        @csrf--}}

{{--        <!-- Name -->--}}
{{--        <div>--}}
{{--            <x-input-label for="name" :value="__('Name')" />--}}
{{--            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />--}}
{{--            <x-input-error :messages="$errors->get('name')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <!-- Email Address -->--}}
{{--        <div class="mt-4">--}}
{{--            <x-input-label for="email" :value="__('Email')" />--}}
{{--            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />--}}
{{--            <x-input-error :messages="$errors->get('email')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <!-- Password -->--}}
{{--        <div class="mt-4">--}}
{{--            <x-input-label for="password" :value="__('Password')" />--}}

{{--            <x-text-input id="password" class="block mt-1 w-full"--}}
{{--                            type="password"--}}
{{--                            name="password"--}}
{{--                            required autocomplete="new-password" />--}}

{{--            <x-input-error :messages="$errors->get('password')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <!-- Confirm Password -->--}}
{{--        <div class="mt-4">--}}
{{--            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />--}}

{{--            <x-text-input id="password_confirmation" class="block mt-1 w-full"--}}
{{--                            type="password"--}}
{{--                            name="password_confirmation" required autocomplete="new-password" />--}}

{{--            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <div class="flex items-center justify-end mt-4">--}}
{{--            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">--}}
{{--                {{ __('Already registered?') }}--}}
{{--            </a>--}}

{{--            <x-primary-button class="ms-4">--}}
{{--                {{ __('Register') }}--}}
{{--            </x-primary-button>--}}
{{--        </div>--}}
{{--    </form>--}}
{{--</x-guest-layout>--}}

    <!DOCTYPE html>
<html lang="en">

<!-- Mirrored from mobileui.store/preview/osahanbus/signup.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 07 Jul 2021 07:30:12 GMT -->
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
            {{--back previous route--}}
            <a class="text-danger mr-3" href="javascript:history.back()"><i class="icofont-rounded-left back-page"></i></a>
            Create an account
        </h5>
    </div>
    <div class="p-3">
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="text-muted f-10 mb-1">Your Name</label>
                <input type="text" class="form-control" name="name" placeholder="Enter Your Name"
                       value="{{old('name')}}">
                @error('name') <span class="text-danger">{{$message}}</span> @enderror
            </div>
            <div class="form-group">
                <label class="text-muted f-10 mb-1">Your Email</label>
                <input type="email" class="form-control" name="email" placeholder="Enter Your Email"
                       value="{{old('email')}}">
                @error('email') <span class="text-danger">{{$message}}</span> @enderror
            </div>
            <div class="form-group">
                <label class="text-muted f-10 mb-1">Your Mobile Number</label>
                <input type="text" class="form-control" name="mobile_number" placeholder="Enter Your Mobile Number"
                       value="{{old('mobile_number')}}">
                @error('mobile_number') <span class="text-danger">{{$message}}</span> @enderror
            </div>
            <div class="form-group">
                <label class="text-muted f-10 mb-1">Your Address</label>
                <textarea class="form-control" name="address" placeholder="Enter Your Address"></textarea>
                @error('address') <span class="text-danger">{{$message}}</span> @enderror
            </div>
            <div class="form-group">
                <label class="text-muted f-10 mb-1">Password</label>
                <input type="password" class="form-control" name="password" placeholder="Enter Your Password">
                @error('password') <span class="text-danger">{{$message}}</span> @enderror
            </div>
            <div class="form-group">
                <label class="text-muted f-10 mb-1">Confirm Password</label>
                <input type="password" class="form-control" name="password_confirmation"
                       placeholder="Enter Your Password">
                @error('password_confirmation') <span class="text-danger">{{$message}}</span> @enderror
            </div>
            <button type="submit" class="btn btn-danger btn-block osahanbus-btn mb-3 rounded-1 mt-4 loading">CREATE AN
                ACCOUNT
            </button>
            <p class="text-muted text-center small">By signing up you agree to our Privacy Policy and Terms.</p>
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

<!-- Mirrored from mobileui.store/preview/osahanbus/signup.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 07 Jul 2021 07:30:12 GMT -->
</html>
