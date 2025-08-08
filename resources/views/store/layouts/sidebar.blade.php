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
                        <i data-feather="shopping-cart"></i><span>Sales</span>
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
                                <li><a href="{{ route('store.customer.index') }}">Customer</a>
                                </li>
                                <li><a href="{{ route('store.sales.index') }}">Supplier</a></li>
                                <li><a href="{{ route('store.sales.index') }}">Users</a></li>

                            </ul>
                        </li>

                    </ul>
                </li>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Premium</h6>
                    <ul>
                        <li>
                            <a href="{{ route('store.sales.index') }}">
                                <i data-feather="bar-chart"></i> <span>Advance</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('store.sales.index') }}">
                                <i data-feather="shopping-bag"></i> <span>purchase</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('store.sales.index') }}">
                                <i data-feather="dollar-sign"></i> <span>Expenses</span>
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="submenu-open">
                    <h6 class="submenu-hdr">Store</h6>
                    <ul>
                        <li class="submenu">
                            <a href="javascript:void(0);">
                                <i data-feather="sliders"></i><span>Items</span>&nbsp;<span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li><a href="{{ route('store.items.index') }}">New Item</a>
                                </li>
                                <li><a href="{{ route('store.category.index') }}">Category List</a></li>
                                <li><a href="{{ route('store.brand.index') }}">Brand List</a></li>

                            </ul>
                        </li>

                        <li>
                            <a href="{{ route('store.store.index') }}">
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
                            <a href="{{ route('store.sales.index') }}">
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