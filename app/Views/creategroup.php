<?= $this->include('sitecommon/header'); ?>

<div class="wrapper">
	<div class="main-setting">
		<div class="container">
			<div class="row">
				<div class="col-xl-3 col-lg-4 col-md-12">
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
				<div class="col-xl-9 col-lg-8 col-md-12">
					<div class="event-card rrmt-30">
						<div class="headtte14m item-setting-top">
							<span class="color_bb"><i class="feather-edit"></i></span>
							<h4>Create Group</h4>
						</div>
						<?php if (session()->getFlashdata('success')): ?>
							<div class="alert alert-success">
								<?= session()->getFlashdata('success') ?>
							</div>
						<?php endif; ?>

						<?php if (session()->getFlashdata('error')): ?>
							<div class="alert alert-danger">
								<?= session()->getFlashdata('error') ?>
							</div>
						<?php endif; ?>
						<div class="item-setting">
							<div class="item-padding30 main-form">

								<form action="<?= base_url('addgroup'); ?>" method="post">
									<?= csrf_field() ?>

									<div class="row">

										<!-- Group Name -->
										<div class="col-lg-6 col-md-6">
											<div class="form_group mt-30">
												<label class="label25">
													Group Name <span class="text-danger">*</span>
												</label>
												<input
													class="form_input_1"
													type="text"
													name="group_name"
													id="group_name"
													placeholder="Enter group name"
													required>
											</div>
										</div>

										<!-- Add Members -->
										<div class="col-lg-6 col-md-6">
											<div class="form_group mt-30">
												<label class="label25">
													Add Members by Phone Numbers
												</label>
												<input
													class="form_input_1"
													type="text"
													name="group_members"
													id="group_members"
													placeholder="Enter comma separated phone numbers">
												<small class="text-muted">
													Example: 9876543210, 8765432109
												</small>
											</div>
										</div>

										<!-- Description -->
										<div class="col-lg-12">
											<div class="form_group mt-30">
												<label class="label25">Description</label>
												<textarea
													class="form_input_1"
													name="group_desc"
													id="group_desc"
													rows="3"
													placeholder="Optional description"></textarea>
											</div>
										</div>

									</div>

									<!-- Submit Button -->
									<div class="save-change-btns mt-4">
										<button type="submit" class="main-save-btn color btn-hover">
											Create Group
										</button>
									</div>

								</form>

							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?= $this->include('sitecommon/footer'); ?>