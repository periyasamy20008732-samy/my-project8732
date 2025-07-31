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
                            <div class="has-sub-menu">
                                <a role="button" class="active">Solution</a>

                                <div class="ul-header-submenu">
                                    <ul>
                                        <li><a href="retail-solution">Retail Solution</a></li>
                                        <li><a href="pos">POS Solution</a></li>

                                    </ul>
                                </div>
                            </div>
                            <a href="partner-program">Partner With Us</a>
                            <a href="contact-us">Contact</a>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="ul-header-bottom-right">
                <div class="ul-header-2-bottom-btns">
                    <a href="javascript:void(0)" class="ul-2-btn d-xxs-none" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Log In</a>

                </div>
                <button class="ul-header-sidebar-opener d-lg-none d-inline-flex"><i
                        class="flaticon-right-arrow"></i></button>
            </div>
        </div>
    </div>
</header>


<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <h5 id="offcanvasRightLabel">Login</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <form action="" method="post">

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Mobile</label>
                <div class="row">
                    <div class="col-3">
                        <select name="store_id" id="store_id" class="form-control selectpicker" data-live-search="true">
                            <option value="91">+91</option>
                            <option value="971">+971</option>
                        </select>
                    </div>
                    <div class="col-9"> <input type="email" class="form-control" id="exampleFormControlInput1"
                            placeholder="Enter Phone"></div>
                </div>

            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary col-12">Get OTP -></button>
            </div>

        </form>


    </div>
</div>