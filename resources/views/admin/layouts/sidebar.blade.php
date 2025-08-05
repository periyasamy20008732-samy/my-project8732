<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <!-- Dashboard -->
                <li class="submenu-open">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="subdrop active">
                        <i data-feather="grid"></i><span>Dashboard</span>
                    </a>
                </li>
                </li>
                <!-- Peoples -->
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Peoples</h6>
                    <ul>
                        <li>
                            <a href="{{ route('admin.customer.index') }}">
                                <i data-feather="users"></i> <span>Customers</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i data-feather="users"></i> <span>Reseller</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i data-feather="user"></i> <span>Users</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">App Data</h6>
                    <ul>
                        <li>
                            <a href="{{ route('admin.package.index') }}">
                                <i data-feather="list"></i> <span>Packages</span>
                            </a>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);">
                                <i data-feather="grid"></i>
                                <span>Business</span>&nbsp;<span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li><a href="{{ route('admin.business-types.index') }}">Business Type</a></li>
                                <li><a href="{{ route('admin.unit.index') }}">Business Category</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">
                                <i data-feather="file-text"></i> <span>Pages</span>
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="submenu-open">
                    <h6 class="submenu-hdr">Reports</h6>
                    <ul>
                        <li>
                            <a href="#">
                                <i data-feather="bar-chart-2"></i> <span>Payment Reports</span>
                            </a>
                        </li>


                    </ul>
                </li>

                <!-- Settings -->
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Settings</h6>
                    <ul>
                        <!-- Core Settings -->
                        <li class="submenu">
                            <a href="javascript:void(0);">
                                <i data-feather="settings"></i>
                                <span>Core Settings</span>&nbsp;<span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li><a href="{{ route('admin.tax.index') }}">Tax Settings</a></li>
                                <li><a href="{{ route('admin.unit.index') }}">Unit Settings</a></li>
                                <li><a href="{{ route('admin.country.index') }}">Country Settings</a></li>
                            </ul>
                        </li>

                        <!-- Website Settings -->
                        <li class="submenu">
                            <a href="javascript:void(0);">
                                <i data-feather="globe"></i>
                                <span>Website Settings</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li><a href="{{ route('admin.settings') }}">Settings</a></li>

                            </ul>
                        </li>

                        <!-- Logout -->
                        <li>


                            <a href="#"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i data-feather="log-out"></i> <span>Logout</span>

                            </a>
                            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- /Sidebar -->