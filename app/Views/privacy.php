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
						<div class="item-subtitle">St. Alphonsa Church, Valiyakolly</div>
						<h2 class="item-title">Privacy Policy</h2>

						<p>St. Alphonsa Church, Valiyakolly is committed to protecting the privacy and personal information of all visitors, donors, and users of our website. This Privacy Policy outlines how we collect, use, and safeguard your information.</p>
						<p class="pitem-description">
							1. Information We Collect
							<p>We may collect the following types of information when you use our website:</p>
							<ul>
							<li>Personal details such as name, phone number, email address</li>
						    <li>Payment-related details (processed securely via payment gateways)</li>
						    <li>Information provided during donations, registrations, or inquiries</li>
						    <li>Technical data such as IP address, browser type, and device information</li>
						</ul>
						</p>

						<p class="pitem-description">
							2. Use of Information
							<p>The information collected is used for:</p>
							<ul>
							<li>Processing donations and payments</li>
						    <li>Sending confirmations, receipts, and updates</li>
						    <li>Responding to inquiries or requests</li>
						    <li> Improving website functionality and user experience</li>
						    <li> Maintaining internal records of contributions</li>
						</ul>
						</p>

						<p class="pitem-description">
							3. Payment Security
							<ul>
							<li>All online payments are processed through secure and trusted payment gateways.</li>
						    <li>We do not store sensitive financial information such as card numbers, CVV, or PINs.</li>
						    <li>Transactions are protected using appropriate security measures.</li>
						</ul>
						</p>

						<p class="pitem-description">
							4. Data Protection
							<ul>
							<li>We take reasonable steps to protect your personal information from unauthorized access, misuse, or disclosure</li>
						    <li>Access to personal data is limited to authorized personnel only.</li>
						</ul>
						</p>


						<p class="pitem-description">
							5. Sharing of Information
							<ul>
							<li>We do not sell, trade, or rent personal information to third parties.</li>
						    <li>Information may be shared only when required:</li>
						    <li>To comply with legal obligations</li>
						    <li>With trusted service providers (e.g., payment processors) for transaction purposes</li>
						</ul>
						</p>


						<p class="pitem-description">
							6. Cookies and Tracking
							<ul>
							<li>Our website may use cookies to enhance user experience.</li>
						    <li>Cookies help us understand website usage and improve services.</li>
						    <li>Users can choose to disable cookies through their browser settings.</li>
						</ul>
						</p>


						<p class="pitem-description">
							7. User Rights
							<p>Users have the right to:</p>
							<ul>
							<li>Request access to their personal data</li>
						    <li>Request correction of incorrect information</li>
						    <li>Request deletion of their data, where applicable</li>
						</ul>
						</p>


						<p class="pitem-description">
							8. External Links
							<ul>
							<li>Our website may contain links to other websites.</li>
						    <li>We are not responsible for the privacy practices or content of external sites.</li>
						</ul>
						</p>

						<p class="pitem-description">
							9. Changes to This Policy
							<ul>
							<li>St. Alphonsa Church reserves the right to update this Privacy Policy at any time.</li>
						    <li>Changes will be posted on this page with the updated date.</li>
						</ul>
						</p>

						<p class="pitem-description">
							10. Contact Us
							<p>For any questions or concerns regarding this Privacy Policy, please contact:</p>
							<ul>
							<li>Church Office – St. Alphonsa Church, Valiyakolly</li>
						    <li>Phone: 9645425184</li>
						</ul>
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

</div>

<?= $this->include('sitecommon/footer'); ?>