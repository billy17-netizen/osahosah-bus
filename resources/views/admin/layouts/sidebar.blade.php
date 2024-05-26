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
                <i class="ri-boxing-line"></i> <span
                    data-key="t-bus">Pickup -
                            Dropping</span>
            </a>
            <a class="nav-link menu-link" href="{{route('admin.bus-rute.index')}}" role="button"
               aria-expanded="false">
                <i class="ri-route-fill"></i> <span
                    data-key="t-bus">Bus-Rute</span>
            </a>
            <a class="nav-link menu-link" href="{{route('admin.bus-availability.index')}}" role="button"
               aria-expanded="false">
                <i class="ri-stack-line"></i> <span
                    data-key="t-bus">Bus-Availability</span>
            </a>
            <a class="nav-link menu-link" href="{{route('admin.bus.index')}}" role="button"
               aria-expanded="false">
                <i class="ri-bus-fill"></i> <span
                    data-key="t-bus">List Bus</span>
            </a>
            <a class="nav-link menu-link" href="{{route('admin.rating.list-bus.index')}}" role="button"
               aria-expanded="false">
                <i class="ri-star-smile-fill"></i> <span
                    data-key="t-bus">Ratting - Bus</span>
            </a>
        </li>
        <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-pages">Booking</span></li>

        <li class="nav-item">
            <a class="nav-link menu-link" href="{{route('admin.booking.index')}}" role="button"
               aria-expanded="false">
                <i class="ri-pages-line"></i> <span data-key="t-pages">All Booking</span>
            </a>
            <a class="nav-link menu-link" href="{{route('admin.booking.approved')}}" role="button"
               aria-expanded="false">
                <i class=" ri-pages-fill"></i> <span data-key="t-pages">Approved Booking</span>
            </a>
            <a class="nav-link menu-link" href="{{route('admin.booking.pending')}}" role="button"
               aria-expanded="false">
                <i class=" ri-bring-forward"></i> <span data-key="t-pages">Pending Booking</span>
            </a>
            <a class="nav-link menu-link" href="{{route('admin.booking.expired')}}" role="button"
               aria-expanded="false">
                <i class=" ri-send-backward"></i> <span data-key="t-pages">Expired Booking</span>
            </a>
        </li>
    </ul>
</div>
