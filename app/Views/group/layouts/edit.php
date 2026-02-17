<div class="page-content">
    <div class="container-fluid">

        <!-- Page Title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                    <h4 class="mb-sm-0">Edit Group</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="<?= site_url('groups') ?>">Groups</a></li>
                            <li class="breadcrumb-item active">Edit Group</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card -->
        <div class="row">
            <div class="col-xxl-6">
                <div class="card">

                    <div class="card-header d-flex align-items-center">
                        <h4 class="card-title mb-0 flex-grow-1">Group Details</h4>
                    </div>

                    <div class="card-body">
                        <?php if (session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                        <?php endif; ?>

                        <form action="<?= site_url('groups/update/' . $group['group_id']) ?>" method="post">
                            <?= csrf_field() ?>

                            <div class="row">

                                <!-- Group Name -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Group Name</label>
                                        <input type="text" name="group_name" class="form-control" 
                                               value="<?= esc($group['group_name']) ?>" required>
                                    </div>
                                </div>

                                <!-- Description -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Description</label>
                                        <input type="text" name="description" class="form-control" 
                                               value="<?= esc($group['description']) ?>">
                                    </div>
                                </div>

                                <!-- Members -->
                                <div class="col-md-12 mt-3">
                                    <h5>Group Members</h5>
                                    <div class="border rounded p-3" style="max-height:300px; overflow-y:auto;">
                                        <?php foreach ($members as $member): ?>
                                            <div class="form-check">
                                                <input class="form-check-input"
                                                       type="checkbox"
                                                       name="member_ids[]"
                                                       value="<?= $member['member_id'] ?>"
                                                       id="member<?= $member['member_id'] ?>"
                                                       <?= in_array($member['member_id'], $currentMembers) ? 'checked' : '' ?>>

                                                <label class="form-check-label" for="member<?= $member['member_id'] ?>">
                                                    <?= esc($member['full_name']) ?>
                                                    <small class="text-muted">(<?= esc($member['family_name']) ?>)</small>
                                                </label>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>

                                <!-- Submit -->
                                <div class="col-lg-12 mt-4">
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary">Update Group</button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
