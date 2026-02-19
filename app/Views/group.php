<?= $this->include('sitecommon/header'); ?>

<div class="wrapper pt-0">
	<div class="main-background-cover breadcrumb-pt">
		<div class="banner-user" style="background-image:url(<?= base_url('public/layout/'); ?>images/banners/bg-3.jpg);">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="banner-item-dts">
							<div class="banner-content">
								<div class="banner-media">
									<div class="item-profile-img">
										<img src="<?= base_url('public/layout/'); ?>images/left-imgs/img-3.jpg" alt="User-Avatar">
									</div>
									<div class="banner-media-body">
										<h3 class="item-user-title"><?php echo ucfirst(session()->get('user_name')); ?></h3>
										<div class="item-username"></div>
										<!-- <div class="profile-rating-section">
												<div class="profile-rating">
													<p>Rating :</p>
													<div class="profile-stars">
														<i class="feather-star"></i>
														<i class="feather-star"></i>
														<i class="feather-star"></i>
														<i class="feather-star"></i>
														<i class="feather-star color-gray-medium"></i>
													</div>
													<span>(39 ratings)</span>
												</div>
											</div> -->
										<ul class="user-meta-btns">
											<li class="mt-2">
												<a href="<?= base_url('donate'); ?>" class="profile-edit-btn btn-hover">
													<i class="feather-plus me-2"></i>Donate
												</a>
											</li>

											<li class="mt-2">
												<a href="<?= base_url('sitedashboard'); ?>" class="follow-btn">
													<i class="feather-user-plus me-2"></i>Dashboard
												</a>
											</li>

											<li class="mt-2">
												<a href="<?= base_url('updates'); ?>" class="pg-message-btn msgngup">
													Updates
												</a>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="custom-pl-tabs">
		<div class="container">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<?= $this->include('sitecommon/navbar'); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="dtpgusr12">
		<div class="container">
			<div class="row">
				<div class="col-xl-3 col-lg-4 col-md-12 order-lg-1 order-2">
					<div class="event-card rrmt-30">
						<div class="product_total_stats">
							<strong class="product_total_numberic">
								<span class="product_stats_icon"><i class="feather-shopping-cart"></i></span><?php echo $totalFamilies; ?>
							</strong>
							<span class="product_stats_label">Families</span>
						</div>
					</div>
					<div class="event-card mt-4">
						<div class="headtte14m">
							<span><i class="feather-info"></i></span>
							<h4>Info</h4>
						</div>
						<div class="evntdt99">

							<div class="mndtlist">
								<div class="mndesp145 s">
									<div class="evarticledes">
										<p class="mb-0">St. Alphonsa Syro-Malabar Church, Valiyakolly, is a Roman Catholic church located near Kodenchery in the Kozhikode district of Kerala. Established in 1995, it falls under the jurisdiction of the Diocese of Thamarassery.<br></p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-9 col-lg-8 col-md-12 order-lg-2 order-1">
					<div class="headtte14m box-shadow_main">
						<span><i class="feather-users"></i></span>
						<h4>Groups (5)</h4>--><a href="<?= base_url('creategroup'); ?>" class="">
							Create Group
						</a>
					</div>
					<div class="product-items-list pl_item_search mt-4">
						<div class="row">
							<div class="row">
								<?php if (!empty($groupsList) && is_array($groupsList)): ?>
									<?php foreach ($groupsList as $group): ?>
										<div class="col-xl-4 col-lg-6 col-md-6">
											<div class="ppuser-card mb-4">
												<div class="ppuser-img">
													<img class="ft-plus-square job-bg-circle bg-cyan me-0" src="<?= base_url('public/layout/images/group-imgs/img-5.jpg'); ?>" alt="">
												</div>
												<a href="#" class="job-heading text-center"><?= esc($group['group_name']); ?></a>
												<p class="notification-text font-small-4 text-center">
													<span class="oflst126"></span>
												</p>
												<!-- <a href="<?= base_url('login'); ?>" class="act-btn btn-hover">
													Join Group
												</a> -->
											</div>
										</div>
									<?php endforeach; ?>
								<?php else: ?>
									<p>No groups found.</p>
								<?php endif; ?>
							</div>


							<div class="col-md-12">
								<div class="loading-btn">
									<!-- <button class="process-btn btn-hover" type="button">
										No More Groups
									</button> -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?= $this->include('sitecommon/footer'); ?>