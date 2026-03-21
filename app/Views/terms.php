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
						<h2 class="item-title">Terms and Conditions</h2>
						<p class="pitem-description">
							1. General
							<ul>
							<li> The online payment system is provided for making donations, offerings, and contributions to St. Alphonsa Church, Valiyakolly.</li>
						    <li>By proceeding with a transaction, the user confirms that the information provided is accurate and complete.</li>
						</ul>
						</p>

						<p class="pitem-description">
							2. Nature of Payments
							<ul>
							<li>All payments made through this platform are considered voluntary donations to the church.</li>
						    <li>Donations are used for religious, charitable, and community activities as decided by the church administration.</li>
						</ul>
						</p>

						<p class="pitem-description">
							3. Payment Methods
							<ul>
							<li>Payments can be made using available options such as debit cards, credit cards, UPI, net banking, or other supported payment gateways.</li>
						    <li>The user is responsible for ensuring sufficient funds and valid payment details.</li>
						</ul>
						</p>

						<p class="pitem-description">
							4. No Refund Policy
							<ul>
							<li>Donations made are non-refundable, except in cases of duplicate or erroneous transactions.</li>
						    <li>For refund requests due to technical errors, users must contact the church within 7 days of the transaction with valid proof.</li>
						</ul>
						</p>


						<p class="pitem-description">
							5. Transaction Confirmation
							<ul>
							<li>Upon successful payment, a confirmation message or receipt will be provided via email/SMS or on-screen acknowledgment.</li>
						    <li>Users are advised to keep a copy of the transaction details for future reference.</li>
						</ul>
						</p>


						<p class="pitem-description">
							6. Failed Transactions
							<ul>
							<li>If a transaction fails but the amount is deducted, it will usually be reversed automatically by the bank/payment gateway within 5–7 working days.</li>
						    <li>If not reversed, users should contact their bank or the church support team.</li>
						</ul>
						</p>


						<p class="pitem-description">
							7. Security
							<ul>
							<li>The website uses secure payment gateways to protect user information.</li>
						    <li>The church does not store sensitive payment details such as card numbers or PINs.</li>
						</ul>
						</p>


						<p class="pitem-description">
							8. User Responsibility
							<ul>
							<li>The user agrees not to use the payment system for any unlawful or fraudulent activity.</li>
						    <li>The church is not responsible for issues arising due to incorrect information provided by the user.</li>
						</ul>
						</p>

						<p class="pitem-description">
							9. Modification of Terms
							<ul>
							<li>St. Alphonsa Church reserves the right to modify these terms and conditions at any time without prior notice.</li>
						    <li>Updated terms will be posted on the website.</li>
						</ul>
						</p>

						<p class="pitem-description">
							10. Contact Information
							<p>For any queries or support regarding payments, please contact:</p>
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