<nav>
    <div class="sidebar-top">
        <span class="shrink-btn">
            <i class="bx bx-chevron-left"></i>
        </span>
        <img src="{{ asset('img\logo.png') }}" alt="" class="logo">
        <h3 class="hide">Parking Apps</h3>
    </div>

    <div class="sidebar-links">
        <ul>
            <div class="active-tab"></div>
            <li class="tooltip-element" data-tooltip="0">
                <a href="#" class="active" data-active="0">
                    <div class="icon">
                        <i class="bx bx-tachometer"></i>
                        <i class="bx bxs-tachometer"></i>
                    </div>
                    <span class="link hide">Dashboard</span>
                </a>
            </li>
            <li class="tooltip-element" data-tooltip="1">
                <a href="#" data-active="1">
                    <div class="icon">
                        <i class='bx bxs-parking'></i>
                        <i class='bx bxs-parking'></i>
                    </div>
                    <span class="link hide">Parkir</span>
                </a>
            </li>
            <li class="tooltip-element" data-tooltip="2">
                <a href="#" data-active="2">
                    <div class="icon">
                        <i class='bx bx-dollar-circle'></i>
                        <i class='bx bxs-dollar-circle'></i>
                    </div>
                    <span class="link hide">Tarif</span>
                </a>
            </li>

            <div class="tooltip">
                <span class="show">Dashboard</span>
                <span>Parkir</span>
                <span>Tarif</span>
            </div>
        </ul>
    </div>

    <div class="sidebar-footer">
        <a href="#" class="account tooltip-element" data-tooltip="0">
            <i class='bx bx-user'></i>
        </a>
        <div class="admin-user tooltip-element" data-tooltip="1">
            <div class="admin-profile hide">
                <img src="{{ asset('img\face-1.png') }}" alt="">
                <div class="admin-info">
                    <h3>John Doe</h3>
                    <h5>Admin</h5>
                </div>
            </div>
            <a href="#" class="log-out">
                <i class="bx bx-log-out"></i>
            </a>
        </div>

        <div class="tooltip">
            <span class="show">John Doe</span>
            <span>Logout</span>
        </div>

    </div>
</nav>
