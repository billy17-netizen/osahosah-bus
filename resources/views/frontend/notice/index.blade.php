@extends('frontend.layouts.master')

@section('content')
    <!-- 404 Error -->
    <div class="vh-100 osahan-coming-soon p-4 d-flex justify-content-center align-items-center">
        <div class="osahan-text text-center">
            <div class="osahan-img px-3 pb-1">
                <img src="{{asset('frontend/assets/img/not-found.svg')}}" class="img-fluid mb-1">
            </div>
            <h2 class="mb-3 font-weight-bold text-danger">Page not <b>found</b></h2>
            <p class="lead small mb-0">Oops! Looks like you followed a bad link.</p>
            <p class="mb-5">If you think this is a problem with us, please <a class="text-danger" href="#">tell
                    us</a>.</p>
            <a href="{{route('home')}}" class="btn btn-danger px-5 osahanbus-btn rounded-1 mt-4">Go Back</a>
        </div>
    </div>
@endsection
