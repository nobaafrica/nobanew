<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">Menu</li>
                @if (Auth::user()->isAdmin)
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect" aria-expanded="true">
                        <i class="bx bx-home"></i>
                        <span key="t-dashboards">Dashboards</span>
                    </a>
                    <ul class="sub-menu mm-collapse mm-show" aria-expanded="true" style="">
                        <li><a href="{{route('dashboard')}}" key="t-level-dashboard" aria-expanded="false">Dashboard</a></li>
                        <li><a href="{{route('admin-dashboard')}}" key="t-level-admin" aria-expanded="false">Admin</a></li>
                    </ul>
                </li>
                @else
                <li>
                    <a href="{{route('dashboard')}}" class="waves-effect">
                        <i class="bx bx-home"></i>
                        <span key="t-dashboards">Dashboard</span>
                    </a>
                </li>
                @endif
                <li>
                    <a href="{{route('wallet')}}" class="waves-effect">
                        <i class="bx bx-wallet"></i>
                        <span key="t-wallet">Wallet</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('packages')}}" class="waves-effect">
                        <i class="bx bx-basket"></i>
                        <span key="t-packages">Packages</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('partnerships')}}" class="waves-effect">
                        <i class="bx bx-box"></i>
                        <span key="t-partnerships">Partnerships</span>
                    </a>
                </li>
                
                <li>
                    <a href="{{route('profile')}}" class="waves-effect">
                        <i class="bx bx-user"></i>
                        <span key="t-calendar">Profile</span>
                    </a>
                </li>
                @if (Auth::user()->isAdmin)
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect" aria-expanded="true">
                        <i class="bx bxs-user-badge"></i>
                        <span key="t-admin">Admin</span>
                    </a>
                    <ul class="sub-menu mm-collapse mm-show" aria-expanded="true" style="">
                        <li><a href="{{route('admin-packages')}}" key="t-level-packages" aria-expanded="false">Packages</a></li>
                        <li><a href="{{route('admin-partnerships')}}" key="t-level-partnerships" aria-expanded="false">Partnerships</a></li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow" key="t-level-users" aria-expanded="true">Users</a>
                            <ul class="sub-menu mm-collapse mm-show" aria-expanded="true" style="">
                                <li><a href="{{route('clients')}}" key="t-level-users-clients">Clients</a></li>
                                <li><a href="{{route('admins')}}" key="t-level-users-admins">Admins</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                @endif
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->