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
										<h3 class="item-user-title"></h3>
										<div class="item-username"></div>
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
				<main class="col col-xl-6 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
					<div class="main_content mt-0">
						<div class="tab-content" id="event-tabContent">
							<div class="tab-pane fade show active" id="nav-all" role="tabpanel" aria-labelledby="nav-all-tab">
								<div class="rcntacttle">
									<span>Recent Activity</span>
								</div>
								<div class="full-width mb-30">
									<div class="recent-items">

										<!-- Heading -->
										<div class="headtte14m mb-3">
											<span><i class="feather-calendar"></i></span>
											<h4 class="mb-0 d-inline-block"><?= date('F') ?> Birthdays 🎉</h4>
										</div>

										<div class="posts-list">
											<?php if (!empty($thisMonthBirthdays)): ?>

												<?php foreach ($thisMonthBirthdays as $member): ?>
													<div class="feed-shared-author-dt">
														<h5>
															🎂 <?= esc(ucwords($member['full_name'])) ?> <?= esc(ucwords($member['family_name'])) ?>
															<small class="text-muted">
																(<?= date('d M', strtotime($member['date_of_birth'])) ?>)
															</small>
														</h5>
													</div>

												<?php endforeach; ?>

											<?php else: ?>
												<div class="feed-shared-author-dt">
													<p class="mb-0">No birthdays this month 🎈.</p>
												</div><?php endif; ?>
										</div>

									</div>
								</div>

								<div class="full-width mb-30">
									<div class="recent-items">

										<!-- Heading -->
										<div class="headtte14m mb-3">
											<span><i class="feather-megaphone"></i></span>
											<h4 class="mb-0 d-inline-block">Announcements</h4>
										</div>

										<div class="posts-list">

											<?php if (!empty($announcements)): ?>

												<?php foreach ($announcements as $announcement): ?>
													<div class="feed-shared-author-dt">
														<h5><?= esc($announcement['title']) ?></h5>
													</div>

													<div class="post-meta">
														<div class="feed-shared-dt-1">
															<p><?= esc($announcement['content']) ?></p>
														</div>
													</div>
													<hr>
												<?php endforeach; ?>

											<?php else: ?>
												<p>No announcements available.</p>
											<?php endif; ?>

										</div>

									</div>
								</div>
							</div>
							<div class="tab-pane fade" id="nav-text" role="tabpanel" aria-labelledby="nav-text-tab">
								<div class="full-width mb-30 mt-30">
									<div class="recent-items">
										<div class="posts-list">
											<div class="feed-shared-author-dt">
												<div class="author-left">
													<a href="#"><img class="ft-plus-square job-bg-circle bg-cyan me-0" src="images/left-imgs/img-3.jpg" alt=""></a>
												</div>
												<div class="author-dts">
													<a href="#" class="job-heading">Rock William</a>
													<p class="notification-text font-small-4">
														<span class="time-dt">2 hour ago</span>
														<span class="job-loca"><i class="feather-navigation"></i><ins class="state-name">Ludhiana,</ins>India</span>
													</p>
												</div>
												<div class="ellipsis-options post-ellipsis-options dropdown dropdown-account">
													<a href="#" class="option-eps" role="button" data-bs-toggle="dropdown"><i class="fas fa-ellipsis-h"></i></a>
													<ul class="dropdown-menu dropdown-ellipsis dropdown-menu-end">
														<li class="media-list">
															<a href="#" class="item channel_item"><i class="feather-eye-off icon-mr1"></i>Hide this post</a>
															<a href="#" class="item channel_item"><i class="feather-bookmark icon-mr1"></i>Save</a>
															<a href="#" class="item channel_item"><i class="feather-link icon-mr1"></i>Copy Link</a>
															<a href="#" class="item channel_item"><i class="feather-edit icon-mr1"></i>Edit Post</a>
															<a href="#" class="item channel_item"><i class="feather-trash-2 icon-mr1"></i>Delete Post</a>
														</li>
													</ul>
												</div>
											</div>
										</div>


									</div>
								</div>
								<div class="loading-btn">
									<button class="process-btn btn-hover" type="button">
										No More Posts
									</button>
								</div>
							</div>

						</div>
					</div>
				</main>
				<aside class="col col-xl-3 order-xl-1 col-lg-6 order-lg-1 col-md-6 col-sm-12 col-12">
					<div class="event-card rrmt-30">
						<div class="product_total_stats">
							<strong class="product_total_numberic">
								<span class="product_stats_icon"><i class="feather-shopping-cart"></i></span><?php echo $totalFamilies; ?>
							</strong>
							<span class="product_stats_label"> Families</span>
						</div>
					</div>
					<div class="event-card mt-4">
						<div class="headtte14m">
							<span><i class="feather-info"></i></span>
							<h4>Info</h4>
						</div>
						<div class="evntdt99">

							<div class="mndtlist">
								<div class="mndesp145 ">
									<div class="evarticledes">
										<p class="mb-0">St. Alphonsa Syro-Malabar Church, Valiyakolly, is a Roman Catholic church located near Kodenchery in the Kozhikode district of Kerala. Established in 1995, it falls under the jurisdiction of the Diocese of Thamarassery.<br></p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- 	<div class="event-card mt-4">
							<div class="headtte14m">
								<span><i class="feather-archive"></i></span>
								<h4>Achivements</h4>
							</div>
							<div class="achivesment-dt99">
								<div class="user-info__badges">
									<ul class="badges">
										<li>
											<span class="community-badges__badge-wrapper--s community-badges__badge-wrapper--responsive-xs ">
												<img src="images/badges/master.svg" alt="Earned more than $64k" class="community-badges__badge--s" title="Earned more than $64k">
											</span>
										</li>
										<li>
											<span class="community-badges__badge-wrapper--s community-badges__badge-wrapper--responsive-xs ">
												<img src="images/badges/trending.svg" alt="Trending" class="community-badges__badge--s" title="Trending">
											</span>
										</li>
										<li>
											<span class="community-badges__badge-wrapper--s community-badges__badge-wrapper--responsive-xs ">
												<img src="images/badges/verified.svg" alt="Verified" class="community-badges__badge--s" title="Verified">
											</span>
										</li>
										<li>
											<span class="community-badges__badge-wrapper--s community-badges__badge-wrapper--responsive-xs ">
												<img src="images/badges/featured.svg" alt="Featured item" class="community-badges__badge--s" title="Featured item">
											</span>
										</li>
										<li>
											<span class="community-badges__badge-wrapper--s community-badges__badge-wrapper--responsive-xs ">
												<img src="images/badges/bundle_templates.svg" alt="Bundle Templates" class="community-badges__badge--s" title="Bundle Templates">
											</span>
										</li>
										<li>
											<span class="community-badges__badge-wrapper--s community-badges__badge-wrapper--responsive-xs ">
												<img src="images/badges/human_radio.svg" alt="Radioman" class="community-badges__badge--s" title="Radioman">
											</span>
										</li>
										<li>
											<span class="community-badges__badge-wrapper--s community-badges__badge-wrapper--responsive-xs ">
												<img src="images/badges/bundle_courses.svg" alt="Bundle Courses" class="community-badges__badge--s" title="Bundle Courses">
											</span>
										</li>
										<li>
											<span class="community-badges__badge-wrapper--s community-badges__badge-wrapper--responsive-xs ">
												<img src="images/badges/octopus.svg" alt="Octopus" class="community-badges__badge--s" title="Octopus">
											</span>
										</li>
										<li>
											<span class="community-badges__badge-wrapper--s community-badges__badge-wrapper--responsive-xs ">
												<img src="images/badges/tech_guru.svg" alt="Tech Guy" class="community-badges__badge--s" title="Tech Guy">
											</span>
										</li>
										<li>
											<span class="community-badges__badge-wrapper--s community-badges__badge-wrapper--responsive-xs ">
												<img src="images/badges/gift.svg" alt="Micko Gift" class="community-badges__badge--s" title="Micko Gift">
											</span>
										</li>
										<li>
											<span class="community-badges__badge-wrapper--s community-badges__badge-wrapper--responsive-xs ">
												<img src="images/badges/community_health.svg" alt="Community Health" class="community-badges__badge--s" title="Community Health">
											</span>
										</li>
										<li>
											<span class="community-badges__badge-wrapper--s community-badges__badge-wrapper--responsive-xs ">
												<img src="images/badges/likes.svg" alt="100+ Likes" class="community-badges__badge--s" title="100+ Likes">
											</span>
										</li>
										<li>
											<span class="community-badges__badge-wrapper--s community-badges__badge-wrapper--responsive-xs ">
												<img src="images/badges/followers.svg" alt="500+ Followers" class="community-badges__badge--s" title="500+ Followers">
											</span>
										</li>								
									</ul>
								</div>
							</div>
						</div>		 -->
				</aside>
				<aside class="col col-xl-3 order-xl-3 col-lg-6 order-lg-3 col-md-6 col-sm-12 col-12">
					<div class="event-card rrmt-30 lgmt-30">
						<div class="headtte14m">
							<span><i class="feather-users"></i></span>
							<a href="#">Groups</a>
							<div class="count-dt"><?= count($groupsList) ?></div>
						</div>

						<div class="panel-photos">
							<div class="row g-0">

								<?php if (!empty($groupsList) && is_array($groupsList)): ?>

									<?php foreach ($groupsList as $group): ?>
										<div class="col-lg-4 col-md-3 col-3">
											<div class="circled-user-box">
												<a href="<?= base_url('group'); ?>">
													<img src="<?= base_url('public/layout/images/group-imgs/img-5.jpg'); ?>">
													<div class="name-user">
														<?= esc($group['group_name']); ?>
													</div>
												</a>
											</div>
										</div>
									<?php endforeach; ?>

								<?php else: ?>
									<p>No groups found.</p>
								<?php endif; ?>

							</div>
						</div>
					</div>
					<!-- <div class="event-card mt-30">
							<div class="headtte14m">
								<span><i class="feather-flag"></i></span>
								<a href="my_profile_likes.html">Likes</a>
								<div class="count-dt">2</div>
							</div>
							<div class="panel-photos">
								<div class="row g-0">
									<div class="col-lg-4 col-md-3 col-3">
										<div class="circled-user-box">
											<a href="#">
												<img src="images/jobs-imgs/img-3.jpg" alt="">
												<div class="name-user">Themeforest</div>
											</a>
										</div>									
									</div>
									<div class="col-lg-4 col-md-3 col-3">
										<div class="circled-user-box">
											<a href="#">
												<img src="images/jobs-imgs/img-4.jpg" alt="">
												<div class="name-user">Codecanyon</div>
											</a>
										</div>									
									</div>	
								</div>
							</div>
						</div>
						<div class="event-card mt-30">
							<div class="headtte14m">
								<span><i class="feather-users"></i></span>
								<a href="my_profile_groups.html">Groups</a>
								<div class="count-dt">3</div>
							</div>
							<div class="panel-photos">
								<div class="row g-0">
									<div class="col-lg-4 col-md-3 col-3">
										<div class="circled-user-box">
											<a href="#">
												<img src="images/group-imgs/img-2.jpg" alt="">
												<div class="name-user">Php Developers</div>
											</a>
										</div>									
									</div>
									<div class="col-lg-4 col-md-3 col-3">
										<div class="circled-user-box">
											<a href="#">
												<img src="images/group-imgs/img-3.jpg" alt="">
												<div class="name-user">WordPress Developers</div>
											</a>
										</div>									
									</div>
									<div class="col-lg-4 col-md-3 col-3">
										<div class="circled-user-box">
											<a href="#">
												<img src="images/group-imgs/img-4.jpg" alt="">
												<div class="name-user">Laravel Developers</div>
											</a>
										</div>									
									</div>
								</div>
							</div>
						</div> -->
				</aside>
			</div>
		</div>
	</div>
</div>
<!-- Body End -->
<!-- Footer Start -->
<footer class="footer">
	<!-- <div class="container">
			<div class="row">
				<div class="col-md-3 col-6">
					<div class="footer-items">
						<ul class="footer-links">
							<li><a href="history.html">History</a></li>
							<li><a href="updates.html">Updates</a></li>
							<li><a href="bulletin.html">Parish Bulletin</a></li>
							<li><a href="contact.html">contact</a></li>
						</ul>
					</div>
				</div>
				<div class="col-md-3 col-6">
					<div class="footer-items">
						<ul class="footer-links">
							<li><a href="all_jobs.html">Job Portal</a></li>
							<li><a href="all_products.html">Digital Marketplace</a></li>
							<li><a href="all_learning.html">Learning Solutions</a></li>
							<li><a href="suggested_hashtags.html">Popular Hashtags</a></li>
							<li><a href="forums.html">Forums</a></li>
						</ul>
					</div>
				</div>
				<div class="col-md-3 col-6">
					<div class="footer-items">
						<ul class="footer-links">
							<li><a href="#">Open a Shop</a></li>
							<li><a href="#">Become an Instructor</a></li>
							<li><a href="#">Affiliate</a></li>
							<li><a href="#">Advertise</a></li>
							<li><a href="feedback.html">Feedback</a></li>
						</ul>
					</div>
				</div>
				<div class="col-md-3 col-6">
					<div class="footer-items">
						<a href="help_center.html" class="footer-btn">
							<div class="footer-btn-icon">
								<i class="feather-help-circle"></i>
							</div>
							<div class="footer-btn-text">
								<span>Help Center</span>
								<span>Visit our Help Center.</span>
							</div>
						</a>
						<a href="setting.html" class="footer-btn">
							<div class="footer-btn-icon">
								<i class="feather-settings"></i>
							</div>
							<div class="footer-btn-text">
								<span>Manage your account and privacy</span>
								<span>Go to your Settings.</span>
							</div>
						</a>
						<ul class="social-ft-links">
							<li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
							<li><a href="#"><i class="fab fa-twitter"></i></a></li>
							<li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
							<li><a href="#"><i class="fab fa-instagram"></i></a></li>
						</ul>
					</div>
				</div>				
			</div>
		</div> -->
	<div class="footer-bottom-items">
		<div class="container">
			<div class="col-md-12">
				<div class="footer-bottom-links">
					<div class="footer-logo">
						<a href="index.html">
							<p style="font-weight: 800;text-transform: uppercase;">St. Alphonsa Church Valiyakolly</p>
						</a>
					</div>
					<div class="micko-copyright">
						<p><i class="fas fa-copyright"></i>Copyright 2026, Developed by <a href="https://ephphathasoftech.com/" target="_blank">Ephphatha Softech</a>. All Right Reserved.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>
<!-- Footer End -->

<!-- Javascripts -->
<script src="<?= base_url('public/layout/'); ?>js/jquery-.min.js"></script>
<script src="<?= base_url('public/layout/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url('public/layout/'); ?>vendor/OwlCarousel/owl.carousel.js"></script>
<script src="<?= base_url('public/layout/'); ?>js/custom.js"></script>
<script src="<?= base_url('public/layout/'); ?>js/night-mode.js"></script>


</body>

</html>