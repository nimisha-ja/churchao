<?= $this->include('sitecommon/header'); ?>

<div class="col-xl-9 col-lg-8 col-md-12 order-lg-2 order-1">

	<!-- Create Group Form -->
	<div class="headtte14m box-shadow_main mb-4">
		<span><i class="feather-plus-square"></i></span>
		<h4>Create New Group</h4>
	</div> <?php if (session()->getFlashdata('success')): ?>
		<div class="alert alert-success">
			<?= session()->getFlashdata('success') ?>
		</div>
	<?php endif; ?>

	<?php if (session()->getFlashdata('error')): ?>
		<div class="alert alert-danger">
			<?= session()->getFlashdata('error') ?>
		</div>
	<?php endif; ?>

	<div class="product-items-list pl_item_search mt-3">
		<div class="row">
			<div class="col-md-12">
				<div class="card shadow-sm border-0">
					<div class="card-header bg-primary text-white">
						<h5 class="mb-0"><i class="feather-plus-square me-2"></i>Create New Group</h5>
					</div>
					<div class="card-body">
						<form action="<?= base_url('addgroup'); ?>" method="post">
							<?= csrf_field() ?>

							<div class="mb-3">
								<label for="group_name" class="form-label">Group Name <span class="text-danger">*</span></label>
								<input type="text" class="form-control" name="group_name" id="group_name" placeholder="Enter group name" required>
							</div>

							<div class="mb-3">
								<label for="group_desc" class="form-label">Description</label>
								<textarea class="form-control" name="group_desc" id="group_desc" rows="3" placeholder="Optional description"></textarea>
							</div>

							<div class="mb-3">
								<label for="group_members" class="form-label">Add Members by Phone Numbers</label>
								<input type="text" class="form-control" name="group_members" id="group_members" placeholder="Enter comma separated phone numbers">
								<div class="form-text">
									Separate numbers with commas. Example: 9876543210, 8765432109
								</div>
							</div>

							<div class="d-flex justify-content-end">
								<button type="submit" class="btn btn-success">
									<i class="feather-check-circle me-1"></i>Create Group
								</button>
							</div>

						</form>


					</div>
				</div>
			</div>
		</div>
	</div>




</div>