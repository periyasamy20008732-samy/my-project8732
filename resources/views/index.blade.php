@extends('layouts.app')
@section('content')

    <main>
        <!-- BANNER SECTION START -->
        <section class="ul-banner-2">
            <div class="ul-banner-2-container">
                <div class="ul-banner-2-content row align-items-lg-center align-items-end justify-content-between">
                    <div class="col-lg-6 col-md-7">
                        <div class="ul-banner-2-txt">
                            <h1 class="ul-banner-2-title">GST Billing Software in India </h1>
                            <p class="ul-banner-2-descr">For Small or Large Businesses</p>

                            <div class="ul-banner-2-btns">
                                <a href="download" class="ul-2-btn ul-banner-2-btn">Try it </a>
                                <a href="book-demo" class="ul-2-btn ul-banner-2-btn">Book a Demo</a>
                            </div>

                            <div class="ul-banner-2-stat">
                                <div class="ul-banner-2-stat-imgs">
                                    <img src=" {{ asset('home-assets/img/user-sm-1.png')}}" alt="Image">
                                    <img src=" {{ asset('home-assets/img/user-sm-2.png')}}" alt="Image">
                                    <img src=" {{ asset('home-assets/img/user-sm-3.png')}}" alt="Image">
                                </div>
                                <p><strong>400k+</strong> users around the globe</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5 col-md-5">
                        <div class="ul-banner-2-img">
                            <img src=" {{ asset('home-assets/img/banner-2-img.png')}}" alt="Image">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- BANNER SECTION END -->


        <!-- CLIENTS SECTION START -->
        <?php /* ?>
        <section class="ul-clients-2 ul-section-spacing pb-0">
            <div class="ul-clients-2-container">
                <span class="ul-clients-2-title">Trusted by nearly 50+ paying customers</span>
                <div class="swiper ul-clients-2-slider">
                    <div class="swiper-wrapper align-items-center">
                        <!-- single client -->
                        <div class="swiper-slide"><img src=" {{asset('home-assets/img/client-2-1.png')}}"
                                alt="Client Image"></div>
                        <!-- single client -->
                        <div class="swiper-slide"><img src=" {{asset('home-assets/img/client-2-2.png')}}"
                                alt="Client Image"></div>
                        <!-- single client -->
                        <div class="swiper-slide"><img src=" {{asset('home-assets/img/client-2-3.png')}}"
                                alt="Client Image"></div>
                        <!-- single client -->
                        <div class="swiper-slide"><img src=" {{asset('home-assets/img/client-2-4.png')}}"
                                alt="Client Image"></div>
                        <!-- single client -->
                        <div class="swiper-slide"><img src=" {{asset('home-assets/img/client-2-5.png')}}"
                                alt="Client Image"></div>
                        <!-- single client -->
                        <div class="swiper-slide"><img src=" {{asset('home-assets/img/client-2-1.png')}}"
                                alt="Client Image"></div>
                    </div>
                </div>
            </div>
        </section>
        <?php */ ?>

        <!-- CLIENTS SECTION END -->


        <!-- ABOUT SECTION START -->
        <section class="ul-about-2 ul-section-spacing">
            <div class="ul-about-2-container">
                <div class="row gx-xxl-0 gx-4 gy-5 align-items-center justify-content-center">
                    <div class="col-lg-6">
                        <div class="ul-about-2-img">
                            <img src=" {{ asset('home-assets/img/about-2-img.png')}}" alt="About Image">
                            <img src=" {{ asset('home-assets/img/about-2-img-sm.jpg')}}" alt="Image" class="img-sm">

                            <div class="ul-about-2-img-vectors">
                                <div class="vector-1"><img src=" {{ asset('home-assets/img/about-2-img-vector-1.svg')}}"
                                        alt="Vector"></div>
                                <img src=" {{ asset('home-assets/img/about-2-img-vector-2.png')}}" alt="Vector"
                                    class="vector-2">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="ul-about-2-txt">
                            <span class="ul-2-section-sub-title">About Our App</span>
                            <h2 class="ul-2-section-title">Create GST Bills and Manage Business in One App</h2>
                            <p class="ul-2-section-descr">Green Biller lets you generate GST invoices, track sales, manage
                                stock, and share invoices digitally – all in one place.</p>

                            <ul class="ul-about-2-list">
                                <li>GST-compliant billing</li>
                                <li>Inventory Management</li>
                                <li>Payment Reminders</li>
                            </ul>

                            <a href="about.html" class="ul-2-btn">Discover More</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ABOUT SECTION END -->


        <!-- FEATURES SECTION START -->
        <section class="ul-features ul-section-spacing">
            <div class="ul-features-container">
                <div class="ul-section-heading text-center justify-content-center">
                    <div class="left">
                        <span class="ul-2-section-sub-title">Awesome Features</span>
                        <h2 class="ul-2-section-title">Awesome Apps Features</h2>
                        <p class="ul-2-section-descr">GreenBiller is packed with powerful, user-friendly features designed
                            to simplify your billing and business management.</p>
                    </div>
                </div>

                <div class="ul-features-grid">
                    <div class="row row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-1 ul-bs-row justify-content-center">
                        <div class="col">
                            <div class="ul-service">
                                <div class="ul-service-txt">
                                    <span class="ul-service-sub-title">GST Billing</span>
                                    <h3 class="ul-service-title">GST Billing</h3>
                                    <p class="ul-service-descr"> Easily generate, customise, and share GST-compliant
                                        invoices with your branding.</p>
                                    <a href="service-details.html" class="ul-service-btn">Read More <i
                                            class="flaticon-right"></i></a>
                                </div>
                                <div class="ul-service-img">
                                    <img src=" {{ asset('home-assets/img/service-1.jpg')}}" alt="Image">
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="ul-service">
                                <div class="ul-service-txt">
                                    <span class="ul-service-sub-title">Inventory Management </span>
                                    <h3 class="ul-service-title"> Inventory Management </h3>
                                    <p class="ul-service-descr">Track stock movement, manage batches, and get alerts for low
                                        inventory.</p>
                                    <a href="service-details.html" class="ul-service-btn">Read More <i
                                            class="flaticon-right"></i></a>
                                </div>
                                <div class="ul-service-img">
                                    <img src=" {{ asset('home-assets/img/service-2.jpg')}}" alt="Image">
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="ul-service">
                                <div class="ul-service-txt">
                                    <span class="ul-service-sub-title">Accounts & Payments</span>
                                    <h3 class="ul-service-title">Accounts & Payments</h3>
                                    <p class="ul-service-descr">Handle customer and supplier accounts with ledgers, dues,
                                        and reminders</p>
                                    <a href="service-details.html" class="ul-service-btn">Read More <i
                                            class="flaticon-right"></i></a>
                                </div>
                                <div class="ul-service-img">
                                    <img src=" {{ asset('home-assets/img/service-3.jpg')}}" alt="Image">
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="ul-service">
                                <div class="ul-service-txt">
                                    <span class="ul-service-sub-title">Expense Tracking</span>
                                    <h3 class="ul-service-title">Expense Tracking</h3>
                                    <p class="ul-service-descr">Log daily expenses, categorise them, and manage cash flow
                                        effortlessly</p>
                                    <a href="service-details.html" class="ul-service-btn">Read More <i
                                            class="flaticon-right"></i></a>
                                </div>
                                <div class="ul-service-img">
                                    <img src=" {{ asset('home-assets/img/service-4.jpg')}}" alt="Image">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- FEATURES SECTION END  -->


        <!-- FUNCTIONS SECTION START -->
        <section class="ul-functions ul-section-spacing">
            <div class="ul-functions-container">
                <div class="row row-cols-md-3 row-cols-1 ul-bs-row align-items-center">
                    <div class="col order-0">
                        <div class="ul-functions-list mt-0">
                            <div class="ul-single-accordion-item ul-functions-accordion-item open"
                                data-img="{{ asset('home-assets/img/functions-ss.png')}}">
                                <div class="ul-single-accordion-item__header">
                                    <i class="flaticon-download-1"></i>
                                    <h3 class="ul-single-accordion-item__title">Lifetime Free Basic Access</h3>
                                </div>

                                <div class="ul-single-accordion-item__body">
                                    <p>Get started with our forever-free GST billing software. Create customised invoices,
                                        manage stock, and access essential tools — no hidden charges.</p>
                                </div>
                            </div>

                            <div class="ul-single-accordion-item ul-functions-accordion-item"
                                data-img="{{ asset('home-assets/img/functions-ss-4-copy.png')}}">
                                <div class="ul-single-accordion-item__header">
                                    <i class="flaticon-link-1"></i>
                                    <h3 class="ul-single-accordion-item__title"> Multiple Payment Options</h3>
                                </div>

                                <div class="ul-single-accordion-item__body">
                                    <p>Offer your customers flexible payment methods like UPI, QR, IMPS, NEFT, debit/credit
                                        cards, and wallets — to ensure faster and smoother transactions.</p>
                                </div>
                            </div>

                            <div class="ul-single-accordion-item ul-functions-accordion-item"
                                data-img="{{ asset('home-assets/img/functions-ss-4-copy.png')}}">
                                <div class="ul-single-accordion-item__header">
                                    <i class="flaticon-cloud-computing"></i>
                                    <h3 class="ul-single-accordion-item__title">Track Business in Real Time
                                    </h3>
                                </div>

                                <div class="ul-single-accordion-item__body">
                                    <p>Green Biller’s smart dashboard helps you monitor cash flow, inventory, sales, and
                                        outstanding payments — all from one easy-to-use interface.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col order-2 order-md-1">
                        <div class="ul-functions-img text-center">
                            <img id="ul-functions-dynamic-img" src="{{ asset('home-assets/img/functions-ss-4-copy.png') }}"
                                alt="App Screenshot">


                            <div class="ul-functions-img-vectors">
                                <div class="sm-block sm-block-1"></div>
                                <div class="sm-block sm-block-2"></div>
                                <div class="big-block"></div>
                                <img src=" {{ asset('home-assets/img/functions-vector.png')}}" alt="vector" class="vector">
                            </div>
                        </div>
                    </div>
                    <div class="col order-1 order-md-2">
                        <div class="ul-functions-list mt-0">
                            <div class="ul-single-accordion-item ul-functions-accordion-item"
                                data-img="{{ asset('home-assets/img/functions-ss-4-copy.png')}}">
                                <div class="ul-single-accordion-item__header">
                                    <i class="flaticon-download-1"></i>
                                    <h3 class="ul-single-accordion-item__title">Secure Cloud Backup</h3>
                                </div>

                                <div class="ul-single-accordion-item__body">
                                    <p>Your data is always safe with automated cloud backups. You can also take manual local
                                        backups to ensure full protection of your business records.</p>
                                </div>
                            </div>

                            <div class="ul-single-accordion-item ul-functions-accordion-item"
                                data-img="{{ asset('home-assets/img/functions-ss.png')}}">
                                <div class="ul-single-accordion-item__header">
                                    <i class="flaticon-link-1"></i>
                                    <h3 class="ul-single-accordion-item__title">Manage Cash Flow Seamlessly</h3>
                                </div>

                                <div class="ul-single-accordion-item__body">
                                    <p>Keep your finances under control by tracking income, expenses, dues, and credit in
                                        real-time — all in one place, with zero manual effort.</p>
                                </div>
                            </div>

                            <div class="ul-single-accordion-item ul-functions-accordion-item"
                                data-img="{{ asset('home-assets/img/functions-ss-4-copy.png')}}">
                                <div class="ul-single-accordion-item__header">
                                    <i class="flaticon-cloud-computing"></i>
                                    <h3 class="ul-single-accordion-item__title">Build a Professional Brand Image</h3>
                                </div>

                                <div class="ul-single-accordion-item__body">
                                    <p>Create and share beautifully designed GST invoices with your company logo, signature,
                                        and terms — making your business look polished and trustworthy.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- FUNCTIONS SECTION END -->


        <!-- HOW IT WORKS SECTION START  -->
        <!--
                            <section class="ul-how-it-works ul-section-spacing">
                                <div class="ul-how-it-works-container">
                                    <div class="ul-section-heading">
                                        <div class="left">
                                            <span class="ul-2-section-sub-title">How Apps Working</span>
                                            <h2 class="ul-2-section-title">Send, Receive And Invest Money Right From Your Phone</h2>
                                        </div>
                                        <div class="right">
                                            <a href="#" class="ul-2-btn">Discover More <i class="flaticon-next-1"></i></a>
                                        </div>
                                    </div>

                                    <div class="row ul-bs-row row-cols-md-2 row-cols-1">

                                        <div class="col">
                                            <div class="ul-how-it-works-list">

                                                <div class="ul-how-it-works-item">
                                                    <div class="icon"><i class="flaticon-checked"></i></div>
                                                    <div class="txt">
                                                        <h3 class="ul-how-it-works-item-title">Transaction Tracking</h3>
                                                        <p class="ul-how-it-works-item-descr">Stay on top of every transaction with real-time updates and detailed insights.</p>
                                                    </div>
                                                </div>

                                                <div class="ul-how-it-works-item">
                                                    <div class="icon"><i class="flaticon-checked"></i></div>
                                                    <div class="txt">
                                                        <h3 class="ul-how-it-works-item-title">Finances in Focus</h3>
                                                        <p class="ul-how-it-works-item-descr">Get a clear, organised view of your income and expenses.</p>
                                                    </div>
                                                </div>

                                                <div class="ul-how-it-works-item">
                                                    <div class="icon"><i class="flaticon-checked"></i></div>
                                                    <div class="txt">
                                                        <h3 class="ul-how-it-works-item-title">Secure, Smooth Benefits.</h3>
                                                        <p class="ul-how-it-works-item-descr">Enjoy safe, hassle-free transactions backed by top-level encryption.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col">
                                            <div class="ul-how-it-works-imgs">
                                                <div class="ul-how-it-works-img-slider swiper">
                                                    <div class="swiper-wrapper">

                                                        <div class="swiper-slide">
                                                            <img src=" {{ asset('home-assets/img/hiw-ss-slide-1.png')}}" alt="Image">
                                                        </div>

                                                        <div class="swiper-slide">
                                                            <img src=" {{ asset('home-assets/img/hiw-ss-slide-2.png')}}" alt="Image">
                                                        </div>

                                                        <div class="swiper-slide">
                                                            <img src=" {{ asset('home-assets/img/hiw-ss-slide-3.png')}}" alt="Image">
                                                        </div>

                                                        <div class="swiper-slide">
                                                            <img src=" {{ asset('home-assets/img/hiw-ss-slide-4.png')}}" alt="Image">
                                                        </div>

                                                        <div class="swiper-slide">
                                                            <img src=" {{ asset('home-assets/img/hiw-ss-slide-1.png')}}" alt="Image">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    -->
        <!-- vectors -->
        <div class="ul-faq-vector">
            <div class="ul-faq-vector-inner"></div>
        </div>
        <div class="ul-faq-vector ul-faq-vector--2">
            <div class="ul-faq-vector-inner"></div>
        </div>
        </section>




        <section class="ul-section-spacing pb-0">
            <div class="ul-app-ad">
                <div class="row row-cols-md-2 gy-4 flex-column-reverse flex-md-row">

                    <div class="col">
                        <div class="ul-app-ad-img">
                            <img src=" {{ asset('home-assets/img/app-ad-img.png')}}" alt="App Ad Image">
                        </div>
                    </div>

                    <!-- txt -->
                    <div class="col">
                        <div class="ul-app-ad-txt">
                            <span class="ul-2-section-sub-title">How Apps Working</span>
                            <h2 class="ul-2-section-title">Download Our Apps</h2>
                            <p class="ul-2-section-descr">Easily check your account balance and access a variety of features
                                anytime, anywhere, right from your device.</p>
                            <div class="ul-app-ad-btns">
                                <a href="#"><img src=" {{ asset('home-assets/img/app-store.png')}}"
                                        alt="App Store Logo"></a>
                                <a href="#"><img src=" {{ asset('home-assets/img/play-store.png')}}"
                                        alt="Play Store Logo"></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="ul-app-ad-vectors">
                    <img src=" {{ asset('home-assets/img/app-ad-vector-1.png')}}" alt="Vector" class="vector-1">
                    <img src=" {{ asset('home-assets/img/app-ad-vector-2.png')}}" alt="Vector" class="vector-2">
                </div>
            </div>
        </section>
        <!-- APP AD SECTION END -->


        <!-- REVIEW SECTION START -->
        <!--
                            <section class="ul-reviews-2 ul-section-spacing">
                                <div class="ul-reviews-2-container">
                                    <div class="ul-section-heading">
                                        <div class="left">
                                            <span class="ul-2-section-sub-title">Testimonials</span>
                                            <h2 class="ul-2-section-title mb-0">People Love us</h2>
                                        </div>

                                        <div class="right">
                                            <div class="ul-reviews-2-slider-nav ul-slider-nav">
                                                <button class="prev"><i class="flaticon-back"></i></button>
                                                <button class="next"><i class="flaticon-next-1"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper ul-reviews-2-slider">
                                        <div class="swiper-wrapper">

                                            <div class="swiper-slide">
                                                <div class="ul-review-2">
                                                    <div class="ul-review-quotation-icon flex-shrink-0">
                                                        <img src=" {{ asset('home-assets/img/quote-icon-2.svg')}}" alt="quotaion-icon">
                                                    </div>
                                                    <div class="right">
                                                        <p class="ul-review-txt">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi facilis dolor sit cum molorum.</p>

                                                        <div class="ul-review-reviewer-info">
                                                            <h3 class="ul-review-reviewer-name">Cameron Williamson</h3>
                                                            <h4 class="ul-review-reviewer-role">CEO, PlexDesign</h4>
                                                            <div class="ul-review-rating">
                                                                <i class="flaticon-star"></i>
                                                                <i class="flaticon-star"></i>
                                                                <i class="flaticon-star"></i>
                                                                <i class="flaticon-star"></i>
                                                                <i class="flaticon-star"></i>
                                                            </div>
                                                        </div>

                                                        <div class="ul-review-reviewer-img">
                                                            <img src=" {{ asset('home-assets/img/user.jpg')}}" alt="Reviewer Image">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="swiper-slide">
                                                <div class="ul-review-2">
                                                    <div class="ul-review-quotation-icon flex-shrink-0">
                                                        <img src=" {{ asset('home-assets/img/quote-icon-2.svg')}}" alt="quotaion-icon">
                                                    </div>
                                                    <div class="right">
                                                        <p class="ul-review-txt">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi facilis dolor sit cum molorum.</p>

                                                        <div class="ul-review-reviewer-info">
                                                            <h3 class="ul-review-reviewer-name">Cameron Williamson</h3>
                                                            <h4 class="ul-review-reviewer-role">CEO, PlexDesign</h4>
                                                            <div class="ul-review-rating">
                                                                <i class="flaticon-star"></i>
                                                                <i class="flaticon-star"></i>
                                                                <i class="flaticon-star"></i>
                                                                <i class="flaticon-star"></i>
                                                                <i class="flaticon-star"></i>
                                                            </div>
                                                        </div>

                                                        <div class="ul-review-reviewer-img">
                                                            <img src=" {{ asset('home-assets/img/user-3.jpg')}}" alt="Reviewer Image">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="swiper-slide">
                                                <div class="ul-review-2">
                                                    <div class="ul-review-quotation-icon flex-shrink-0">
                                                        <img src=" {{ asset('home-assets/img/quote-icon-2.svg')}}" alt="quotaion-icon">
                                                    </div>
                                                    <div class="right">
                                                        <p class="ul-review-txt">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi facilis dolor sit cum molorum.</p>

                                                        <div class="ul-review-reviewer-info">
                                                            <h3 class="ul-review-reviewer-name">Cameron Williamson</h3>
                                                            <h4 class="ul-review-reviewer-role">CEO, PlexDesign</h4>
                                                            <div class="ul-review-rating">
                                                                <i class="flaticon-star"></i>
                                                                <i class="flaticon-star"></i>
                                                                <i class="flaticon-star"></i>
                                                                <i class="flaticon-star"></i>
                                                                <i class="flaticon-star"></i>
                                                            </div>
                                                        </div>

                                                        <div class="ul-review-reviewer-img">
                                                            <img src=" {{ asset('home-assets/img/user-5.jpg')}}" alt="Reviewer Image">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="swiper-slide">
                                                <div class="ul-review-2">
                                                    <div class="ul-review-quotation-icon flex-shrink-0">
                                                        <img src=" {{ asset('home-assets/img/quote-icon-2.svg')}}" alt="quotaion-icon">
                                                    </div>
                                                    <div class="right">
                                                        <p class="ul-review-txt">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi facilis dolor sit cum molorum.</p>

                                                        <div class="ul-review-reviewer-info">
                                                            <h3 class="ul-review-reviewer-name">Cameron Williamson</h3>
                                                            <h4 class="ul-review-reviewer-role">CEO, PlexDesign</h4>
                                                            <div class="ul-review-rating">
                                                                <i class="flaticon-star"></i>
                                                                <i class="flaticon-star"></i>
                                                                <i class="flaticon-star"></i>
                                                                <i class="flaticon-star"></i>
                                                                <i class="flaticon-star"></i>
                                                            </div>
                                                        </div>

                                                        <div class="ul-review-reviewer-img">
                                                            <img src=" {{ asset('home-assets/img/user-3.jpg')}}" alt="Reviewer Image">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            -->
        <!-- REVIEW SECTION END -->


        <!-- FAQ SECTION START -->
        <section class="ul-faq-2 ul-section-spacing">
            <div class="ul-container">
                <div class="row ul-bs-row ul-faq-row row-cols-md-2 row-cols-1">
                    <!-- img -->
                    <div class="col">
                        <div class="ul-faq-txt">
                            <span class="ul-2-section-sub-title">FAQ</span>
                            <h2 class="ul-2-section-title">Frequently Asked Questions</h2>
                            <p class="ul-2-section-descr">Our FAQ section provides quick answers to the questions we hear
                                most often. From getting started to using our features effectively, these insights are here
                                to guide you every step of the way.
                            </p>
                            <ul class="ul-faq-2-list">
                                <li>Top Quality Service</li>
                                <li>Intermodal Shipping</li>
                            </ul>
                        </div>
                    </div>

                    <!-- txt -->
                    <div class="col">
                        <div class="ul-faq-accordion ul-accordion mt-0">
                            <div class="ul-single-accordion-item open">
                                <div class="ul-single-accordion-item__header">
                                    <div class="left">
                                        <h3 class="ul-single-accordion-item__title">Which is the best software for billing?
                                        </h3>
                                    </div>
                                    <span class="icon"><i class="flaticon-right"></i></span>
                                </div>

                                <div class="ul-single-accordion-item__body">
                                    <p>Green Biller is one of the most trusted GST billing solutions for small and
                                        medium-sized businesses in India. It offers a wide range of powerful features
                                        designed to simplify business operations and streamline daily tasks for business
                                        owners.</p>
                                </div>
                            </div>

                            <div class="ul-single-accordion-item">
                                <div class="ul-single-accordion-item__header">
                                    <div class="left">
                                        <h3 class="ul-single-accordion-item__title">What is billing software?</h3>
                                    </div>
                                    <span class="icon"><i class="flaticon-right"></i></span>
                                </div>

                                <div class="ul-single-accordion-item__body">
                                    <p>Professional invoicing and billing software is used to create personalised GST bills.
                                        It is used to provide better looking custom invoices to customers by businesses.
                                        These invoices help reflect the brand’s identity. FUrther, it caters the brand’s
                                        value to clients.</p>
                                </div>
                            </div>

                            <div class="ul-single-accordion-item">
                                <div class="ul-single-accordion-item__header">
                                    <div class="left">
                                        <h3 class="ul-single-accordion-item__title">How much does billing software cost?
                                        </h3>
                                    </div>
                                    <span class="icon"><i class="flaticon-right"></i></span>
                                </div>

                                <div class="ul-single-accordion-item__body">
                                    <p>Green Biller offers a free plan with essential features. Paid plans start at
                                        affordable rates, depending on your business needs, offering advanced tools like
                                        reports, multi-user access, and premium support.</p>
                                </div>
                            </div>

                            <div class="ul-single-accordion-item">
                                <div class="ul-single-accordion-item__header">
                                    <div class="left">
                                        <h3 class="ul-single-accordion-item__title">Which software is best for billing?</h3>
                                    </div>
                                    <span class="icon"><i class="flaticon-right"></i></span>
                                </div>

                                <div class="ul-single-accordion-item__body">
                                    <p>Green Biller is one of the best billing software options for small and medium
                                        businesses. It provides GST-ready invoicing, inventory tracking, and reports in a
                                        simple, user-friendly format.</p>
                                </div>
                            </div>

                            <!-- <div class="ul-single-accordion-item">
                                                <div class="ul-single-accordion-item__header">
                                                    <div class="left">
                                                        <h3 class="ul-single-accordion-item__title">What is billing software?</h3>
                                                    </div>
                                                    <span class="icon"><i class="flaticon-right"></i></span>
                                                </div>

                                                <div class="ul-single-accordion-item__body">
                                                    <p>Professional invoicing and billing software is used to create personalised GST bills.
                                                        It is used to provide better looking custom invoices to customers by businesses.
                                                        These invoices help reflect the brand’s identity. FUrther, it caters the brand’s
                                                        value to clients.</p>
                                                </div>
                                            </div>

                                            <div class="ul-single-accordion-item">
                                                <div class="ul-single-accordion-item__header">
                                                    <div class="left">
                                                        <h3 class="ul-single-accordion-item__title"> Is there free billing software?</h3>
                                                    </div>
                                                    <span class="icon"><i class="flaticon-right"></i></span>
                                                </div>

                                                <div class="ul-single-accordion-item__body">
                                                    <p>Yes! Green Biller offers a lifetime free plan with core billing features — ideal for
                                                        startups, freelancers, and growing businesses.</p>
                                                </div>
                                            </div>

                                            <div class="ul-single-accordion-item">
                                                <div class="ul-single-accordion-item__header">
                                                    <div class="left">
                                                        <h3 class="ul-single-accordion-item__title">Which software is used for GST billing?
                                                        </h3>
                                                    </div>
                                                    <span class="icon"><i class="flaticon-right"></i></span>
                                                </div>

                                                <div class="ul-single-accordion-item__body">
                                                    <p>Green Biller is fully GST-compliant and lets you generate GST invoices with HSN/SAC
                                                        codes, tax rates, and automatic GST reports.</p>
                                                </div>
                                            </div>

                                            <div class="ul-single-accordion-item">
                                                <div class="ul-single-accordion-item__header">
                                                    <div class="left">
                                                        <h3 class="ul-single-accordion-item__title">Which is the best free billing software
                                                            for PC?</h3>
                                                    </div>
                                                    <span class="icon"><i class="flaticon-right"></i></span>
                                                </div>

                                                <div class="ul-single-accordion-item__body">
                                                    <p>Green Biller is one of the top free billing software options for Windows PC, offering
                                                        invoicing, stock tracking, and GST features without needing an internet connection.
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="ul-single-accordion-item">
                                                <div class="ul-single-accordion-item__header">
                                                    <div class="left">
                                                        <h3 class="ul-single-accordion-item__title">Which is the best free billing software
                                                            in India?</h3>
                                                    </div>
                                                    <span class="icon"><i class="flaticon-right"></i></span>
                                                </div>

                                                <div class="ul-single-accordion-item__body">
                                                    <p>Green Biller is designed for Indian businesses. It supports GST rules, local
                                                        languages, and regional tax formats — making it a top choice for free billing in
                                                        India.</p>
                                                </div>
                                            </div>

                                            <div class="ul-single-accordion-item">
                                                <div class="ul-single-accordion-item__header">
                                                    <div class="left">
                                                        <h3 class="ul-single-accordion-item__title">How do I invoice clients for free?</h3>
                                                    </div>
                                                    <span class="icon"><i class="flaticon-right"></i></span>
                                                </div>

                                                <div class="ul-single-accordion-item__body">
                                                    <p>Just sign up on Green Biller, create your customer list, and start generating
                                                        professional GST invoices — all for free.</p>
                                                </div>
                                            </div>

                                            <div class="ul-single-accordion-item">
                                                <div class="ul-single-accordion-item__header">
                                                    <div class="left">
                                                        <h3 class="ul-single-accordion-item__title">What is online billing software?</h3>
                                                    </div>
                                                    <span class="icon"><i class="flaticon-right"></i></span>
                                                </div>

                                                <div class="ul-single-accordion-item__body">
                                                    <p>Online billing software lets you create, send, and track invoices from any device
                                                        with internet access. Green Biller also supports online and offline modes.</p>
                                                </div>
                                            </div>

                                            <div class="ul-single-accordion-item">
                                                <div class="ul-single-accordion-item__header">
                                                    <div class="left">
                                                        <h3 class="ul-single-accordion-item__title">What is the cheapest billing software?
                                                        </h3>
                                                    </div>
                                                    <span class="icon"><i class="flaticon-right"></i></span>
                                                </div>

                                                <div class="ul-single-accordion-item__body">
                                                    <p>Green Biller offers competitive pricing with a free plan and paid upgrades that are
                                                        among the most affordable in the Indian market.</p>
                                                </div>
                                            </div>

                                            <div class="ul-single-accordion-item">
                                                <div class="ul-single-accordion-item__header">
                                                    <div class="left">
                                                        <h3 class="ul-single-accordion-item__title">How do I get a computerised GST bill?
                                                        </h3>
                                                    </div>
                                                    <span class="icon"><i class="flaticon-right"></i></span>
                                                </div>

                                                <div class="ul-single-accordion-item__body">
                                                    <p>Use Green Biller to generate computerised GST invoices instantly. You can print,
                                                        download, or share them via email or WhatsApp.</p>
                                                </div>
                                            </div>

                                            <div class="ul-single-accordion-item">
                                                <div class="ul-single-accordion-item__header">
                                                    <div class="left">
                                                        <h3 class="ul-single-accordion-item__title"> What is offline invoicing?</h3>
                                                    </div>
                                                    <span class="icon"><i class="flaticon-right"></i></span>
                                                </div>

                                                <div class="ul-single-accordion-item__body">
                                                    <p>Offline invoicing allows you to create and manage bills without an internet
                                                        connection. Green Biller supports both offline and online billing.</p>
                                                </div>
                                            </div>

                                            <div class="ul-single-accordion-item">
                                                <div class="ul-single-accordion-item__header">
                                                    <div class="left">
                                                        <h3 class="ul-single-accordion-item__title"> What is offline billing software?</h3>
                                                    </div>
                                                    <span class="icon"><i class="flaticon-right"></i></span>
                                                </div>

                                                <div class="ul-single-accordion-item__body">
                                                    <p>Offline billing software, like Green Biller, works even without internet. You can
                                                        generate invoices, manage stock, and sync your data once you're online.</p>
                                                </div>
                                            </div> -->

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- FAQ SECTION END -->


        <!-- PRICING SECTION START -->
        <!--
                            <section class="ul-pricing-2 ul-section-spacing">
                                <div class="ul-pricing-2-container">
                                    <div class="ul-section-heading justify-content-center text-center">
                                        <div class="left">
                                            <span class="ul-2-section-sub-title">Pricing Table</span>
                                            <h2 class="ul-2-section-title">Choose The Plans That Suits You!</h2>
                                            <p class="ul-2-section-descr">Perfect for individuals and small teams getting started with digital tools. </p>


                                            <div class="jo-videos-filter-toggle d-none">

                                                <label class="jo-videos-toggle-switch">
                                                    <input type="checkbox" hidden>
                                                    <span class="toggle-label free"><i class="flaticon-play"></i> Free Videos</span>
                                                    <span class="slider"></span>
                                                    <span class="toggle-label premium"><i class="flaticon-premium-quality"></i> Premium Videos</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row ul-bs-row row-cols-lg-3 row-cols-sm-2 row-cols-1">

                                        <div class="col">
                                            <div class="ul-pricing-package ul-pricing-package-2">

                                                <div class="top">
                                                    <div class="ul-pricing-package-heading">
                                                        <span class="ul-pricing-package-name">Basic Plan</span>
                                                        <div class="ul-pricing-package-heading-bottom">
                                                            <h3 class="ul-pricing-package-price">$19</h3>
                                                            <div class="right">
                                                                <span class="ul-pricing-package-duration"><span class="divider">/</span>Month</span>
                                                            </div>
                                                        </div>
                                                        <p class="ul-pricing-package-descr">Perfect for individuals and startups looking to get started with essential features and dependable support.</p>
                                                    </div>


                                                    <div class="ul-pricing-package-body">
                                                        <ul class="ul-pricing-package-body-list">
                                                            <li>Essential tools and features</li>
                                                            <li>Reliable support for growing users</li>
                                                            <li>Limited project access</li>
                                                            <li>Basic analytics</li>
                                                            <li>Email support</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <a href="#" class="ul-pricing-package-btn">Choose a Plan</a>
                                            </div>
                                        </div>


                                        <div class="col">
                                            <div class="ul-pricing-package ul-pricing-package-2">

                                                <div class="top">
                                                    <div class="ul-pricing-package-heading">
                                                        <span class="ul-pricing-package-name">Standard Plan</span>
                                                        <div class="ul-pricing-package-heading-bottom">
                                                            <h3 class="ul-pricing-package-price">$29</h3>
                                                            <div class="right">
                                                                <span class="ul-pricing-package-duration"><span class="divider">/</span>Month</span>
                                                            </div>
                                                        </div>
                                                        <p class="ul-pricing-package-descr">Best for growing businesses needing more control and collaboration.</p>
                                                    </div>


                                                    <div class="ul-pricing-package-body">
                                                        <ul class="ul-pricing-package-body-list">
                                                            <li>All Basic features</li>
                                                            <li>Extended team access</li>
                                                            <li>Advanced reporting tools</li>
                                                            <li>Priority email + chat support</li>
                                                            <li>Automation options</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <a href="#" class="ul-pricing-package-btn">Choose a Plan</a>
                                            </div>
                                        </div>


                                        <div class="col">
                                            <div class="ul-pricing-package ul-pricing-package-2">

                                                <div class="top">
                                                    <div class="ul-pricing-package-heading">
                                                        <span class="ul-pricing-package-name">Premium Plan</span>
                                                        <div class="ul-pricing-package-heading-bottom">
                                                            <h3 class="ul-pricing-package-price">$39</h3>
                                                            <div class="right">
                                                                <span class="ul-pricing-package-duration"><span class="divider">/</span>Month</span>
                                                            </div>
                                                        </div>
                                                        <p class="ul-pricing-package-descr">Designed for teams that need full access, flexibility, and premium support.</p>
                                                    </div>

                                                    <div class="ul-pricing-package-body">
                                                        <ul class="ul-pricing-package-body-list">
                                                            <li>All Standard features</li>
                                                            <li>Unlimited projects and users</li>
                                                            <li>Giving our best</li>
                                                            <li>24/7 Skilled Support</li>
                                                            <li>We serve differently</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <a href="#" class="ul-pricing-package-btn">Choose a Plan</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="ul-pricing-2-clients ul-section-spacing pb-0">
                                    <div class="ul-clients-2-container">
                                        <span class="ul-clients-2-title">Trusted by nearly 50+ paying customers</span>
                                        <div class="swiper ul-clients-2-slider">
                                            <div class="swiper-wrapper">

                                                <div class="swiper-slide"><img src=" {{ asset('home-assets/img/brand-1.png')}}" alt="Client Image"></div>

                                                <div class="swiper-slide"><img src=" {{ asset('home-assets/img/brand-2.png')}}" alt="Client Image"></div>

                                                <div class="swiper-slide"><img src=" {{ asset('home-assets/img/brand-3.png')}}" alt="Client Image"></div>

                                                <div class="swiper-slide"><img src=" {{ asset('home-assets/img/brand-4.png')}}" alt="Client Image"></div>

                                                <div class="swiper-slide"><img src=" {{ asset('home-assets/img/brand-5.png')}}" alt="Client Image"></div>

                                                <div class="swiper-slide"><img src=" {{ asset('home-assets/img/brand-1.png')}}" alt="Client Image"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            -->
        <!-- PRICING SECTION END -->


        <!-- BLOG SECTION START -->
        <!--
                            <section class="ul-blogs-2 ul-section-spacing">
                                <div class="ul-container">

                                    <div class="ul-section-heading align-items-center align-items-sm-end">
                                        <div class="left">
                                            <span class="ul-2-section-sub-title">Our Blog</span>
                                            <h2 class="ul-2-section-title mb-0">Recent Articles And Latest Blog</h2>
                                        </div>

                                        <div class="right">
                                            <a href="blog.html" class="ul-2-btn">Discover More <i class="flaticon-next-1"></i></a>
                                        </div>
                                    </div>



                                    <div class="row ul-bs-row row-cols-lg-3 row-cols-sm-2 row-cols-1 ul-blogs-row">

                                        <div class="col">
                                            <div class="ul-blog-2">
                                                <div class="ul-blog-2-img">
                                                    <img src=" {{ asset('home-assets/img/blog-3.jpg')}}" alt="Blog Image">
                                                    <span class="ul-blog-2-tag"><i class="flaticon-link"></i> Workplace</span>
                                                </div>
                                                <div class="ul-blog-2-txt">
                                                    <a href="blog-details.html" class="ul-blog-2-title">Top Benefits of Digital Billing for Small Businesses</a>
                                                    <div class="ul-blog-2-infos">

                                                        <div class="ul-blog-2-info">
                                                            <span class="icon"><i class="flaticon-user"></i></span>
                                                            <span class="text">By Admin</span>
                                                        </div>

                                                        <div class="ul-blog-2-info">
                                                            <span class="icon"><i class="flaticon-bubble-chat"></i></span>
                                                            <span class="text">2 Comments</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col">
                                            <div class="ul-blog-2">
                                                <div class="ul-blog-2-img">
                                                    <img src=" {{ asset('home-assets/img/blog-b-1.jpg')}}" alt="Blog Image">
                                                    <span class="ul-blog-2-tag"><i class="flaticon-link"></i> Workplace</span>
                                                </div>
                                                <div class="ul-blog-2-txt">
                                                    <a href="blog-details.html" class="ul-blog-2-title">How to Choose the Right GST Billing Software</a>
                                                    <div class="ul-blog-2-infos">

                                                        <div class="ul-blog-2-info">
                                                            <span class="icon"><i class="flaticon-user"></i></span>
                                                            <span class="text">By Admin</span>
                                                        </div>

                                                        <div class="ul-blog-2-info">
                                                            <span class="icon"><i class="flaticon-bubble-chat"></i></span>
                                                            <span class="text">2 Comments</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col">
                                            <div class="ul-blog-2">
                                                <div class="ul-blog-2-img">
                                                    <img src=" {{ asset('home-assets/img/blog-b-2.jpg')}}" alt="Blog Image">
                                                    <span class="ul-blog-2-tag"><i class="flaticon-link"></i> Workplace</span>
                                                </div>
                                                <div class="ul-blog-2-txt">
                                                    <a href="blog-details.html" class="ul-blog-2-title"> 5 Ways Billing Automation Increases Profitability</a>
                                                    <div class="ul-blog-2-infos">

                                                        <div class="ul-blog-2-info">
                                                            <span class="icon"><i class="flaticon-user"></i></span>
                                                            <span class="text">By Admin</span>
                                                        </div>

                                                        <div class="ul-blog-2-info">
                                                            <span class="icon"><i class="flaticon-bubble-chat"></i></span>
                                                            <span class="text">2 Comments</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    -->
        <!-- vector -->
        <img src=" {{ asset('home-assets/img/blog-vector.png')}}" alt="vector" class="ul-blogs-vector">
        </section>
        <!-- BLOG SECTION END -->
    </main>

@endsection