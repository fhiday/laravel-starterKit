<div class="sidebar-menu">
        <ul class="menu">
            <li class="sidebar-title">Menu</li>

            <li class="sidebar-item {{ Request::routeIs('home') ? 'active' : '' }}">
                <a href="{{ route('home') }}" class='sidebar-link'>
                    <i class="bi bi-grid-fill"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="sidebar-item has-sub">
                <a href="#" class='sidebar-link'>
                    <i class="bi bi-grid-1x2-fill"></i>
                    <span>Layouts</span>
                </a>

                <ul class="submenu">
                    <li class="submenu-item">
                        <a href="layout-default.html" class="submenu-link">Default Layout</a>
                    </li>

                    <li class="submenu-item">
                        <a href="layout-vertical-1-column.html" class="submenu-link">1 Column</a>
                    </li>

                    <li class="submenu-item">
                        <a href="layout-vertical-navbar.html" class="submenu-link">Vertical Navbar</a>
                    </li>

                    <li class="submenu-item">
                        <a href="layout-rtl.html" class="submenu-link">RTL Layout</a>
                    </li>

                    <li class="submenu-item">
                        <a href="layout-horizontal.html" class="submenu-link">Horizontal Menu</a>
                    </li>
                </ul>
            </li>

            <!-- Users menu -->
            <li class="sidebar-title">Users Menu</li>
            <li class="sidebar-item {{ Request::routeIs('users.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('users.index') }}">
                    <i class="bi bi-gear-fill"></i>
                    <span>Manage Users</span>
                </a>
            </li>
            <li class="sidebar-item {{ Request::routeIs('roles.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('roles.index') }}">
                    <i class="bi bi-gear-fill"></i>
                    <span>Manage Roles</span>
                </a>
            </li>
            <li class="sidebar-item {{ Request::routeIs('permissions.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('permissions.index') }}">
                   <i class="bi bi-gear-fill"></i>
                    <span>Manage Permissions</span>
                </a>
            </li>
            <li class="sidebar-item {{ Request::routeIs('activity_log.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('activity_log.index') }}">
                   <i class="bi bi-gear-fill"></i>
                    <span>Log Activity</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
                   <i class="bi bi-box-arrow-left"></i>
                    <span>Logout</span>
                </a>
            </li>
        </ul>
    </div>
