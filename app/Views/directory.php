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
								<div class="mndesp145 ">
									<div class="evarticledes">
										<p class="mb-0">St. Alphonsa Syro-Malabar Church, Valiyakolly, is a Roman Catholic church located near Kodenchery in the Kozhikode district of Kerala. Established in 1995, it falls under the jurisdiction of the Diocese of Thamarassery.<br></p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-9 col-lg-8 col-md-12 order-lg-2 order-1">

					<div class="main-table rrmt-30">

						<!-- Search Form -->
						<div class="mb-3 d-flex justify-content-end">
							<form method="get" action="<?= current_url() ?>" class="d-flex">
								<input
									type="text"
									name="family_name"
									class="form-control me-2"
									placeholder="Search by family"
									value="<?= esc($request->getGet('family_name')) ?>">
								<button type="submit" class="btn btn-info">Search</button>
							</form>
						</div>

						<!-- Table -->
						<div class="table-responsive">
							<table class="table">
								<thead class="thead-dark">
									<tr>
										<th scope="col">Sl.No.</th>
										<th scope="col">Family Name</th>
										<th scope="col">Phone Number</th>
									</tr>
								</thead>
								<tbody>
									<?php if (!empty($families) && is_array($families)): ?>
										<?php $sl = 1; ?>
										<?php foreach ($families as $family): ?>
											<tr>
												<td><?= $sl++; ?></td>
												<td><?= esc($family['family_name']); ?></td>
												<td><?= esc($family['contact_number']); ?></td>
											</tr>
										<?php endforeach; ?>
									<?php else: ?>
										<tr>
											<td colspan="3">No families found.</td>
										</tr>
									<?php endif; ?>
								</tbody>
							</table>
						</div>

					</div>
				</div>

			</div>
		</div>
	</div>
</div>
<?= $this->include('sitecommon/footer'); ?>