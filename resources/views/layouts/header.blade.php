<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GreenBiller</title>

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
