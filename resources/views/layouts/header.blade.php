<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GreenBiller</title>

    <script>
        document.addEventListener('contextmenu', function(e) {
            e.preventDefault();
            alert("This function is not allowed here.!");
        });
        document.addEventListener('keydown', function(e) {
            if (e.key === "F12") {
                e.preventDefault();
                alert("This function is not allowed here.!");
            }
            if (e.ctrlKey && e.key.toLowerCase() === 'u') {
                e.preventDefault();
                alert("This function is not allowed here.!");
            }
            if (e.ctrlKey && e.key.toLowerCase() === 's') {
                e.preventDefault();
                alert("This function is not allowed here.!");
            }
            if (e.ctrlKey && e.shiftKey && 
               (e.key.toLowerCase() === 'i' || e.key.toLowerCase() === 'j' || e.key.toLowerCase() === 'c')) {
                e.preventDefault();
                alert("This function is not allowed here.!");
            }
        });
    </script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

    <!-- Meta SEO Tags (Dynamic from Settings) -->
    <metaname="description" content="{{ $settings->meta_description ?? 'POS - Bootstrap Admin Template' }}">
        <meta name="keywords" content="{{ $settings->meta_keywords ?? 'admin, pos, bootstrap, responsive, business' }}">
        <meta name="author" content="{{ $settings->meta_author ?? 'Dreamguys - Bootstrap Admin Template' }}">
        <meta name="robots" content="noindex, nofollow">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
        <meta http-equiv="Pragma" content="no-cache" />
        <meta http-equiv="Expires" content="0" />

        <!-- Title (Dynamic from Settings) -->
        <title>{{ $settings->site_title ?? 'Green Biller' }}</title>

        <!-- Favicon (Optional, if set in settings) -->
        @if(!empty($settings->fav_icon))
        <link rel="icon" href="{{ asset('storage/core/' . $settings->fav_icon) }}" type="image/png">
        @else
        <link rel="icon" href="{{ asset('logo1.jpeg') }}" type="image/png">
        @endif


        <!-- libraries CSS -->
        <link rel="stylesheet" href="{{asset('home-assets/icon/flaticon_digicom.css')}}">
        <link rel="stylesheet" href="{{asset('home-assets/vendor/bootstrap/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('home-assets/vendor/splide/splide.min.css')}}">
        <link rel="stylesheet" href="{{ asset('home-assets/vendor/swiper/swiper-bundle.min.css') }}">
        <link rel="stylesheet" href="{{ asset('home-assets/vendor/animate-wow/animate.min.css') }}">

        <!-- custom CSS -->
        <link rel="stylesheet" href="{{ asset('home-assets/css/style.css')}}">
</head>

<body>
    <div class="preloader" id="preloader">
        <div class="loader"></div>
    </div>

    <!-- SIDEBAR SECTION START -->
    <div class="ul-sidebar">
        <!-- header -->
        <div class="ul-sidebar-header">
            <div class="ul-sidebar-header-logo">
                <a href="/">
                    <img src="{{ asset('home-assets/img/logo.svg')}}" alt="logo" class="logo">
                </a>
            </div>
            <!-- sidebar closer -->
            <button class="ul-sidebar-closer"><i class="flaticon-close-1"></i></button>
        </div>

        <div class="ul-sidebar-header-nav-wrapper d-block d-lg-none"></div>


        <!-- sidebar footer -->
        <div class="ul-sidebar-footer">
            <span class="ul-sidebar-footer-title">Follow us</span>

            <div class="ul-sidebar-footer-social">
                <a href="#"><i class="flaticon-facebook"></i></a>
                <a href="#"><i class="flaticon-twitter"></i></a>
                <a href="#"><i class="flaticon-instagram"></i></a>
                <a href="#"><i class="flaticon-linkedin-big-logo"></i></a>
            </div>
        </div>
    </div>
    <!-- SIDEBAR SECTION END -->

    <!-- SEARCH MODAL SECTION START -->
    <div class="ul-search-form-wrapper flex-grow-1 flex-shrink-0">
        <button class="ul-search-closer"><i class="flaticon-close-1"></i></button>

        <form action="#" class="ul-search-form">
            <div class="ul-search-form-right">
                <input type="search" name="search" id="ul-search" placeholder="Search Here">
                <button type="submit"><span class="icon"><i class="flaticon-search"></i></span></button>
            </div>
        </form>
    </div>
    <!-- SEARCH MODAL SECTION END -->

    <!-- HEADER SECTION START -->

    <!-- HEADER SECTION END -->