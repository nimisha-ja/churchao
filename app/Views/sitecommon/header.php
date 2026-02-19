
<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, shrink-to-fit=9">
		<meta name="description" content="Gambolthemes">
		<meta name="author" content="Gambolthemes">		
		<title>St. Alphonsa Church - Groups</title>
		
		<!-- Favicon Icon -->
		<link rel="icon" type="image/png" href="images/fav.png">
		
		<!-- Stylesheets -->
		<link href="https://fonts.googleapis.com/css2?family=Heebo:wght@100;300;400;500;700;800;900&display=swap" rel="stylesheet">
		<link href="<?= base_url('public/layout/'); ?>css/style.css" rel="stylesheet">
		<link href="<?= base_url('public/layout/'); ?>css/responsive.css" rel="stylesheet">
		<link href="<?= base_url('public/layout/'); ?>css/night-mode.css" rel="stylesheet">
		
		<!-- Vendor Stylesheets -->
		<link href="<?= base_url('public/layout/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
		<link href="<?= base_url('public/layout/'); ?>vendor/feather-icons/feather.css" rel="stylesheet">
		<link href='<?= base_url('public/layout/'); ?>vendor/unicons-2.0.1/css/unicons.css' rel='stylesheet'>
		<link href="<?= base_url('public/layout/'); ?>vendor/OwlCarousel/assets/owl.carousel.css" rel="stylesheet">
		<link href="<?= base_url('public/layout/'); ?>vendor/OwlCarousel/assets/owl.theme.default.min.css" rel="stylesheet">
		<link href="<?= base_url('public/layout/'); ?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		
	</head>

<body>
<header class="header clearfix">
		<div class="header-inner">
			<nav class="navbar navbar-expand-lg bg-micko micko-head justify-content-sm-start micko-top pt-0 pb-0 px-2 px-lg-4">
				<div class="container">	
					<button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
						<span class="micko-toggler-icon">
							<i class="feather-menu"></i>
						</span>
					</button>
					<a class="navbar-bran ms-lg-0 ml-2 me-auto" href="<?= base_url(''); ?>">
						<div class="res_main_logo">
							<img src="images/res-logo.png" alt="">
						</div>
						<div class="main_logo" id="logo">
							<img src="images/logo.png" alt="">
							<p style="font-weight: 800;text-transform: uppercase;">St. Alphonsa Church Valiyakolly</p>
						</div>
					</a>
					<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
						<div class="offcanvas-header">
							<div class="offcanvas-logo" id="offcanvasNavbarLabel">
								<img src="images/res-logo.png" alt="">
							</div>
							<button type="button" class="close-btn btn-color" data-bs-dismiss="offcanvas" aria-label="Close">
								<i class="feather-x"></i>
							</button>
						</div>
						<div class="offcanvas-body">
							<!-- <div class="offcanvas-search">
								<form class="search-form-header">
									<input class="search-form-control" type="search" placeholder="Search..." aria-label="Search">
									<button class="search-btn btn-color btn-hover"><i class="feather-search"></i></button>
								</form>
							</div> -->
							<ul class="navbar-nav justify-content-end flex-grow-1 pe_5">
								<li class="nav-item">
									<a class="nav-link active" aria-current="page" href="<?= base_url(''); ?>">
										<span class="nav-icon d-lg-none">
											<i class="feather-home"></i>
										</span>
										Home
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="<?= base_url('/history'); ?>">
										<span class="nav-icon  d-lg-none">
											<i class="feather-users"></i>
										</span>
										History
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="<?= base_url(''); ?>">
										<span class="nav-icon  d-lg-none">
											<i class="feather-users"></i>
										</span>
										Updates
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="<?= base_url(''); ?>">
										<span class="nav-icon  d-lg-none">
											<i class="feather-users"></i>
										</span>
										Parish Bulletin
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="<?= base_url(''); ?>">
										<span class="nav-icon  d-lg-none">
											<i class="feather-users"></i>
										</span>
										Contact
									</a>
								</li>


							</ul>
						</div>
					</div>
					<div class="msg-noti-acnt-section order-2">
						<ul class="mn-icons-set ms-3 align-self-stretch">
							<!-- <li class="mn-icon">
								<a class="mn-link" href="messages.html" role="button">
									<i class="feather-message-square"></i>
									<div class="alert-circle"></div>
								</a>							
							</li>
							<li class="mn-icon">
								<a class="mn-link" href="all_notifications.html" role="button">
									<i class="feather-bell"></i>
									<div class="alert-circle"></div>
								</a>
							</li> -->
							<li class="mn-icon dropdown dropdown-account ms-4">
								<a href="#" class="opts_account" role="button" id="dropdownMenuClickableInside" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
									<img src="images/left-imgs/img-1.jpg" alt="">
									<i class="fas fa-caret-down arrow-icon"></i>
								</a>
								<ul class="dropdown-menu dropdown-menu-account dropdown-menu-end" aria-labelledby="dropdownMenuClickableInside">
									<li class="media-list">
										<div class="night_mode_switch__btn">
											<a href="#" id="night-mode" class="btn-night-mode">
												<i class="far fa-moon"></i>Night mode
												<span class="btn-night-mode-switch">
													<span class="uk-switch-button"></span>
												</span>
											</a>
										</div>
										<a href="<?= base_url('/'); ?>" class="item ac_item channel_item mt-2"><i class="feather-align-right"></i>Profile Timeline</a>										
									</li>
									<li class="dropdown-menu-footer">
										<a class="dropdown-item-link text-link text-center" href="<?= base_url('/userlogout'); ?>">Logout</a>
									</li>
								</ul>
							</li>
						</ul>
					</div>
					<div class="pp-toggler order-3">
						<button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#ppcanvasNavbar" aria-controls="ppcanvasNavbarLabel">
							<span class="micko-toggler-icon">
								<i class="feather-sliders"></i>
							</span>
						</button>
					</div>
				</div>
			</nav>
			<div class="overlay"></div>
		</div>
	</header>