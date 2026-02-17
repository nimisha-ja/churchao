<div class="page-content">
    <div class="container-fluid">

        <!-- Page Title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                    <h4 class="mb-sm-0"><?= esc($group['group_name']) ?> Wall</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="<?= site_url('groups') ?>">Groups</a></li>
                            <li class="breadcrumb-item active">Wall</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Post Form Card -->
        <div class="row">
            <div class="col-lg-12">

                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Post Something</h5>
                    </div>
                    <div class="card-body">
                        <form action="<?= site_url('groups/post/' . $group['group_id']) ?>" method="post">
                            <?= csrf_field() ?>

                            <div class="mb-2">
                                <select name="member_id" class="form-select" required>
                                    <option value="">Select Member</option>
                                    <?php foreach ($groupMembers as $member): ?>
                                        <option value="<?= esc($member['member_id']) ?>">
                                            <?= esc($member['full_name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-2">
                                <textarea name="content" class="form-control" rows="3" placeholder="Write something..." required></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Post</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

        <!-- Posts List -->
        <div class="row">
            <div class="col-lg-12">

                <?php if (!empty($posts)): ?>
                    <?php foreach ($posts as $post): ?>

                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="flex-grow-1">
                                        <strong><?= esc($post['full_name']) ?></strong>
                                        <small class="text-muted"> </small>
                                    </div>
                                    <small class="text-muted"><?= date('d M Y, H:i', strtotime($post['created_on'])) ?></small>
                                </div>
                                <p class="mb-0"><?= esc($post['content']) ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="card">
                        <div class="card-body text-center text-muted">
                            <em>No posts yet. Be the first to post!</em>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

    </div>
</div>