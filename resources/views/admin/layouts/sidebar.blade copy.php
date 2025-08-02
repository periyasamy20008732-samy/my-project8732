<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="submenu-open">
                    
                    <ul>

                        <!-- Dashboard -->
                        <li class="">
                            <a href="{{ route('admin.dashboard') }}" class="subdrop active">
                                <i data-feather="grid"></i><span>Dashboard</span>
                            </a>
                           {{--  <ul>
                                <li>
                                    <a  class="active">Admin Dashboard</a>
                                </li>
                            </ul> --}}
                        </li>
                    <!-- Customer -->
                    
                  <h6 class="submenu-hdr">Main</h6>
                        <li class="submenu">
                            
                            <a href="javascript:void(0);">
                                <i data-feather="user"></i><span>Customer</span><span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li><a href="{{ route('admin.customer') }}">Customer Settings</a></li>
                            </ul>
                        </li>

                        <!-- Package -->
                        <li class="submenu">
                            <a href="javascript:void(0);">
                                <i data-feather="smartphone"></i><span>Package</span><span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li><a href="{{ route('admin.package.index') }}">Package Settings</a></li>
                            </ul>
                        </li>

                        <!-- Core Settings -->
                  <h6 class="submenu-hdr">Settings</h6>
                        <li class="submenu">
                            <a href="javascript:void(0);">
                                <i data-feather="settings"></i><span>Core settings</span><span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li><a href="{{ route('admin.tax') }}" >Tax Settings</a></li>
                                <li><a href="{{ route('admin.unit') }}" >Unit Settings</a></li>
                                <li><a href="{{ route('admin.country') }}">Country Settings</a></li>
                                <li><a href="{{ route('admin.settings') }}" >Settings</a></li>
                            </ul>
                        </li>

                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- /Sidebar -->
