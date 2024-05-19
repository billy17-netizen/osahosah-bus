<div class="p-3 shadow bg-danger danger-nav osahan-home-header">
    <div class="font-weight-normal mb-0 d-flex align-items-center">
        <img src="{{asset('frontend/assets/img/logo.png')}}" class="img-fluid osahan-nav-logo">
        <div class="ml-auto d-flex align-items-center">
            <a href="profile.html"><img src="{{asset(auth()->user()->avatar)}}"
                                        class="img-fluid rounded-circle" style="width: 31px; height: 31px"></a>
            {{--            <a class="toggle osahan-toggle h4 m-0 text-white ml-auto" href="#"><i--}}
            {{--                        class="icofont-navigation-menu"></i></a>--}}
        </div>
    </div>
</div>
