<!-- Header -->
<div class="header">

	<!-- Logo -->
	<div class="header-left active">
		@if(!empty($settings->min_logo))
		<a href="{{ route('admin.dashboard') }}" class="logo logo-normal">
			<img src="{{ asset('storage/core/' . $settings->min_logo) }}" alt="App Logo">
		</a>
		@else
		<a href="{{ route('admin.dashboard') }}" class="logo logo-normal">
			<img src="{{ asset('admin-assets/img/logo.png') }}" alt="Default Logo">
		</a>
		@endif

		<a href="index.html" class="logo logo-white">
			<img src="admin-assets/img/logo-white.png" alt="">
		</a>
		<a href="index.html" class="logo-small">
			<img src="admin-assets/img/logo-small.png" alt="">
		</a>
		<a id="toggle_btn" href="javascript:void(0);">
			<i data-feather="chevrons-left" class="feather-16"></i>
		</a>
	</div>
	<!-- /Logo -->

	<a id="mobile_btn" class="mobile_btn" href="#sidebar">
		<span class="bar-icon">
			<span></span>
			<span></span>
			<span></span>
		</span>
	</a>

	<!-- Header Menu -->
	<ul class="nav user-menu">

		<!-- Search -->
		<li class="nav-item nav-searchinputs">
			<div class="top-nav-search">
				<a href="javascript:void(0);" class="responsive-search">
					<i class="fa fa-search"></i>
				</a>

			</div>
		</li>
		<!-- /Search -->



		{{-- <li class="nav-item nav-item-box">
			<a href="general-settings.html"><i data-feather="settings"></i></a>
		</li> --}}
		<li class="nav-item dropdown has-arrow main-drop">
			<a href="javascript:void(0);" class="dropdown-toggle nav-link userset" data-bs-toggle="dropdown">
				<span class="user-info">
					<span class="user-letter">
						<img src="{{ asset('admin-assets/img/profiles/profile.png') }}" alt="" class="img-fluid">


					</span>
					<span class="user-detail">
						<span class="user-name">{{ Auth::user()->name }}</span>
						<span class="user-role">{{ Auth::user()->user_level == 4 && 5 ? 'Store Admin' : 'Manager'
							}}</span>
					</span>
				</span>
			</a>
			<div class="dropdown-menu menu-drop-user">
				<div class="profilename">
					<div class="profileset">
						<span class="user-img"><img src="{{ asset('admin-assets/img/profiles/profile.png') }}" alt=""
								class="img-fluid">
							<span class="status online"></span></span>
						<div class="profilesets">
							<h6>{{ Auth::user()->name }}</h6>
							<h5>{{ Auth::user()->user_level == 4 ? 'Store Admin' : (Auth::user()->user_level == 2 ?
								'Manager' : (Auth::user()->user_level == 3 ? 'Staff' : 'Unknown Role')) }}</h5>

						</div>
					</div>
					<hr class="m-0">
					<a class="dropdown-item" href="profile.html"> <i class="me-2" data-feather="user"></i> My
						Profile</a>
					<a class="dropdown-item" href="general-settings.html"><i class="me-2"
							data-feather="settings"></i>Settings</a>
					<hr class="m-0">
					{{-- <a class="dropdown-item logout pb-0" href="{{ route('logout') }}"><img
							src="admin-assets/img/icons/log-out.svg" class="me-2" alt="img">Logout</a> --}}
					<a class="dropdown-item logout pb-0" href="#"
						onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> <i
							data-feather="log-out"></i>Logout
					</a>
					<form id="logout-form" action="{{ route('store.logout') }}" method="POST" style="display: none;">
						@csrf
					</form>

				</div>
			</div>
		</li>
	</ul>
	<!-- /Header Menu -->

	<!-- Mobile Menu -->
	<div class="dropdown mobile-user-menu">
		<a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
			aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
		<div class="dropdown-menu dropdown-menu-right">
			<a class="dropdown-item" href="profile.html">My Profile</a>
			<a class="dropdown-item" href="general-settings.html">Settings</a>
			<a class="dropdown-item" href="signin.html">Logout</a>
		</div>
	</div>
	<!-- /Mobile Menu -->
</div>
<!-- /Header -->