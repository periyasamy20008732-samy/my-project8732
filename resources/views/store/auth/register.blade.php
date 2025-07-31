<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    
    <!-- Meta SEO Tags (Dynamic from Settings) -->
    <meta name="description" content="{{ $settings->meta_description ?? 'POS - Bootstrap Admin Template' }}">
    <meta name="keywords" content="{{ $settings->meta_keywords ?? 'admin, pos, bootstrap, responsive, business' }}">
    <meta name="author" content="{{ $settings->meta_author ?? 'Dreamguys - Bootstrap Admin Template' }}">
    <meta name="robots" content="noindex, nofollow">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $settings->site_title ?? 'Green Biller' }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('logo1.jpeg') }}">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('admin-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/css/style.css') }}">
</head>
<body class="account-page">
    <div id="global-loader">
        <div class="whirly-loader"></div>
    </div>

    <div class="main-wrapper">
        <div class="account-content">
            <div class="login-wrapper">
                <div class="login-content">
                    <form action="{{ route('storelogin.form') }}" method="POST">
                        @csrf
                        <div class="login-userset">
                            <div class="login-logo logo-normal">
                                <img src="{{ asset('logo.png') }}" alt="Logo">
                            </div>
                            <a href="#" class="login-logo logo-white">
                                <img src="{{ asset('admin-assets/img/logo-white.png') }}" alt="White Logo">
                            </a>
                            <div class="login-userheading">
                                <h3>Register</h3>
                                <h4>Create New GreenBiller Account</h4>
                            </div>

                            <div class="form-login">
                                <label>Name</label>
                                <div class="form-addons">
                                    <input type="text" name="name" class="form-control" required>
                                    <img src="{{ asset('admin-assets/img/icons/user-icon.svg') }}" alt="User">
                                </div>
                            </div>

                            <div class="form-login">
                                <label>Email Address</label>
                                <div class="form-addons">
                                    <input type="email" name="email" class="form-control" required>
                                    <img src="{{ asset('admin-assets/img/icons/mail.svg') }}" alt="Email">
                                </div>
                            </div>

                            <div class="form-login">
                                <label>Password</label>
                                <div class="pass-group">
                                    <input type="password" name="password" class="pass-input form-control" required>
                                    <span class="fas toggle-password fa-eye-slash"></span>
                                </div>
                            </div>

                            <div class="form-login">
                                <label>Confirm Password</label>
                                <div class="pass-group">
                                    <input type="password" name="password_confirmation" class="pass-input form-control" required>
                                    <span class="fas toggle-password fa-eye-slash"></span>
                                </div>
                            </div>

                            <div class="form-login authentication-check">
                                <div class="custom-control custom-checkbox justify-content-start">
                                    <label class="checkboxs ps-4 mb-0 pb-0 line-height-1">
                                        <input type="checkbox" name="terms" required>
                                        <span class="checkmarks"></span>
                                        I agree to the <a href="#" class="hover-a">Terms & Privacy</a>
                                    </label>
                                </div>
                            </div>

                            <div class="form-login">
                                <button type="submit" class="btn btn-login">Sign Up</button>
                            </div>

                            <div class="signinform">
                                <h4>Already have an account?
                                    <a href="{{ route('storelogin.form') }}" class="hover-a">Sign In Instead</a>
                                </h4>
                            </div>

                            <div class="form-setlogin or-text">
                                <h4>OR</h4>
                            </div>

                            <div class="form-sociallink">
                                <ul class="d-flex">
                                    <li>
                                        <a href="#" class="facebook-logo">
                                            <img src="{{ asset('admin-assets/img/icons/facebook-logo.svg') }}" alt="Facebook">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="{{ asset('admin-assets/img/icons/google.png') }}" alt="Google">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="apple-logo">
                                            <img src="{{ asset('admin-assets/img/icons/apple-logo.svg') }}" alt="Apple">
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="my-4 d-flex justify-content-center align-items-center copyright-text">
                                <p>Copyright &copy; 2023 Dreams POS. All rights reserved</p>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="login-img">
                    <img src="{{ asset('logo1.jpeg') }}" alt="Login Image">
                </div>
            </div>
        </div>
    </div>

    <!-- Customizer Sidebar (if used) -->
    <div class="customizer-links" id="setdata">
        <ul class="sticky-sidebar">
            <li class="sidebar-icons">
                <a href="#" class="navigation-add" data-bs-toggle="tooltip" data-bs-placement="left" title="Theme">
                    <i data-feather="settings" class="feather-five"></i>
                </a>
            </li>
        </ul>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('admin-assets/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('admin-assets/js/feather.min.js') }}"></script>
    <script src="{{ asset('admin-assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin-assets/js/theme-script.js') }}"></script>
    <script src="{{ asset('admin-assets/js/script.js') }}"></script>

    <script>
        // Password toggle functionality
        $('.toggle-password').on('click', function () {
            const input = $(this).siblings('input');
            const type = input.attr('type') === 'password' ? 'text' : 'password';
            input.attr('type', type);
            $(this).toggleClass('fa-eye fa-eye-slash');
        });
    </script>
</body>
</html>
