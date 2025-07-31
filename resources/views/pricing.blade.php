@extends('layouts.app')
@section('content')

<main>
    <!-- BREADCRUMBS SECTION START -->
    <section class="ul-breadcrumb ul-section-spacing">
        <div class="ul-container">
            <ul class="ul-breadcrumb-nav">
                <li><a href="/">Home</a></li>
                <li><span class="separator"><i class="flaticon-right"></i></span></li>
                <li>Pricing</li>
            </ul>
            <h2 class="ul-breadcrumb-title">Pricing</h2>
        </div>
    </section>
    <!-- BREADCRUMBS SECTION END -->



    <section class="ul-pricing ul-section-spacing">
        <div class="ul-container">
            <div class="row ul-bs-row row-cols-lg-3 row-cols-sm-2 row-cols-1">
                <!-- single plan -->

                @forelse ($packages as $package)

                <div class="col">
                    <div class="ul-pricing-package">
                        <!-- heading -->
                        <div class="ul-pricing-package-heading">
                            <span class="ul-pricing-package-name">{{ $package->package_name }}</span>
                            <div class="ul-pricing-package-heading-bottom">
                                <h3 class="ul-pricing-package-price">₹{{ $package->price }}</h3>
                                <div class="right">
                                    <span class="ul-pricing-package-duration"><span class="divider">/</span>Year</span>
                                </div>
                            </div>
                            <!-- <p class="ul-pricing-package-descr">{{ $package->price }}</p> -->
                        </div>

                        <style>
                        .inactive {
                            color: #6A6A6A !important;
                            text-decoration: line-through;
                        }

                        .inactive::before {
                            content: "\f14a";
                            font-family: flaticon_digicom !important;
                            font-style: normal;
                            font-weight: normal !important;
                            font-variant: normal;
                            text-transform: none;
                            line-height: 1;
                            -webkit-font-smoothing: antialiased;
                            -moz-osx-font-smoothing: grayscale;
                            display: block;
                            color: #6A6A6A !important;
                            filter: drop-shadow(0px 4px 25px rgba(120, 121, 121, 0.08)) !important;
                        }
                        </style>
                        <!-- body -->
                        <div class="ul-pricing-package-body">
                            <ul class="ul-pricing-package-body-list">
                                <li>Sync data across devices</li>
                                <li>24/7 Skilled Support</li>
                                <li class="
                                                                                        @if($package->if_webpanel == 0)
                                                                                            inactive
                                                                                        @endif 
                                                                                        ">Webpanel</li>
                                <li class="
                                                                                        @if($package->if_windows == 0)
                                                                                            inactive
                                                                                        @endif 
                                                                                        ">Desktop</li>
                                <li class="
                                                                                @if($package->if_android == 0)
                                                                                    inactive
                                                                                @endif 
                                                                                ">Android App</li>
                                <li class="
                                                                                @if($package->if_ios == 0)
                                                                                    inactive
                                                                                @endif 
                                                                                ">Ios App</li>
                                <li class="
                                                                                @if($package->if_multistore == 0)
                                                                                    inactive
                                                                                @endif 
                                                                                ">{{ $package->if_numberof_store }}
                                    Multi Store
                                </li>
                                <li class="
                                                                                @if($package->if_exicutiveapp == 0)
                                                                                    inactive
                                                                                @endif 
                                                                                ">Exicutive App</li>
                                <li class="
                                                                                @if($package->if_deliveryapp == 0)
                                                                                    inactive
                                                                                @endif 
                                                                                ">Delivery App</li>
                                <li class="
                                                                                @if($package->if_customerapp == 0)
                                                                                    inactive
                                                                                @endif 
                                                                                ">Customer App</li>

                            </ul>

                            <a href="javascript:void(0)" class="ul-pricing-package-btn" data-bs-toggle="offcanvas"
                                data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Choose a Plan</a>
                        </div>
                    </div>
                </div>

                @empty
                @endforelse

            </div>
        </div>
    </section>


    <!-- FAQ SECTION START -->
    <section class="ul-faq">
        <div class="ul-container">
            <div class="row ul-bs-row ul-faq-row">
                <!-- img -->
                <div class="col-md-5">
                    <div class="ul-faq-img d-flex justify-content-end">
                        <img src="{{asset('home-assets/img/faq-img.png')}}" alt="Image">
                    </div>
                </div>

                <!-- txt -->
                <div class="col-md-7">
                    <div class="ul-faq-txt ul-section-spacing">
                        <div>
                            <span class="ul-section-sub-title">Frequently Ask Question</span>
                            <h2 class="ul-section-title">Let's Meet And Work Together Your Project</h2>
                        </div>

                        <div class="ul-faq-accordion ul-accordion">
                            <div class="ul-single-accordion-item open">
                                <div class="ul-single-accordion-item__header">
                                    <div class="left">
                                        <h3 class="ul-single-accordion-item__title">Where should I incorporate my
                                            business?</h3>
                                    </div>
                                    <span class="icon"><i class="flaticon-right"></i></span>
                                </div>

                                <div class="ul-single-accordion-item__body">
                                    <p>Aonsectetur adipiscing elit Aenean scelerisque augue vitae consequat Juisque eget
                                        congue velit in cursus leo sodales the turpis euismod quis sapien euismod quis
                                        sapien the. E-learning is suitable for students, professionals, and anyone
                                        interested.</p>
                                </div>
                            </div>

                            <div class="ul-single-accordion-item">
                                <div class="ul-single-accordion-item__header">
                                    <div class="left">
                                        <h3 class="ul-single-accordion-item__title">How long should a business plan be?
                                        </h3>
                                    </div>
                                    <span class="icon"><i class="flaticon-right"></i></span>
                                </div>

                                <div class="ul-single-accordion-item__body">
                                    <p>Aonsectetur adipiscing elit Aenean scelerisque augue vitae consequat Juisque eget
                                        congue velit in cursus leo sodales the turpis euismod quis sapien euismod quis
                                        sapien the. E-learning is suitable for students, professionals, and anyone
                                        interested.</p>
                                </div>
                            </div>

                            <div class="ul-single-accordion-item">
                                <div class="ul-single-accordion-item__header">
                                    <div class="left">
                                        <h3 class="ul-single-accordion-item__title">Be Part of a Community</h3>
                                    </div>
                                    <span class="icon"><i class="flaticon-right"></i></span>
                                </div>

                                <div class="ul-single-accordion-item__body">
                                    <p>Aonsectetur adipiscing elit Aenean scelerisque augue vitae consequat Juisque eget
                                        congue velit in cursus leo sodales the turpis euismod quis sapien euismod quis
                                        sapien the. E-learning is suitable for students, professionals, and anyone
                                        interested.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="ul-faq-vector">
            <div class="ul-faq-vector-inner"></div>
        </div>
    </section>
    <!-- FAQ SECTION END -->
</main>@endsection