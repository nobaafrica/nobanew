<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">Menu</li>

                <li>
                    <a href="{{route('dashboard')}}" class="waves-effect">
                        <i class="bx bx-home"></i>
                        <span key="t-dashboards">Dashboard</span>
                    </a>
                </li>

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

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->