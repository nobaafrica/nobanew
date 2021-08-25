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
                        <i class="bx bx-user"></i>
                        <span key="t-wallet">Wallet</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-box"></i>
                        <span key="t-portfolio">Portfolio</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('packages')}}" key="t-packages">Packages</a></li>
                        <li><a href="{{route('partnerships')}}" key="t-partnerships">Partnerships</a></li>
                    </ul>
                </li>
                
                <li>
                    <a href="calendar.html" class="waves-effect">
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