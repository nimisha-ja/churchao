<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                    <h4 class="mb-sm-0">CRM</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                            <li class="breadcrumb-item active">CRM</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <div class="container py-4">
            <div class="row g-4">


                <!-- Family Details Card -->
                <?php if (!empty($family)) : ?>
                    <div class="col-lg-8">
                        <div class="card shadow-sm h-100">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Family Details</h4>

                                <div class="row mb-3">
                                    <div class="col-md-4 text-center">
                                        <?php if (!empty($family['photo']) && is_file(FCPATH . 'uploads/family/' . $family['photo'])): ?>
                                            <img src="<?= base_url('uploads/family/' . $family['photo']) ?>"
                                                alt="Family Photo"
                                                class="img-fluid rounded mb-2"
                                                style="height:150px; width:150px; object-fit:cover;">
                                        <?php else: ?>
                                            <div class="text-muted border rounded p-5">No photo uploaded</div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-8">
                                        <dl class="row mb-0">
                                            <dt class="col-sm-4">Family ID</dt>
                                            <dd class="col-sm-8"><?= esc($family['family_code']) ?></dd>

                                            <dt class="col-sm-4">Family Name</dt>
                                            <dd class="col-sm-8"><?= esc($family['family_name']) ?></dd>

                                            <dt class="col-sm-4">Head of Family</dt>
                                            <dd class="col-sm-8"><?= esc($family['head_of_family']) ?></dd>

                                            <dt class="col-sm-4">Members Count</dt>
                                            <dd class="col-sm-8"><?= esc($family['members_count']) ?></dd>

                                            <dt class="col-sm-4">Address</dt>
                                            <dd class="col-sm-8"><?= esc($family['address']) ?></dd>

                                            <dt class="col-sm-4">Contact Number</dt>
                                            <dd class="col-sm-8"><?= esc($family['contact_number']) ?></dd>

                                            <dt class="col-sm-4">Registered On</dt>
                                            <dd class="col-sm-8"><?= esc($family['registered_on']) ?></dd>
                                        </dl>
                                    </div>
                                </div>

                                <h5 class="mt-4">Members:</h5>
                                <ul class="list-group list-group-flush">
                                    <?php foreach ($members as $member): ?>
                                        <li class="list-group-item"><?= esc($member['full_name']) ?>-<?= esc($member['relation_to_head']) ?></li>

                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Total Donations Card -->
                    <div class="col-lg-4">
                        <div class="card text-white bg-success shadow-sm h-100">
                            <a href="<?= base_url('donations') ?>" class="text-decoration-none"><div class="card-body text-center">
                                <h5 class="card-title">Total Donations</h5>
                                <h2 class="display-4"><?= number_format($totalDonations, 2) ?></h2>
                            </div></a>
                        </div>
                    </div>


                <?php else: ?>
                    <?php if ($hasBirthdayToday): ?>
                        <div class="alert alert-info d-flex align-items-center justify-content-between">
                            <div>
                                🎉 <strong><?= $birthdayCount ?></strong> birthday(s) today!
                            </div>

                            <a href="javascript:void(0);"
                                id="sendBirthdayBtn"
                                class="btn btn-success">
                                🎂 Send Birthday Email
                            </a>

                            <div id="birthdayMsg" style="margin-top:10px;"></div>

                        </div>
                    <?php else: ?>
                        <div class="alert alert-secondary">
                            No birthdays today 🎈
                        </div>
                    <?php endif; ?>
                    <div class="col-12">
                        <div class="alert alert-info text-center shadow-sm">
                            <h4>Welcome to the Church Administration Panel</h4>
                            <p>May this tool help you steward the ministry with wisdom, clarity, and compassion.</p>
                        </div>

                        <!-- Total Donations for Admins -->
                        <a href="<?= base_url('donations') ?>" class="text-decoration-none">
                            <div class="card text-white bg-success shadow-sm mt-4">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Total Donations</h5>
                                    <h2 class="display-4"><?= number_format($totalDonations, 2) ?></h2>
                                </div>
                            </div>
                        </a>

                    </div>
                <?php endif; ?>

            </div>
        </div>




    </div>

</div>
</div>
<script>
    document.getElementById('sendBirthdayBtn').addEventListener('click', function() {
        if (!confirm('Send birthday emails now?')) return;

        var btn = this;
        btn.disabled = true; // prevent double clicks
        btn.innerText = 'Sending...';

        fetch("<?= site_url('send-email') ?>", {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.text())
            .then(data => {
                btn.innerText = '🎉 Email Sent';
                document.getElementById('birthdayMsg').innerHTML = data;
                btn.classList.remove('btn-success');
                btn.classList.add('btn-secondary');
            })
            .catch(err => {
                btn.disabled = false;
                btn.innerText = '🎂 Send Birthday Email';
                alert('Error sending emails. Check console.');
                console.error(err);
            });
    });
</script>