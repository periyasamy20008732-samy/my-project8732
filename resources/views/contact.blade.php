@extends('layouts.app')
@section('content')
    <main>
        <!-- BREADCRUMBS SECTION START -->
        <section class="ul-breadcrumb ul-section-spacing">
            <div class="ul-container">
                <ul class="ul-breadcrumb-nav">
                    <li><a href="index.html">Home</a></li>
                    <li><span class="separator"><i class="flaticon-right"></i></span></li>
                    <li>Contact Us</li>
                </ul>
                <h2 class="ul-breadcrumb-title">Contact Us</h2>
            </div>
        </section>
        <!-- BREADCRUMBS SECTION END -->


        <!-- CONTACT INFO SECTION START -->
        <div class="ul-section-spacing ul-container">
            <div class="ul-contact-infos">
                <!-- single contact info -->
                <div class="ul-contact-info">
                    <div class="icon"><i class="flaticon-location"></i></div>
                    <div class="txt">
                        <h6 class="title">Our Address</h6>
                        <p class="descr mb-0">First Floor Saradam, Mukkunnoor,Venjarammoodu, Thiruvananthapuram</p>

                    </div>
                </div>

                <!-- single contact info -->
                <div class="ul-contact-info">
                    <div class="icon"><i class="flaticon-email"></i></div>
                    <div class="txt">
                        <h6 class="title">Email Address</h6>
                        <p class="descr mb-0">
                            <a href="mailto:info@greenbiller.in">info@greenbiller.in </a>
                            <a href="mailto:contact@greenbiller.in">contact@greenbiller.in </a>
                        </p>
                    </div>
                </div>

                <!-- single contact info -->
                <div class="ul-contact-info">
                    <div class="icon"><i class="flaticon-customer-support"></i></div>
                    <div class="txt">
                        <h6 class="title">Hours of Operation</h6>
                        <p class="descr mb-0">
                            <span>Sunday-Fri: 9 AM – 6 PM</span><br>
                            <span>Saturday: 9 AM – 4 PM</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- CONTACT INFO SECTION END -->


        <!-- CONTACT MAP -->
        <div class="ul-contact-map">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d8684.030842913655!2d90.36627512368048!3d23.776418440774698!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b8f3f608843b%3A0xf2c71ff392721324!2sLiberation%20War%20Museum!5e0!3m2!1sen!2sbd!4v1730028096808!5m2!1sen!2sbd"
                allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>


        <!-- CONTACT FORM -->
        <div class="ul-contact-from-section">
            <div class="ul-contact-form-2-container">
                <h3 class="ul-contact-form-2-container__title">Get in Touch</h3>
                <form action="#" class="ul-contact-form-2">
                    <div class="grid">
                        <!-- firstname -->
                        <div class="form-group">
                            <div class="position-relative">
                                <input type="text" name="firstname" id="firstname" placeholder="First Name">
                                <span class="field-icon"><i class="flaticon-user"></i></span>
                            </div>
                        </div>

                        <!-- lastname -->
                        <div class="form-group">
                            <div class="position-relative">
                                <input type="text" name="lastname" id="lastname" placeholder="Last Name">
                                <span class="field-icon"><i class="flaticon-user"></i></span>
                            </div>
                        </div>

                        <!-- phone -->
                        <div class="form-group">
                            <div class="position-relative">
                                <input type="tel" name="phone-number" id="phone-number" placeholder="Phone Number">
                                <span class="field-icon"><i class="flaticon-telephone-1"></i></span>
                            </div>
                        </div>
                        <!-- email -->
                        <div class="form-group">
                            <div class="position-relative">
                                <input type="email" name="email" id="email" placeholder="Enter Email Address">
                                <span class="field-icon"><i class="flaticon-email"></i></span>
                            </div>
                        </div>
                        <!-- message -->
                        <div class="form-group">
                            <div class="position-relative">
                                <textarea name="message" id="message" placeholder="Write Message..."></textarea>
                            </div>
                        </div>
                    </div>
                    <!-- submit btn -->
                    <button type="submit">Send Message</button>
                </form>
            </div>
        </div>
    </main>
@endsection