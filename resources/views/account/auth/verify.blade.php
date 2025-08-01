<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="robots" content="noindex, nofollow">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @if(!empty($settings->fav_icon))
        <link rel="icon" href="{{ asset('storage/core/' . $settings->fav_icon) }}" type="image/png">
    @else
        <link rel="icon" href="{{ asset('admin-assets/img/logo.png') }}" type="image/png">
    @endif

    <title>{{ $settings->site_title ?? 'Green Biller' }} | Account</title>
    <link href="{{ asset('account-assets/css/styles.css')}}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            @if (Auth::check())
                <script>
                    window.location.href = "{{ route('account.dashboard') }}";
                </script>
            @endif
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <center><img src="{{ asset('storage/core/' . $settings->web_logo) }}"
                                            style="width: 50%;"></center>

                                    <h3 class="text-center font-weight-light my-4">Verify</h3>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="{{ route('verifyotp') }}">
                                        @csrf

                                        <input type="text" name="mobile" value="{{ $mobile }}" hidden>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputPassword" type="text" placeholder="otp"
                                                name="otp" required minlength="4" maxlength="4" />
                                            <label for="inputPassword">OTP</label>
                                        </div>
                                        <!-- <div class="form-check mb-3">
                                            <input class="form-check-input" id="inputRememberPassword" type="checkbox"
                                                value="" />
                                            <label class="form-check-label" for="inputRememberPassword">Remember
                                                Password</label>
                                        </div> -->
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <button type="submit" class="btn btn-primary">Verify</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small"><a href="#">Resend</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; {{ $settings->site_title}} v
                            {{ $settings->app_version  }}
                        </div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="{{ asset('account-assets/js/scripts.js')}}"></script>
</body>

</html>