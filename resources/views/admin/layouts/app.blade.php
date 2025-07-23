@include('admin.layouts.header');
@include('admin.layouts.header-nav');
@include('admin.layouts.sidebar');
@yield('content');
@include('admin.layouts.footer');
@stack('scripts')
