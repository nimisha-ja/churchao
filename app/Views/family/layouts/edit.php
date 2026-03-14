<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                    <h4 class="mb-sm-0">Edit Family Details</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">Family Management</a></li>
                            <li class="breadcrumb-item active">Edit Family</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xxl-6">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Edit Family Details</h4>
                    </div>

                    <div class="card-body">
                        <?php if (session()->getFlashdata('success')): ?>
                            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                        <?php endif; ?>
                        <?php if (session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                        <?php endif; ?>

                        <div class="live-preview">
                            <form action="<?= site_url('family/update/' . $family['family_id']) ?>" method="post" enctype="multipart/form-data">
                                <?= csrf_field() ?>

                                <div class="row">

                                    <!-- Family Code -->
                                    <!-- <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Family Code</label>
                                            <input type="text" name="family_code" class="form-control" value="<?= esc($family['family_code']) ?>" >
                                        </div>
                                    </div> -->

                                    <!-- Family Name -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Family Name</label>
                                            <input type="text" name="family_name" class="form-control" value="<?= esc($family['family_name']) ?>">
                                        </div>
                                    </div>

                                    <!-- Head of Family -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Head of Family</label>
                                            <input type="text" name="head_of_family" class="form-control" value="<?= esc($family['head_of_family']) ?>">
                                        </div>
                                    </div>

                                    <!-- Members Count -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Members Count</label>
                                            <input type="number" name="members_count" class="form-control" value="<?= esc($family['members_count']) ?>">
                                        </div>
                                    </div>

                                    <!-- Address -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Address</label>
                                            <textarea name="address" class="form-control" rows="2"><?= esc($family['address']) ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="head_of_family" class="form-label">Ward</label>
                                            <input type="text" name="ward" class="form-control" id="ward" value="<?= esc($family['ward']) ?>">
                                        </div>
                                    </div>
                                    <!-- Contact Number -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Contact Number</label>
                                            <input type="text" name="contact_number" class="form-control" value="<?= esc($family['contact_number']) ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="family_email" class="form-label">Family Email</label>
                                            <input type="email" name="family_email" class="form-control" id="family_email" value="<?= esc($family['family_email']) ?>">
                                            <!-- <small class="form-text text-muted">Email is read only type(login).</small>  -->
                                        </div>
                                    </div>

                                    <!-- Password -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="text" name="password" class="form-control" id="password" value="<?= esc($family['password']) ?>">
                                            <small class="form-text text-muted">Leave blank if you don't want to change the password.</small>
                                        </div>
                                    </div>
                                    <!-- Registered On -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Registered On</label>
                                            <input type="date" name="registered_on" class="form-control" value="<?= esc($family['registered_on']) ?>">
                                        </div>
                                    </div>

                                    <!-- Photo URL -->
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Photo URL</label>
                                            <input type="file" name="photo" class="form-control" value="<?= esc($family['photo']) ?>">

                                            <?php if (!empty($family['photo'])): ?>
                                                <img src="<?= base_url('uploads/family/' . $family['photo']) ?>" style="height:100px;width:100px">
                                            <?php endif; ?>

                                        </div>
                                    </div>

                                    <!-- Members -->
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Photo URL</label>
                                            <input type="file" name="photo" class="form-control" value="<?= esc($family['photo']) ?>">

                                            <?php if (!empty($family['photo'])): ?>
                                                <img src="<?= base_url('uploads/family/' . $family['photo']) ?>" style="height:100px;width:100px">
                                            <?php endif; ?>

                                        </div>
                                    </div>

                                    <!-- Members -->
                                    <div class="col-md-12">
                                        <h5 class="mt-4">Family Members</h5>

                                        <div id="members-wrapper">

                                            <?php if (!empty($members)) : ?>
                                                <?php foreach ($members as $index => $member): ?>

                                                    <div class="member row g-3 mb-3 align-items-end border rounded p-3">

                                                        <div class="col-md-2">
                                                            <input type="text" name="members[<?= $index ?>][full_name]" class="form-control"
                                                                value="<?= esc($member['full_name']) ?>" placeholder="Full Name">
                                                            <small class="text-muted">Name</small>
                                                        </div>

                                                        <div class="col-md-2">
                                                            <select name="members[<?= $index ?>][relation_to_head]" class="form-select">
                                                                <option value="">Relation</option>
                                                                <option value="Head of Family" <?= ($member['relation_to_head'] == 'Head of Family') ? 'selected' : '' ?>>Head of Family</option>
                                                                <option value="Father" <?= ($member['relation_to_head'] == 'Father') ? 'selected' : '' ?>>Father</option>
                                                                <option value="Mother" <?= ($member['relation_to_head'] == 'Mother') ? 'selected' : '' ?>>Mother</option>
                                                                <option value="Son" <?= ($member['relation_to_head'] == 'Son') ? 'selected' : '' ?>>Son</option>
                                                                <option value="Daughter" <?= ($member['relation_to_head'] == 'Daughter') ? 'selected' : '' ?>>Daughter</option>
                                                                <option value="Son-in-law" <?= ($member['relation_to_head'] == 'Son-in-law') ? 'selected' : '' ?>>Son-in-law</option>
                                                                <option value="Daughter-in-law" <?= ($member['relation_to_head'] == 'Daughter-in-law') ? 'selected' : '' ?>>Daughter-in-law</option>
                                                                <option value="Brother" <?= ($member['relation_to_head'] == 'Brother') ? 'selected' : '' ?>>Brother</option>
                                                                <option value="Sister" <?= ($member['relation_to_head'] == 'Sister') ? 'selected' : '' ?>>Sister</option>
                                                                <option value="Brother-in-law" <?= ($member['relation_to_head'] == 'Brother-in-law') ? 'selected' : '' ?>>Brother-in-law</option>
                                                                <option value="Sister-in-law" <?= ($member['relation_to_head'] == 'Sister-in-law') ? 'selected' : '' ?>>Sister-in-law</option>
                                                            </select>
                                                            <small class="text-muted">Relation</small>
                                                        </div>

                                                        <div class="col-md-2">
                                                            <input type="date" name="members[<?= $index ?>][date_of_birth]" class="form-control"
                                                                value="<?= esc($member['date_of_birth']) ?>">
                                                            <small class="text-muted">DOB</small>
                                                        </div>

                                                        <div class="col-md-2">
                                                            <input type="date"
                                                                name="members[<?= $index ?>][baptism_date]"
                                                                class="form-control"
                                                                value="<?= isset($member['baptism_date']) ? esc($member['baptism_date']) : '' ?>">
                                                            <small class="text-muted">Baptism</small>
                                                        </div>

                                                        <!-- FEAST FIELD (MM-DD) -->
                                                        <div class="col-md-2">
                                                            <input type="text"
                                                                name="members[<?= $index ?>][feast]"
                                                                class="form-control feast-input"
                                                                maxlength="5"
                                                                placeholder="MM-DD"
                                                                value="<?= isset($member['feast']) ? esc($member['feast']) : '' ?>">
                                                            <small class="text-muted">Feast (MM-DD)</small>
                                                        </div>

                                                        <div class="col-md-1">
                                                            <input type="text" name="members[<?= $index ?>][gender]" class="form-control"
                                                                value="<?= esc($member['gender']) ?>" placeholder="Gender">
                                                            <small class="text-muted">Gender</small>
                                                        </div>

                                                        <div class="col-md-2">
                                                            <textarea name="members[<?= $index ?>][job]" class="form-control" rows="2"
                                                                placeholder="Job Details"><?= esc($member['job']) ?></textarea>
                                                            <small class="text-muted">Job</small>
                                                        </div>

                                                        <div class="col-md-2">
                                                            <input type="text" name="members[<?= $index ?>][education]" class="form-control"
                                                                value="<?= esc($member['education']) ?>" placeholder="Education">
                                                            <small class="text-muted">Education</small>
                                                        </div>

                                                        <div class="col-md-2">
                                                            <input type="text" name="members[<?= $index ?>][phonenumber]" class="form-control"
                                                                value="<?= esc($member['phonenumber']) ?>" placeholder="Phone">
                                                            <small class="text-muted">Phone</small>
                                                        </div>

                                                        <div class="col-md-2">
                                                            <input type="text" name="members[<?= $index ?>][current_status]" class="form-control"
                                                                value="<?= esc($member['current_status']) ?>" placeholder="Status">
                                                            <small class="text-muted">Status</small>
                                                        </div>

                                                        <div class="col-md-1 d-flex align-items-end">
                                                            <button type="button" class="btn btn-danger btn-sm" onclick="removeMember(this)">✖</button>
                                                        </div>

                                                    </div>

                                                <?php endforeach; ?>
                                            <?php endif; ?>

                                        </div>

                                        <button type="button" class="btn btn-primary btn-sm mt-3" onclick="addMember()">+ Add Another Member</button>
                                    </div>

                                    <script>
                                        let memberIndex = <?= !empty($members) ? count($members) : 0 ?>;

                                        function addMember() {

                                            const wrapper = document.getElementById('members-wrapper');

                                            const div = document.createElement('div');
                                            div.classList.add('member', 'row', 'g-3', 'mb-3', 'align-items-end', 'border', 'rounded', 'p-3');

                                            div.innerHTML = `

<div class="col-md-2">
<input type="text" name="members[${memberIndex}][full_name]" class="form-control" placeholder="Full Name">
<small class="text-muted">Name</small>
</div>

<div class="col-md-2">
<select name="members[${memberIndex}][relation_to_head]" class="form-select">
<option>Relation</option>
<option>Head of Family</option>
<option>Father</option>
<option>Mother</option>
<option>Son</option>
<option>Daughter</option>
<option>Son-in-law</option>
<option>Daughter-in-law</option>
<option>Brother</option>
<option>Sister</option>
<option>Brother-in-law</option>
<option>Sister-in-law</option>
</select>
<small class="text-muted">Relation</small>
</div>

<div class="col-md-2">
<input type="date" name="members[${memberIndex}][date_of_birth]" class="form-control">
<small class="text-muted">DOB</small>
</div>

<div class="col-md-2">
<input type="date" name="members[${memberIndex}][baptism_date]" class="form-control">
<small class="text-muted">Baptism</small>
</div>

<div class="col-md-2">
<input type="text" name="members[${memberIndex}][feast]" class="form-control feast-input" placeholder="MM-DD" maxlength="5">
<small class="text-muted">Feast</small>
</div>

<div class="col-md-1">
<input type="text" name="members[${memberIndex}][gender]" class="form-control" placeholder="Gender">
<small class="text-muted">Gender</small>
</div>

<div class="col-md-2">
<textarea name="members[${memberIndex}][job]" class="form-control" rows="2" placeholder="Job Details"></textarea>
<small class="text-muted">Job</small>
</div>

<div class="col-md-2">
<input type="text" name="members[${memberIndex}][education]" class="form-control" placeholder="Education">
<small class="text-muted">Education</small>
</div>

<div class="col-md-2">
<input type="text" name="members[${memberIndex}][phonenumber]" class="form-control" placeholder="Phone">
<small class="text-muted">Phone</small>
</div>

<div class="col-md-2">
<input type="text" name="members[${memberIndex}][current_status]" class="form-control" placeholder="Status">
<small class="text-muted">Status</small>
</div>

<div class="col-md-1 d-flex align-items-end">
<button type="button" class="btn btn-danger btn-sm" onclick="removeMember(this)">✖</button>
</div>

`;

                                            wrapper.appendChild(div);
                                            memberIndex++;

                                        }

                                        function removeMember(button) {
                                            button.closest('.member').remove();
                                        }

                                        /* FEAST AUTO FORMAT */
                                        document.addEventListener('input', function(e) {

                                            if (e.target.classList.contains('feast-input')) {

                                                let val = e.target.value.replace(/\D/g, '');

                                                if (val.length > 2) {
                                                    val = val.slice(0, 2) + '-' + val.slice(2, 4);
                                                }

                                                e.target.value = val.slice(0, 5);

                                            }

                                        });
                                    </script>
                                    <!-- Submit -->
                                    <div class="col-lg-12 mt-4">
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-primary">Update Family</button>
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
</div>