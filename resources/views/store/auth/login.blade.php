<!DOCTYPE html>
<html lang="en">
    <head>
       <meta charset="utf-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
       <!-- Meta SEO Tags (Dynamic from Settings) -->
       <metaname="description" content="{{ $settings->meta_description ?? 'POS - Bootstrap Admin Template' }}">
       <meta name="keywords" content="{{ $settings->meta_keywords ?? 'admin, pos, bootstrap, responsive, business' }}">
       <meta name="author" content="{{ $settings->meta_author ?? 'Dreamguys - Bootstrap Admin Template' }}">
       <meta name="robots" content="noindex, nofollow">
       <meta name="csrf-token" content="{{ csrf_token() }}"> 

    	
        <title>{{ $settings->site_title ?? 'Green Biller' }}</title>

   
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('logo1.jpeg')}}">
       
		
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href={{ "admin-assets/css/bootstrap.min.css" }}>
		
        <!-- Fontawesome CSS -->
		<link rel="stylesheet" href= {{ "admin-assets/plugins/fontawesome/css/fontawesome.min.css" }} > 
		<link rel="stylesheet" href={{ "admin-assets/plugins/fontawesome/css/all.min.css" }}>
		
		<!-- Main CSS -->
        <link rel="stylesheet" href={{ "admin-assets/css/style.css" }}>
		
    </head>
    <body class="account-page">

        <div id="global-loader" >
			<div class="whirly-loader"> </div>
		</div>
	
		<!-- Main Wrapper -->
        <div class="main-wrapper">
			<div class="account-content">
				<div class="login-wrapper">
                    <div class="login-content">
                            <form method="POST" action="{{ route('storelogin') }}">
                                @csrf
                            <div class="login-userset">
                                <div class="login-logo logo-normal">
                                   <img src="{{ asset('logo.png')}}"  alt=""> 
                                   {{--  <img src="{{ asset('logo1.jpeg')}}"   alt=""> --}}

                               </div>
                               <a href="index.html" class="login-logo logo-white">
                                    <img src="{{ asset('logo1.jpeg')}}"   alt="">
                               </a>
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                {{ $errors->first() }}
                            </div>
                            @endif  
                               <div class="login-userheading">
                                   <h3>Sign In</h3>
                                   <h4>Access the Dreamspos panel using your email and passcode.</h4>
                               </div>
                              <div class="form-login">
                                   <label>Email Address</label>
                                   <div class="form-addons">
                                       {{-- <input type="text" class="form-control"> --}}
                                       <input type="email"  class="form-control" name="email" required>
                                       <img src={{ "admin-assets/img/icons/mail.svg" }} alt="img">
                                   </div>
                               </div>
                               <div class="form-login">
                                   <label>Password</label>
                                   <div class="pass-group">
                                      {{--  <input type="password" class="pass-input"> --}}
                                       <input type="password" name="password" class="pass-input" required>
                                       <span class="fas toggle-password fa-eye-slash"></span>
                                   </div>
                               </div>
                               <div class="form-login authentication-check">
                                   <div class="row">
                                       <div class="col-6">
                                           <div class="custom-control custom-checkbox">
                                               <label class="checkboxs ps-4 mb-0 pb-0 line-height-1">
                                                   <input type="checkbox">
                                                   <span class="checkmarks"></span>Remember me
                                               </label>
                                           </div>
                                       </div>
                                       <div class="col-6 text-end">
                                           <a class="forgot-link" href="forgot-password-2.html">Forgot Password?</a>
                                       </div>
                                   </div>
                               </div>
                               <div class="form-login">
                                   <button type="submit" class="btn btn-login">Sign In</button>
                               </div>
                               <div class="signinform">
                                   <h4>New on our platform?<a href={{ route('storeregister.form') }} class="hover-a"> Create an account</a></h4>
                               </div>
                               <div class="form-setlogin or-text">
                                   <h4>OR</h4>
                               </div>
                               <div class="form-sociallink">
                                   <ul class="d-flex">
                                       <li>
                                           <a href="javascript:void(0);" class="facebook-logo">
                                               <img src={{ "admin-assets/img/icons/facebook-logo.svg" }} alt="Facebook">
                                           </a>
                                       </li>
                                       <li>
                                           <a href="javascript:void(0);">
                                               <img src={{ "admin-assets/img/icons/google.png" }} alt="Google">
                                           </a>
                                       </li>
                                       <li>
                                           <a href="javascript:void(0);" class="apple-logo">
                                               <img src={{ "admin-assets/img/icons/apple-logo.svg" }} alt="Apple">
                                           </a>
                                       </li>
                                       
                                   </ul>
                                   <div class="my-4 d-flex justify-content-center align-items-center copyright-text">
                                       <p>Copyright &copy; 2023 DreamsPOS. All rights reserved</p>
                                   </div>
                               </div>
                           </div>
                        </form>
                    </div>
                    <div class="login-img">
                        <img src="{{ asset('logo1.jpeg')}}" alt="img">
                       

                    </div>
                </div>
			</div>
        </div>
		<!-- /Main Wrapper -->

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

		<!-- jQuery -->
        <script src={{ "admin-assets/js/jquery-3.7.1.min.js" }}></script>

         <!-- Feather Icon JS -->
		<script src={{ "admin-assets/js/feather.min.js" }}></script>
		
		<!-- Bootstrap Core JS -->
        <script src={{ "admin-assets/js/bootstrap.bundle.min.js" }}></script>
		
		<!-- Custom JS -->
        <script src= {{ "admin-assets/js/theme-script.js" }}></script>	
		<script src={{ "admin-assets/js/script.js" }}></script>

    </body>
</html>