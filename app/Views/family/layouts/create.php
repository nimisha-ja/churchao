<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                    <h4 class="mb-sm-0">Add Family Details</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xxl-6">
                <div class="card">

                    <div class="card-header">
                        <h4 class="card-title">Add Family Details</h4>

                        <?php if (session()->getFlashdata('success')): ?>
                            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                        <?php endif; ?>

                        <?php if (session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="card-body">

                        <form action="<?= site_url('family/store') ?>" method="post" enctype="multipart/form-data">
                            <?= csrf_field() ?>

                            <div class="row">

                                <div class="col-md-6">
                                    <label>Family Name</label>
                                    <input type="text" name="family_name" class="form-control">
                                </div>

                                <div class="col-md-6">
                                    <label>Head of Family</label>
                                    <input type="text" name="head_of_family" class="form-control">
                                </div>

                                <div class="col-md-6">
                                    <label>Members Count</label>
                                    <input type="number" name="members_count" class="form-control">
                                </div>

                                <div class="col-md-6">
                                    <label>Address</label>
                                    <textarea name="address" class="form-control"></textarea>
                                </div>

                                <div class="col-md-6">
                                    <label>Ward</label>
                                    <input type="text" name="ward" class="form-control">
                                </div>

                                <div class="col-md-6">
                                    <label>Contact Number</label>
                                    <input type="text" name="contact_number" class="form-control" required>
                                </div>

                                <div class="col-md-6">
                                    <label>Email</label>
                                    <input type="email" name="family_email" class="form-control">
                                </div>

                                <?php $generatedPassword = rand(1000,9999); ?>

                                <div class="col-md-6">
                                    <label>Password</label>
                                    <input type="text" name="password" class="form-control" value="<?= $generatedPassword ?>" readonly>
                                </div>

                                <div class="col-md-6">
                                    <label>Registered On</label>
                                    <input type="date" name="registered_on" class="form-control">
                                </div>

                                <div class="col-md-12">
                                    <label>Photo</label>
                                    <input type="file" name="photo" class="form-control">
                                </div>

                                <!-- ================= FAMILY MEMBERS ================= -->

                                <div class="col-md-12">
                                    <h5 class="mt-4">Family Members</h5>

                                    <div id="members-wrapper">

                                        <!-- FIRST MEMBER -->
                                        <div class="member border p-3 mb-3">
                                            <div class="row g-3">

                                                <div class="col-md-3">
                                                    <label>Full Name</label>
                                                    <input type="text" name="members[0][full_name]" class="form-control">
                                                </div>

                                                <div class="col-md-3">
                                                    <label>Baptism Name</label>
                                                    <input type="text" name="members[0][baptism_name]" class="form-control">
                                                </div>

                                                <div class="col-md-2">
                                                    <label>Relation</label>
                                                    <select name="members[0][relation_to_head]" class="form-control">
                                                        <option>Head of Family</option>
                                                        <option>Father</option>
                                                        <option>Mother</option>
                                                        <option>Son</option>
                                                        <option>Daughter</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-2">
                                                    <label>DOB</label>
                                                    <input type="date" name="members[0][date_of_birth]" class="form-control">
                                                </div>

                                                <div class="col-md-2">
                                                    <label>Baptism Date</label>
                                                    <input type="date" name="members[0][baptism_date]" class="form-control">
                                                </div>

                                                <div class="col-md-2">
                                                    <label>Gender</label>
                                                    <input type="text" name="members[0][gender]" class="form-control">
                                                </div>

                                                <div class="col-md-3">
                                                    <label>Job</label>
                                                    <textarea name="members[0][job]" class="form-control"></textarea>
                                                </div>

                                                <div class="col-md-3">
                                                    <label>Education</label>
                                                    <input type="text" name="members[0][education]" class="form-control">
                                                </div>

                                                <div class="col-md-3">
                                                    <label>Phone</label>
                                                    <input type="text" name="members[0][phone]" class="form-control">
                                                </div>

                                                <div class="col-md-3">
                                                    <label>Status</label>
                                                    <input type="text" name="members[0][current_status]" class="form-control">
                                                </div>

                                                <div class="col-md-3">
                                                    <label>Feast</label>
                                                    <input type="text" name="members[0][feast]" class="form-control feast-input" placeholder="MM-DD">
                                                </div>

                                                <div class="col-md-2 d-flex align-items-end">
                                                    <button type="button" class="btn btn-danger btn-sm" onclick="removeMember(this)">Remove</button>
                                                </div>

                                            </div>
                                        </div>

                                    </div>

                                    <button type="button" class="btn btn-secondary mt-2" onclick="addMember()">+ Add Member</button>
                                </div>

                                <!-- SUBMIT -->
                                <div class="col-md-12 mt-4 text-end">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>

                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ================= JAVASCRIPT ================= -->

<script>
let memberIndex = 1;

function addMember() {

    let html = `
    <div class="member border p-3 mb-3">
        <div class="row g-3">

            <div class="col-md-3">
                <label>Full Name</label>
                <input type="text" name="members[${memberIndex}][full_name]" class="form-control">
            </div>

            <div class="col-md-3">
                <label>Baptism Name</label>
                <input type="text" name="members[${memberIndex}][baptism_name]" class="form-control">
            </div>

            <div class="col-md-2">
                <label>Relation</label>
                <select name="members[${memberIndex}][relation_to_head]" class="form-control">
                    <option>Head of Family</option>
                    <option>Father</option>
                    <option>Mother</option>
                    <option>Son</option>
                    <option>Daughter</option>
                </select>
            </div>

            <div class="col-md-2">
                <label>DOB</label>
                <input type="date" name="members[${memberIndex}][date_of_birth]" class="form-control">
            </div>

            <div class="col-md-2">
                <label>Baptism Date</label>
                <input type="date" name="members[${memberIndex}][baptism_date]" class="form-control">
            </div>

            <div class="col-md-2">
                <label>Gender</label>
                <input type="text" name="members[${memberIndex}][gender]" class="form-control">
            </div>

            <div class="col-md-3">
                <label>Job</label>
                <textarea name="members[${memberIndex}][job]" class="form-control"></textarea>
            </div>

            <div class="col-md-3">
                <label>Education</label>
                <input type="text" name="members[${memberIndex}][education]" class="form-control">
            </div>

            <div class="col-md-3">
                <label>Phone</label>
                <input type="text" name="members[${memberIndex}][phone]" class="form-control">
            </div>

            <div class="col-md-3">
                <label>Status</label>
                <input type="text" name="members[${memberIndex}][current_status]" class="form-control">
            </div>

            <div class="col-md-3">
                <label>Feast</label>
                <input type="text" name="members[${memberIndex}][feast]" class="form-control feast-input" placeholder="MM-DD">
            </div>

            <div class="col-md-2 d-flex align-items-end">
                <button type="button" class="btn btn-danger btn-sm" onclick="removeMember(this)">Remove</button>
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