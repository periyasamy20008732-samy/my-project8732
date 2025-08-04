@extends('layouts.app')
@section('content')


    <main>
        <!-- BREADCRUMBS SECTION START -->
        <section class="ul-breadcrumb ul-section-spacing">
            <div class="ul-container">
                <ul class="ul-breadcrumb-nav">
                    <li><a href="/">Home</a></li>
                    <li><span class="separator"><i class="flaticon-right"></i></span></li>
                    <li>Partner Programe</li>
                </ul>
                <h2 class="ul-breadcrumb-title">Become Partner</h2>
            </div>
        </section>
        <!-- BREADCRUMBS SECTION END -->

        <section class="ul-review-contact ul-section-spacing wow animate__fadeInUp">

            <div class="bg-img">
                <img src="home-assets/img/contact-review-bg-img.jpg" alt="Image">
            </div>

            <div class="ul-container">
                <div class="row ul-review-contact-row row-cols-md-2 row-cols-1 align-items-center">

                    <div class="col">
                        <div class="ul-contact-form-wrapper">
                            <div>
                                <span class="ul-section-sub-title">Welcome</span>
                                <h2 class="ul-section-title">Become a Partner!</h2>

                                <form action="#" class="ul-contact-form">
                                    <div class="row ul-bs-row row-cols-2 row-cols-xxs-1">

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="ul-contact-name">Your Name*</label>
                                                <input type="text" name="name" id="ul-contact-name" placeholder="Robot fox">
                                            </div>
                                        </div>


                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="ul-contact-phone">Your Phone*</label>
                                                <input type="tel" name="phone" id="ul-contact-phone"
                                                    placeholder="+1253 457 7840">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <button type="submit">Register Now</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                    <div class="col">
                        <div class="ul-reviews">
                            <div>
                                <span class="ul-section-sub-title">Partner Programe</span>
                                <h2 class="ul-section-title">Become Greenbiller Partner & Earn Upto INR 5 Lakh</h2>
                                <p class="ul-reviews-heading-descr">Join 27000+ successful Partners across India earning

                                    ₹200000+ monthly by promoting India’s most loved business accounting software..</p>
                            </div>

                            <div class="ul-reviews-slider-nav ul-slider-nav">
                                <button class="prev"><i class="flaticon-left"></i></button>
                                <button class="next"><i class="flaticon-next-2"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- SERVICES SECTION START -->
        <section class="ul-inner-services ul-section-spacing overflow-hidden">
            <div class="ul-inner-services-container">
                <div class="row row-cols-md-3 row-cols-2 row-cols-xxs-1 ul-bs-row">
                    <!-- single slide -->
                    <div class="col wow animate__fadeInUp">
                        <div class="ul-inner-service">
                            <div class="ul-inner-service-txt">
                                <div class="ul-inner-service-icon">
                                    <i class="flaticon-settings-1"></i>
                                </div>
                                <div class="ul-inner-service-content">
                                    <h3 class="ul-inner-service-title"><a href="service-details.html">Recurring Income</a>
                                    </h3>
                                    <p class="ul-inner-service-descr">Earn commission on initial sales and renewals,
                                        creating a stable income stream that grows over time.</p>

                                </div>
                            </div>

                            <!-- <div class="ul-inner-service-img">
                                                                                                <img src="home-assets/img/recurring_income.png" alt="Image" class="">
                                                                                            </div> -->
                        </div>
                    </div>

                    <!-- single slide -->
                    <div class="col wow animate__fadeInUp">
                        <div class="ul-inner-service">
                            <div class="ul-inner-service-txt">
                                <div class="ul-inner-service-icon">
                                    <i class="flaticon-seo"></i>
                                </div>
                                <div class="ul-inner-service-content">
                                    <h3 class="ul-inner-service-title"><a href="service-details.html">Extensive Support</a>
                                    </h3>
                                    <p class="ul-inner-service-descr">Get marketing materials, training, & dedicated support
                                        team to help you succeed.</p>

                                </div>
                            </div>

                            <!-- <div class="ul-inner-service-img">
                                                                                                    <img src="home-assets/img/extensive_support.png" alt="Image" class="">
                                                                                                </div> -->
                        </div>
                    </div>

                    <!-- single slide -->
                    <div class="col wow animate__fadeInUp">
                        <div class="ul-inner-service">
                            <div class="ul-inner-service-txt">
                                <div class="ul-inner-service-icon">
                                    <i class="flaticon-content-marketing"></i>
                                </div>
                                <div class="ul-inner-service-content">
                                    <h3 class="ul-inner-service-title"><a href="service-details.html">No Investment
                                            Required</a>
                                    </h3>
                                    <p class="ul-inner-service-descr">Start your business with zero investment. No need to
                                        purchase inventory or pay registration fees.</p>

                                </div>
                            </div>

                            <!-- <div class="ul-inner-service-img">
                                                                                                    <img src="home-assets/img/no_investment.png" alt="Image" class="">
                                                                                                </div> -->
                        </div>
                    </div>


                </div>
            </div>
        </section>
        <!-- SERVICES SECTION END -->


        <!-- FAQ SECTION START -->
        <section class="ul-faq wow animate__fadeInUp">
            <div class="ul-container">
                <div class="row ul-bs-row ul-faq-row">
                    <!-- img -->
                    <div class="col-md-5">
                        <div class="ul-faq-img d-flex justify-content-end">
                            <img src="{{  asset('home-assets/img/faq-img.png') }}" alt="Image">
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
                                            <h3 class="ul-single-accordion-item__title">What is the Green Biller Partner
                                                Program?</h3>
                                        </div>
                                        <span class="icon"><i class="flaticon-right"></i></span>
                                    </div>

                                    <div class="ul-single-accordion-item__body">
                                        <p>The Green Biller Partner Program lets you earn by promoting and selling Green
                                            Biller software to small and medium businesses. You earn a commission for every
                                            successful referral, making it a great opportunity to build a consistent income
                                            while helping businesses go digital with smart billing solutions.</p>
                                    </div>
                                </div>

                                <div class="ul-single-accordion-item">
                                    <div class="ul-single-accordion-item__header">
                                        <div class="left">
                                            <h3 class="ul-single-accordion-item__title"> How much can I earn as a Green
                                                Biller partner?
                                            </h3>
                                        </div>
                                        <span class="icon"><i class="flaticon-right"></i></span>
                                    </div>

                                    <div class="ul-single-accordion-item__body">
                                        <p>Your earnings depend on your reach and dedication. On average, Green Biller
                                            partners earn between ₹20,000 to ₹50,000 per month, while our top performers
                                            earn over ₹1 lakh monthly by actively promoting and onboarding new customers.
                                        </p>
                                    </div>
                                </div>

                                <div class="ul-single-accordion-item">
                                    <div class="ul-single-accordion-item__header">
                                        <div class="left">
                                            <h3 class="ul-single-accordion-item__title">Do I need technical knowledge to
                                                become a Green Biller partner?</h3>
                                        </div>
                                        <span class="icon"><i class="flaticon-right"></i></span>
                                    </div>

                                    <div class="ul-single-accordion-item__body">
                                        <p>No technical background is needed. We provide full training, guidance, and
                                            marketing materials to help you confidently promote Green Biller and explain its
                                            benefits to customers with ease.

                                        </p>
                                    </div>
                                </div>
                                <div class="ul-single-accordion-item">
                                    <div class="ul-single-accordion-item__header">
                                        <div class="left">
                                            <h3 class="ul-single-accordion-item__title"> How do I receive payments?
                                            </h3>
                                        </div>
                                        <span class="icon"><i class="flaticon-right"></i></span>
                                    </div>

                                    <div class="ul-single-accordion-item__body">
                                        <p>All commissions are transferred directly to your bank account every month. Green
                                            Biller also gives you access to a dedicated partner dashboard where you can
                                            track your referrals, sales, and earnings in real-time.</p>
                                    </div>
                                </div>
                                <div class="ul-single-accordion-item">
                                    <div class="ul-single-accordion-item__header">
                                        <div class="left">
                                            <h3 class="ul-single-accordion-item__title"> Is there any investment required to
                                                join?
                                            </h3>
                                        </div>
                                        <span class="icon"><i class="flaticon-right"></i></span>
                                    </div>

                                    <div class="ul-single-accordion-item__body">
                                        <p>No, there’s absolutely no investment needed. The Green Biller Partner Program is
                                            completely free to join — you can start promoting and earning without spending
                                            any money.</p>
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


    </main>

@endsection