<header class="ul-header ul-header-2">
        <div class="ul-header-bottom to-be-sticky wow animate__slideInDown">
            <div class="ul-header-bottom-wrapper ul-header-container">
                <div class="logo-container">
                    <a href="/" class="d-inline-block"><img src="{{ asset('logo.png')}}" alt="logo" class="logo"></a>
                </div>

                <div class="ul-header-bottom-center">
                    <!-- header nav -->
                    <div class="ul-header-nav-wrapper">
                        <div class="to-go-to-sidebar-in-mobile">
                            <nav class="ul-header-nav">
                                {{-- <div class="has-sub-menu">
                                    <a role="button" class="active">Home</a>

                                    <div class="ul-header-submenu">
                                        <ul>
                                            <li><a href="index.html">Home 1</a></li>
                                            <li><a href="index-2.html">Home 2</a></li>
                                            <li><a href="index-3.html">Home 3</a></li>
                                        </ul>
                                    </div>
                                </div> --}}
                                <a href="/">Home</a>
                                <a href="pricing">Pricing</a>
                                <a href="about-us">About</a>                               
                                <a href="partner-program">Partner With Us</a>
                                <a href="contact-us">Contact</a>
                            </nav>
                        </div>
                    </div>
                </div>

                <div class="ul-header-bottom-right">
                    <div class="ul-header-2-bottom-btns">
                        <a href="contact.html" class="ul-2-btn d-xxs-none">Log In</a>
                        <a  href="{{ route('login.form') }}"  class="ul-2-btn d-xxs-none">Admin</a> 
                    </div>
                    <button class="ul-header-sidebar-opener d-lg-none d-inline-flex"><i class="flaticon-right-arrow"></i></button>
                </div>
            </div>
        </div>
    </header>