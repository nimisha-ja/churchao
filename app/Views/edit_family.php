<?= $this->include('sitecommon/header'); ?>

<div class="wrapper">
    <div class="main-setting">
        <div class="container">
            <div class="row">

                <!-- Sidebar Left -->
                <div class="col-xl-3 col-lg-4 col-md-12">
                    <!-- Total Families Card -->

                    <!-- Info Card -->

                </div>

                <!-- Form Right -->
                <div class="col-xl-9 col-lg-8 col-md-12">
                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                    <?php endif; ?>
                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                    <?php endif; ?>

                    <form action="<?= site_url('userfamily/update/' . $family['family_id']) ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field(); ?>

                        <div class="card mb-4">
                            <div class="card-header bg-light">
                                <h4 class="mb-0">Edit Family Details</h4>
                            </div>
                            <div class="card-body">

                                <div class="row">

                                    <!-- Family Info -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Family Name</label>
                                        <input type="text" name="family_name" class="form-control" value="<?= esc($family['family_name']) ?>" required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Head of Family</label>
                                        <input type="text" name="head_of_family" class="form-control" value="<?= esc($family['head_of_family']) ?>" required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Members Count</label>
                                        <input type="number" name="members_count" class="form-control" value="<?= esc($family['members_count']) ?>" required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Address</label>
                                        <textarea name="address" class="form-control" rows="2"><?= esc($family['address']) ?></textarea>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Ward</label>
                                        <input type="text" name="ward" class="form-control" value="<?= esc($family['ward']) ?>">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Contact Number</label>
                                        <input type="text" name="contact_number" class="form-control" value="<?= esc($family['contact_number']) ?>" required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Family Email</label>
                                        <input type="email" name="family_email" class="form-control" value="<?= esc($family['family_email']) ?>">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Password</label>
                                        <input type="text" name="password" class="form-control" value="<?= esc($family['password']) ?>">
                                        <small class="text-muted">Leave blank to keep current password</small>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Registered On</label>
                                        <input type="date" name="registered_on" class="form-control" value="<?= esc($family['registered_on']) ?>">
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Photo</label>
                                        <input type="file" name="photo" class="form-control">
                                        <?php if (!empty($family['photo'])): ?>
                                            <img src="<?= base_url('uploads/family/' . $family['photo']) ?>" style="height:100px;width:100px" class="mt-2">
                                        <?php endif; ?>
                                    </div>

                                    <!-- Family Members -->
                                    <div class="col-md-12">
                                        <h5 class="mt-4">Family Members</h5>

                                        <div id="members-wrapper">

                                            <?php if (!empty($members)): ?>
                                                <?php foreach ($members as $index => $member): ?>

                                                    <div class="member row g-3 mb-3 border rounded p-3 align-items-end">

                                                        <div class="col-md-2">
                                                            <input type="text" name="members[<?= $index ?>][full_name]" class="form-control" value="<?= esc($member['full_name']) ?>" placeholder="Full Name">
                                                        </div>

                                                        <div class="col-md-2">
                                                            <select name="members[<?= $index ?>][relation_to_head]" class="form-select">
                                                                <?php foreach (['Head of Family', 'Father', 'Mother', 'Son', 'Daughter', 'Son-in-law', 'Daughter-in-law', 'Brother', 'Sister', 'Brother-in-law', 'Sister-in-law'] as $rel): ?>
                                                                    <option value="<?= $rel ?>" <?= ($member['relation_to_head'] ?? '') == $rel ? 'selected' : '' ?>><?= $rel ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>

                                                        <div class="col-md-2">
                                                            <input type="date" name="members[<?= $index ?>][date_of_birth]" class="form-control" value="<?= esc($member['date_of_birth']) ?>">
                                                        </div>

                                                        <div class="col-md-2">
                                                            <input type="date" name="members[<?= $index ?>][baptism_date]" class="form-control" value="<?= !empty($member['baptism_date']) ? esc($member['baptism_date']) : '' ?>">
                                                        </div>

                                                        <!-- FEAST FIELD -->
                                                        <div class="col-md-2">
                                                            <input type="text"
                                                                name="members[<?= $index ?>][feast]"
                                                                class="form-control feast-input"
                                                                placeholder="MM-DD"
                                                                maxlength="5"
                                                                value="<?= !empty($member['feast']) ? esc($member['feast']) : '' ?>">
                                                        </div>

                                                        <div class="col-md-1">
                                                            <input type="text" name="members[<?= $index ?>][gender]" class="form-control" value="<?= esc($member['gender'] ?? '') ?>" placeholder="Gender">
                                                        </div>

                                                        <div class="col-md-2">
                                                            <textarea name="members[<?= $index ?>][job]" class="form-control" rows="2" placeholder="Job Details"><?= esc($member['job'] ?? '') ?></textarea>
                                                        </div>

                                                        <div class="col-md-2">
                                                            <input type="text" name="members[<?= $index ?>][education]" class="form-control" value="<?= esc($member['education'] ?? '') ?>" placeholder="Education">
                                                        </div>

                                                        <div class="col-md-2">
                                                            <input type="text" name="members[<?= $index ?>][phonenumber]" class="form-control" value="<?= esc($member['phonenumber'] ?? '') ?>" placeholder="Phone">
                                                        </div>

                                                        <div class="col-md-2">
                                                            <input type="text" name="members[<?= $index ?>][current_status]" class="form-control" value="<?= esc($member['current_status'] ?? '') ?>" placeholder="Status">
                                                        </div>

                                                        <div class="col-md-1 d-flex align-items-end">
                                                            <button type="button" class="btn btn-danger btn-sm" onclick="removeMember(this)">✖</button>
                                                        </div>

                                                    </div>

                                                <?php endforeach; ?>
                                            <?php endif; ?>

                                        </div>

                                        <button type="button" class="btn btn btn-sm mt-3" onclick="addMember()">+ Add Member</button>
                                    </div>


                                    <script>
                                        let memberIndex = <?= !empty($members) ? count($members) : 0 ?>;

                                        function addMember() {

                                            const wrapper = document.getElementById('members-wrapper');

                                            const div = document.createElement('div');
                                            div.classList.add('member', 'row', 'g-3', 'mb-3', 'border', 'rounded', 'p-3', 'align-items-end');

                                            div.innerHTML = `

<div class="col-md-2">
<input type="text" name="members[${memberIndex}][full_name]" class="form-control" placeholder="Full Name">
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
</div>

<div class="col-md-2">
<input type="date" name="members[${memberIndex}][date_of_birth]" class="form-control">
</div>

<div class="col-md-2">
<input type="date" name="members[${memberIndex}][baptism_date]" class="form-control">
</div>

<div class="col-md-2">
<input type="text" name="members[${memberIndex}][feast]" class="form-control feast-input" placeholder="MM-DD" maxlength="5">
</div>

<div class="col-md-1">
<input type="text" name="members[${memberIndex}][gender]" class="form-control" placeholder="Gender">
</div>

<div class="col-md-2">
<textarea name="members[${memberIndex}][job]" class="form-control" rows="2" placeholder="Job Details"></textarea>
</div>

<div class="col-md-2">
<input type="text" name="members[${memberIndex}][education]" class="form-control" placeholder="Education">
</div>

<div class="col-md-2">
<input type="text" name="members[${memberIndex}][phonenumber]" class="form-control" placeholder="Phone">
</div>

<div class="col-md-2">
<input type="text" name="members[${memberIndex}][current_status]" class="form-control" placeholder="Status">
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


                                        // AUTO FORMAT FEAST (MM-DD)
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
                                    <!-- Submit Button -->
                                    <div class="col-12 mt-4 text-center">
                                        <button type="submit" class="btn btn-success">Update Family</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>



<?= $this->include('sitecommon/footer'); ?>