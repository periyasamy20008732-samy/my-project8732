<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

    <!-- Meta SEO Tags -->
    <meta name="description" content="{{ $settings->meta_description ?? 'POS - Bootstrap Admin Template' }}">
    <meta name="keywords" content="{{ $settings->meta_keywords ?? 'admin, pos, bootstrap, responsive, business' }}">
    <meta name="author" content="{{ $settings->meta_author ?? 'Dreamguys - Bootstrap Admin Template' }}">
    <meta name="robots" content="noindex, nofollow">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $settings->site_title ?? 'Green Biller' }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('logo1.jpeg')}}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ asset('admin-assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/plugins/fontawesome/css/all.min.css') }}">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('admin-assets/css/style.css') }}">

    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
</head>

<body class="account-page">

    <div id="global-loader">
        <div class="whirly-loader"> </div>
    </div>

    <div class="main-wrapper">
        <div class="account-content">
            <div class="login-wrapper login-new">
                <div class="container">
                    <div class="login-content user-login">
                        <div class="login-logo">
                            <img src="{{ asset('logo.png') }}" alt="img">
                            <a href="/admin" class="login-logo logo-white">
                                <img src="{{ asset('logo.png') }}" alt="">
                            </a>
                        </div>

                        <!-- SweetAlert error popup -->
                        @if ($errors->any())
                        <script>
                            Swal.fire({
                                    icon: 'error',
                                    title: 'Login Failed',
                                    text: '{{ $errors->first() }}',
                                    confirmButtonColor: '#d33',
                                });
                        </script>
                        @endif

                        <!-- Login Form -->
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="login-userset">
                                <div class="login-userheading">
                                    <h3>Sign In</h3>
                                    <h4>Access the Greenbiller Admin panel using your email and passcode.</h4>
                                </div>

                                <div class="form-login">
                                    <label class="form-label">Email Address</label>
                                    <div class="form-addons">
                                        <input type="email" name="email" required>
                                        <img src="{{ asset('admin-assets/img/icons/mail.svg') }}" alt="img">
                                    </div>
                                </div>

                                <div class="form-login">
                                    <label>Password</label>
                                    <div class="pass-group">
                                        <input type="password" name="password" required>
                                        <span class="fas toggle-password fa-eye-slash"></span>
                                    </div>
                                </div>

                                <div class="form-login authentication-check">
                                    <div class="row">
                                        <div class="col-6">
                                            <label class="checkboxs ps-4 mb-0 pb-0 line-height-1">
                                                <input type="checkbox" name="remember">
                                                <span class="checkmarks"></span>Remember me
                                            </label>
                                        </div>
                                        <div class="col-6 text-end">
                                            <a class="forgot-link" href="forgot-password-3.html">Forgot Password?</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-login">
                                    <button class="btn btn-login" type="submit" name="login">Sign In</button>
                                </div>
                            </div>
                        </form>

                    </div>

                    <div class="my-4 d-flex justify-content-center align-items-center copyright-text">
                        <p>Copyright &copy; 2023 GreenBiller. All rights reserved</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sticky Theme Sidebar -->
    <div class="customizer-links" id="setdata">
        <ul class="sticky-sidebar">
            <li class="sidebar-icons">
                <a href="#" class="navigation-add" data-bs-toggle="tooltip" data-bs-placement="left"
                    data-bs-original-title="Theme">
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

    @push('scripts')


    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session('success') }}',
            timer: 2000,
            showConfirmButton: false
        });
    </script>
    @endif
    @endpush

</body>

</html>