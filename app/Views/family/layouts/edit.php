<div class="page-content">
    <div class="container-fluid">

        <h4>Edit Family Details</h4>

        <form action="<?= site_url('family/update/' . $family['family_id']) ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>

            <div class="row">

                <!-- ================= FAMILY DETAILS ================= -->

                <div class="col-md-6">
                    <label>Family Name</label>
                    <input type="text" name="family_name" class="form-control" value="<?= esc($family['family_name']) ?>">
                </div>

                <div class="col-md-6">
                    <label>Head of Family</label>
                    <input type="text" name="head_of_family" class="form-control" value="<?= esc($family['head_of_family']) ?>">
                </div>

                <div class="col-md-6">
                    <label>Members Count</label>
                    <input type="number" name="members_count" class="form-control" value="<?= esc($family['members_count']) ?>">
                </div>

                <div class="col-md-6">
                    <label>Address</label>
                    <textarea name="address" class="form-control"><?= esc($family['address']) ?></textarea>
                </div>

                <div class="col-md-6">
                    <label>Ward</label>
                    <input type="text" name="ward" class="form-control" value="<?= esc($family['ward']) ?>">
                </div>

                <div class="col-md-6">
                    <label>Contact Number</label>
                    <input type="text" name="contact_number" class="form-control" value="<?= esc($family['contact_number']) ?>">
                </div>

                <div class="col-md-6">
                    <label>Email</label>
                    <input type="email" name="family_email" class="form-control" value="<?= esc($family['family_email']) ?>">
                </div>

                <div class="col-md-6">
                    <label>Password</label>
                    <input type="text" name="password" class="form-control" placeholder="Leave blank to keep old password">
                </div>

                <div class="col-md-6">
                    <label>Registered On</label>
                    <input type="date" name="registered_on" class="form-control" value="<?= esc($family['registered_on']) ?>">
                </div>

                <!-- ✅ PHOTO FIELD (FIXED) -->
                <div class="col-md-12">
                    <label>Photo</label>
                    <input type="file" name="photo" class="form-control">

                    <?php if (!empty($family['photo'])): ?>
                        <div class="mt-2">
                            <img src="<?= base_url('uploads/family/' . $family['photo']) ?>" width="120" style="border-radius:6px;">
                        </div>
                    <?php endif; ?>
                </div>

                <!-- ================= FAMILY MEMBERS ================= -->

                <div class="col-md-12 mt-4">
                    <h5>Family Members</h5>

                    <div id="members-wrapper">

                        <?php if (!empty($members)): ?>
                            <?php foreach ($members as $index => $member): ?>

                                <div class="member border p-3 mb-3">
                                    <div class="row g-3">

                                        <div class="col-md-3">
                                            <input type="text" name="members[<?= $index ?>][full_name]" class="form-control"
                                                value="<?= esc($member['full_name']) ?>" placeholder="Full Name">
                                        </div>

                                        <div class="col-md-3">
                                            <input type="text" name="members[<?= $index ?>][baptism_name]" class="form-control"
                                                value="<?= esc($member['baptism_name'] ?? '') ?>" placeholder="Baptism Name">
                                        </div>

                                        <div class="col-md-2">
                                            <select name="members[<?= $index ?>][relation_to_head]" class="form-control">
                                                <option value="">Relation</option>
                                                <?php
                                                $relations = ['Head of Family','Father','Mother','Son','Daughter','Brother','Sister'];
                                                foreach ($relations as $rel):
                                                ?>
                                                    <option value="<?= $rel ?>" <?= ($member['relation_to_head'] == $rel) ? 'selected' : '' ?>>
                                                        <?= $rel ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                        <div class="col-md-2">
                                            <input type="date" name="members[<?= $index ?>][date_of_birth]" class="form-control"
                                                value="<?= esc($member['date_of_birth'] ?? '') ?>">
                                        </div>

                                        <div class="col-md-2">
                                            <input type="date" name="members[<?= $index ?>][baptism_date]" class="form-control"
                                                value="<?= esc($member['baptism_date'] ?? '') ?>">
                                        </div>

                                        <div class="col-md-2">
                                            <input type="text" name="members[<?= $index ?>][gender]" class="form-control"
                                                value="<?= esc($member['gender'] ?? '') ?>" placeholder="Gender">
                                        </div>

                                        <div class="col-md-3">
                                            <textarea name="members[<?= $index ?>][job]" class="form-control" placeholder="Job"><?= esc($member['job'] ?? '') ?></textarea>
                                        </div>

                                        <div class="col-md-3">
                                            <input type="text" name="members[<?= $index ?>][education]" class="form-control"
                                                value="<?= esc($member['education'] ?? '') ?>" placeholder="Education">
                                        </div>

                                        <div class="col-md-3">
                                            <input type="text" name="members[<?= $index ?>][phonenumber]" class="form-control"
                                                value="<?= esc($member['phonenumber'] ?? '') ?>" placeholder="Phone">
                                        </div>

                                        <div class="col-md-3">
                                            <input type="text" name="members[<?= $index ?>][current_status]" class="form-control"
                                                value="<?= esc($member['current_status'] ?? '') ?>" placeholder="Status">
                                        </div>

                                        <div class="col-md-2">
                                            <input type="text" name="members[<?= $index ?>][feast]" class="form-control feast-input"
                                                value="<?= esc($member['feast'] ?? '') ?>" placeholder="MM-DD">
                                        </div>

                                        <div class="col-md-1 d-flex align-items-end">
                                            <button type="button" class="btn btn-danger btn-sm" onclick="removeMember(this)">✖</button>
                                        </div>

                                    </div>
                                </div>

                            <?php endforeach; ?>
                        <?php endif; ?>

                    </div>

                    <button type="button" class="btn btn-secondary mt-2" onclick="addMember()">+ Add Member</button>
                </div>

                <!-- ================= SUBMIT ================= -->

                <div class="col-md-12 mt-4 text-end">
                    <button type="submit" class="btn btn-primary">Update Family</button>
                </div>

            </div>
        </form>
    </div>
</div>

<!-- ================= JS ================= -->

<script>
let memberIndex = <?= !empty($members) ? count($members) : 0 ?>;

function addMember() {

    let html = `
    <div class="member border p-3 mb-3">
        <div class="row g-3">

            <div class="col-md-3">
                <input type="text" name="members[${memberIndex}][full_name]" class="form-control" placeholder="Full Name">
            </div>

            <div class="col-md-3">
                <input type="text" name="members[${memberIndex}][baptism_name]" class="form-control" placeholder="Baptism Name">
            </div>

            <div class="col-md-2">
                <select name="members[${memberIndex}][relation_to_head]" class="form-control">
                    <option>Head of Family</option>
                    <option>Father</option>
                    <option>Mother</option>
                    <option>Son</option>
                    <option>Daughter</option>
                </select>
            </div>

            <div class="col-md-2">
                <input type="date" name="members[${memberIndex}][date_of_birth]" class="form-control">
            </div>

            <div class="col-md-2">
                <input type="date" name="members[${memberIndex}][baptism_date]" class="form-control">
            </div>

            <div class="col-md-2">
                <input type="text" name="members[${memberIndex}][gender]" class="form-control" placeholder="Gender">
            </div>

            <div class="col-md-3">
                <textarea name="members[${memberIndex}][job]" class="form-control" placeholder="Job"></textarea>
            </div>

            <div class="col-md-3">
                <input type="text" name="members[${memberIndex}][education]" class="form-control" placeholder="Education">
            </div>

            <div class="col-md-3">
                <input type="text" name="members[${memberIndex}][phonenumber]" class="form-control" placeholder="Phone">
            </div>

            <div class="col-md-3">
                <input type="text" name="members[${memberIndex}][current_status]" class="form-control" placeholder="Status">
            </div>

            <div class="col-md-2">
                <input type="text" name="members[${memberIndex}][feast]" class="form-control feast-input" placeholder="MM-DD">
            </div>

            <div class="col-md-1 d-flex align-items-end">
                <button type="button" class="btn btn-danger btn-sm" onclick="removeMember(this)">✖</button>
            </div>

        </div>
    </div>
    `;

    document.getElementById('members-wrapper').insertAdjacentHTML('beforeend', html);
    memberIndex++;
}

function removeMember(btn){
    btn.closest('.member').remove();
}

/* FEAST FORMAT */
document.addEventListener('input', function(e){
    if(e.target.classList.contains('feast-input')){
        let v = e.target.value.replace(/\D/g,'');
        if(v.length>2){
            v = v.substring(0,2)+'-'+v.substring(2,4);
        }
        e.target.value = v.substring(0,5);
    }
});
</script>