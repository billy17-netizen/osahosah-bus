<div class="container-fluid">
    <div id="two-column-menu">
    </div>
    <ul class="navbar-nav" id="navbar-nav">
        <li class="menu-title"><span data-key="t-menu">Menu</span></li>
        <li class="nav-item">
            <a class="nav-link menu-link" href="{{route('admin.dashboard')}}" role="button"
               aria-expanded="false" aria-controls="sidebarDashboards">
                <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Dashboards</span>
            </a>
        </li> <!-- end Dashboard Menu -->

        <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-pages">Bus</span></li>

        <li class="nav-item">
            <a class="nav-link menu-link" href="{{route('admin.pickup-dropping.index')}}" role="button"
               aria-expanded="false">
                <i class="ri-account-circle-line"></i> <span
                    data-key="t-bus">Pickup -
                            Dropping</span>
            </a>
            <a class="nav-link menu-link" href="{{route('admin.bus-rute.index')}}" role="button"
               aria-expanded="false">
                <i class="ri-account-circle-line"></i> <span
                    data-key="t-bus">Bus-Rute</span>
            </a>
            <a class="nav-link menu-link" href="{{route('admin.bus-availability.index')}}" role="button"
               aria-expanded="false">
                <i class="ri-account-circle-line"></i> <span
                    data-key="t-bus">List Bus-Availability</span>
            </a>
            <a class="nav-link menu-link" href="{{route('admin.bus.index')}}" role="button"
               aria-expanded="false">
                <i class="ri-account-circle-line"></i> <span
                    data-key="t-bus">List Bus</span>
            </a>
        </li>
        <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-pages">Booking</span></li>

        <li class="nav-item">
            <a class="nav-link menu-link" href="{{route('admin.booking.index')}}" role="button"
               aria-expanded="false">
                <i class="ri-pages-line"></i> <span data-key="t-pages">All Booking</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link menu-link" href="#sidebarLanding" data-bs-toggle="collapse" role="button"
               aria-expanded="false" aria-controls="sidebarLanding">
                <i class="ri-rocket-line"></i> <span data-key="t-landing">Landing</span>
            </a>
            <div class="collapse menu-dropdown" id="sidebarLanding">
                <ul class="nav nav-sm flex-column">
                    <li class="nav-item">
                        <a href="landing.html" class="nav-link" data-key="t-one-page"> One Page </a>
                    </li>
                    <li class="nav-item">
                        <a href="nft-landing.html" class="nav-link" data-key="t-nft-landing"> NFT
                            Landing </a>
                    </li>
                    <li class="nav-item">
                        <a href="job-landing.html" class="nav-link" data-key="t-job">Job</a>
                    </li>
                </ul>
            </div>
        </li>

    </ul>
</div>
