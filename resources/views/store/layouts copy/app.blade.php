@include('store.layouts.header');
@include('store.layouts.header-nav');
@include('store.layouts.sidebar');
@yield('content');
@include('store.layouts.footer');
@stack('scripts')