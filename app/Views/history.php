<?= $this->include('sitecommon/header'); ?>

<div class="wrapper pt-0">

	<!-- Breadcrumb Section -->
	<div class="breadcrumb-pt breadcrumb-bg">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="breadcrumb-title">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="<?= base_url(''); ?>">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">About Us</li>
							</ol>
						</nav>
						<h1 class="title_text">About St. Alphonsa Church</h1>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Who We Are -->
	<div class="about-wrapper">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-12">
					<div class="about-us-content">
						<div class="item-subtitle">Who We Are</div>
						<h2 class="item-title">A Place of Faith, Worship, and Community</h2>
						<p class="pitem-description">
							St. Alphonsa Church, Valiyakolli, is a vibrant parish dedicated to fostering spiritual growth, community service, and devotion.
							Our church serves as a sanctuary for prayer, reflection, and fellowship for families and individuals from all walks of life.
							We uphold the teachings of St. Alphonsa and aim to inspire love, compassion, and faith in our congregation.
						</p>
					</div>
				</div>
				<div class="col-lg-6 col-md-12">
					<div class="about-img">
						<img class="img-about" src="<?= base_url('public/layout/'); ?>images/banners/bg-3.jpg" alt="">
						<div class="video-icon">
							<button class="play-btn btn-hover" data-bs-toggle="modal" data-bs-target="#aboutVideoModal">
								<i class="fas fa-play"></i>
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Our Mission and Reach -->
	<div class="about-wrapper bg-white">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="about-us-content text-center process-title">
						<div class="item-subtitle">Our Mission</div>
						<h2 class="item-title">Spreading Faith and Love through Service and Worship</h2>
					</div>
				</div>

				<div class="col-lg-3 col-md-4 col-sm-4">
					<div class="progress-block">
						<div class="progress-title">500+</div>
						<div class="progress-subtitle">Families Served</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-4 col-sm-4">
					<div class="progress-block">
						<div class="progress-title">50+</div>
						<div class="progress-subtitle">Community Programs</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-4 col-sm-4">
					<div class="progress-block">
						<div class="progress-title">20+</div>
						<div class="progress-subtitle">Years of Service</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-4 col-sm-4">
					<div class="progress-block">
						<div class="progress-title">1000+</div>
						<div class="progress-subtitle">Weekly Attendees</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Meet Our Priests -->
	<div class="about-wrapper">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="about-us-content text-center process-title mb-50">
						<div class="item-subtitle">Meet Our Priests</div>
						<h2 class="item-title">Guiding the Parish with Faith and Dedication</h2>
					</div>
				</div>
				<div class="col-lg-6 col-md-12">
					<div class="about-us-content">
						<p class="pitem-description">
							Our clergy team, inspired by the teachings of St. Alphonsa, lead our community in worship, pastoral care, and outreach programs.
							They are committed to nurturing spiritual growth and ensuring that all members feel welcomed and supported in their faith journey.
						</p>
						<a href="<?= base_url('') ?>" class="main-link-btn btn-hover">Get in Touch</a>
					</div>
				</div>
				<div class="col-lg-6 col-md-12">
					<div class="about-img">
						<img class="img-about" src="<?= base_url('public/layout/'); ?>images/banners/bg-3.jpg" alt="">
					</div>
				</div>
			</div>
		</div>
	</div>

</div>

<?= $this->include('sitecommon/footer'); ?>