<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <!-- Dashboard -->
                <li class="submenu-open">
                <li>
                    <a href="{{ route('store.dashboard') }}" class="">
                        <i data-feather="grid"></i><span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('store.sales.index') }}" class="">
                        <i data-feather="shopping-cart"></i> <span>Sales</span>
                    </a>
                </li>
                </li>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Peoples</h6>
                    <ul>
                        <li class="submenu">
                            <a href="javascript:void(0);">
                                <i data-feather="user"></i>
                                <span>Contacts</span>&nbsp;<span class="menu-arrow"></span>
                            </a>
                            <ul>
                                {{-- <li><a href="{{ route('store.tax.index') }}">Customer</a>
                                </li>
                                <li><a href="{{ route('store.unit.index') }}">Supplier</a></li>
                                <li><a href="{{ route('store.unit.index') }}">Users</a></li> --}}

                            </ul>
                        </li>

                    </ul>
                </li>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Premium</h6>
                    <ul>
                        <li>
                            <a href="{{ route('store.package.index') }}">
                                <i data-feather="bar-chart"></i> <span>Advance</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('store.package.index') }}">
                                <i data-feather="shopping-bag"></i> <span>purchase</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('store.package.index') }}">
                                <i data-feather="dollar-sign"></i> <span>Expenses</span>
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="submenu-open">
                    <h6 class="submenu-hdr">Store</h6>
                    <ul>
                        <li>
                            <a href="{{ route('store.package.index') }}">
                                <i data-feather="sliders"></i></i> <span>Items</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.package.index') }}">
                                <i data-feather="settings"></i><span>Store</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.package.index') }}">
                                <i data-feather="file-text"></i></i> <span>Reports</span>
                            </a>
                        </li>

                    </ul>
                </li>

                <!-- Settings -->
                <li class=" submenu-open">
                    <h6 class="submenu-hdr">Settings</h6>
                    <ul>
                        <!-- Core Settings -->
                        <li>
                            <a href="{{ route('admin.package.index') }}">
                                <i data-feather="settings"></i> <span>Core Settings</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- /Sidebar -->