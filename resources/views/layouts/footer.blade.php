<!-- FOOTER SECTION START -->
<footer class="ul-footer ul-footer-2">
    <!-- footer top -->
    <div class="ul-footer-top">
        <div class="ul-container">
            <div class="ul-footer-top-contact-infos">
                <!-- single info -->
                <div class="ul-footer-top-logo">
                    <a href="/"><img src="{{ asset('logo.png')}}" alt="logo"></a>
                    <div class="ul-footer-socials">
                        <a href="#"><i class="flaticon-facebook-app-symbol"></i></a>
                        <a href="#"><i class="flaticon-twitter"></i></a>
                        <a href="#"><i class="flaticon-linkedin-big-logo"></i></a>
                        <a href="#"><i class="flaticon-instagram"></i></a>
                    </div>
                </div>

                <!-- single info -->
                <div class="ul-footer-top-contact-info">
                    <!-- icon -->
                    <div class="ul-footer-top-contact-info-icon"><i class="flaticon-telephone"></i></div>
                    <!-- txt -->
                    <div class="ul-footer-top-contact-info-txt">
                        <span class="ul-footer-top-contact-info-label">Call Now</span>
                        <h5 class="ul-footer-top-contact-info-address"><a href="tel:8590498808">+918590498808</a></h5>
                    </div>
                </div>

                <!-- single info -->
                <div class="ul-footer-top-contact-info">
                    <!-- icon -->
                    <div class="ul-footer-top-contact-info-icon"><i class="flaticon-mail"></i></div>
                    <!-- txt -->
                    <div class="ul-footer-top-contact-info-txt">
                        <span class="ul-footer-top-contact-info-label">Email Us</span>
                        <h5 class="ul-footer-top-contact-info-address"><a
                                href="mailto:info@greenbiller.in">info@greenbiller.in</a></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- footer middle -->
    <div class="ul-footer-middle">
        <div class="ul-container">
            <div class="ul-footer-middle-wrapper wow animate__fadeInUp">
                <div class="ul-footer-about">
                    <h3 class="ul-footer-widget-title">About Us</h3>
                    <p class="ul-footer-about-txt">Manage your business professionally with Vyapar, India’s leading
                        software for billing, inventory, and accounting. </p>
                    <a href="contact.html" class="ul-footer-about-btn">Contact us <i class="flaticon-top-right"></i></a>
                </div>

                <div class="ul-footer-widget">
                    <h3 class="ul-footer-widget-title">Our Best Service</h3>

                    <div class="ul-footer-widget-links">
                        <a href="service-details.html">IT Management</a>
                        <a href="service-details.html">SEO Optimization</a>
                        <a href="service-details.html">Web Development</a>
                        <a href="service-details.html">Cyber Security</a>
                        <a href="service-details.html">Data Security</a>
                    </div>
                </div>

                <div class="ul-footer-widget ul-footer-recent-posts">
                    <h3 class="ul-footer-widget-title">Important Quick Link</h3>

                    <div class="ul-footer-widget-links">
                        <a href="about.html">About Us</a>
                        <a href="services.html">Our Services</a>
                        <a href="blog.html">Our Blogs</a>
                        <a href="faq.html">FAQ'S</a>
                        <a href="contact.html">Contact Us</a>
                    </div>
                </div>

                <div class="ul-footer-widget ul-nwsltr-widget">
                    <h3 class="ul-footer-widget-title">Contact Us</h3>
                    <div class="ul-footer-widget-links">
                        <span>Monday – Friday : <span class="colored">8am – 4pm</span></span>
                        <span>Saturday : <span class="colored">8am – 12am</span></span>
                    </div>
                    <form action="#" class="ul-nwsltr-form">
                        <div class="top">
                            <input type="email" name="email" id="nwsltr-email" placeholder="Your Email Address"
                                class="ul-nwsltr-input">
                            <button type="submit"><i class="flaticon-next-1"></i></button>
                        </div>

                        <div class="agreement">
                            <label for="nwsltr-agreement" class="ul-checkbox-wrapper">
                                <input type="checkbox" name="agreement" id="nwsltr-agreement" hidden>
                                <span class="ul-checkbox"><i class="flaticon-check-1"></i></span>
                                <span class="ul-checkbox-txt">I agree with the <a href="#">Privacy Policy</a></span>
                            </label>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- footer bottom -->
    <div class="ul-container">
        <div class="ul-footer-bottom">
            <div class="ul-footer-bottom-wrapper justify-content-center">
                <p class="copyright-txt">Copyright &copy;
                    <script>
                        document.write(new Date().getFullYear())
                    </script> All rights reserved. {{ $settings->site_title }}

                </p>
            </div>
        </div>
    </div>

    <!-- vector -->
    <div class="ul-footer-vectors">
        <img src="{{ asset('home-assets/img/footer-2-vector-1.png')}}" alt="Footer Image" class="ul-footer-vector-1">
        <img src="{{ asset('home-assets/img/footer-2-vector-2.png')}}" alt="Footer Image" class="ul-footer-vector-2">
    </div>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <a href="https://api.whatsapp.com/send?phone=919020583270&text=Haii %2C I%20need%20more%20information%20about%20Greenbiller."
        class="float" target="_blank">
        <i class="fa fa-whatsapp my-float"></i>
    </a>
    <style>
        .float {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 40px;
            right: 40px;
            background-color: #25d366;
            color: #FFF;
            border-radius: 50px;
            text-align: center;
            font-size: 30px;
            box-shadow: 2px 2px 3px #999;
            z-index: 100;
        }

        .my-float {
            margin-top: 16px;
        }
    </style>

</footer>
<!-- FOOTER SECTION END -->

<!-- libraries JS -->
<script src="{{ asset('home-assets/vendor/bootstrap/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('home-assets/vendor/splide/splide.min.js')}}"></script>
<script src="{{ asset('home-assets/vendor/splide/splide-extension-auto-scroll.min.js')}}"></script>
<script src="{{ asset('home-assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
<script src="{{ asset('home-assets/vendor/animate-wow/wow.min.js')}}"></script>
<script src="{{ asset('home-assets/vendor/fslightbox/fslightbox.js')}}"></script>
<script src="{{ asset('home-assets/vendor/scrollspy/simple-scrollspy.min.js')}}"></script>


<!-- custom JS -->
<script src="{{ asset('home-assets/js/main.js')}}"></script>
<script src="{{ asset('home-assets/js/tab.js')}}"></script>
<script src="{{ asset('home-assets/js/accordion.js')}}"></script>
<script src="{{ asset('home-assets/js/progressbar.js')}}"></script>
</body>

</html>