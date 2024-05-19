<div class="fixed-bottom p-3">
    <div class="footer-menu row m-0 bg-danger shadow rounded-2">
        <div class="col-3 p-0 text-center">
            <a href="{{route('home')}}" class="home text-white {{ Route::currentRouteNamed('home') ? 'active' : '' }}">
                <span class="icofont-ui-home h5"></span>
                <p class="mb-0 small">Home</p>
            </a>
        </div>
        <div class="col-3 p-0 text-center">
            <a href="{{route('my-tickets')}}"
               class="home text-white {{ Route::currentRouteNamed('my-tickets') ? 'active' : '' }}">
                <span class="icofont-ticket h5"></span>
                <p class="mb-0 small">My Tickets</p>
            </a>
        </div>
        <div class="col-3 p-0 text-center">
            <a href="#"
               class="home text-white">
                <span class="icofont-notification h5"></span>
                <small class="osahan-n">4</small>
                <p class="mb-0 small">Notice</p>
            </a>
        </div>
        <div class="col-3 p-0 text-center">
            <a href="{{route('profile.index')}}"
               class="home text-white {{ Route::currentRouteNamed('profile.index') ? 'active' : '' }}">
                <span class="icofont-user h5"></span>
                <p class="mb-0 small">Account</p>
            </a>
        </div>
    </div>
</div>
