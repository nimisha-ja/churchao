<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                    <h4 class="mb-sm-0">Add Family Details</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);"> Add Family Details</a></li>
                            <li class="breadcrumb-item active">Add Family Details</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xxl-6">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Add Family Details</h4>
                        <?php if (session()->getFlashdata('success')): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <?= session()->getFlashdata('success') ?>
                            </div>
                        <?php endif; ?>

                        <?php if (session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?= session()->getFlashdata('error') ?>
                            </div>
                        <?php endif; ?>

                    </div>
                    <div class="card-body">
                        <div class="live-preview">

                            <div class="card-body">
                                <div class="live-preview">
                                    <form action="<?= site_url('family/store') ?>" method="post" enctype="multipart/form-data">
                                        <?= csrf_field() ?>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="family_name" class="form-label">Family Name</label>
                                                    <input type="text" name="family_name" class="form-control" id="family_name">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="head_of_family" class="form-label">Head of Family</label>
                                                    <input type="text" name="head_of_family" class="form-control" id="head_of_family">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="members_count" class="form-label">Members Count</label>
                                                    <input type="number" name="members_count" class="form-control" id="members_count">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="address" class="form-label">Address</label>
                                                    <textarea name="address" class="form-control" id="address" rows="2"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="head_of_family" class="form-label">Ward</label>
                                                    <input type="text" name="ward" class="form-control" id="ward">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="contact_number" class="form-label">Contact Number</label>
                                                    <input type="text" name="contact_number" class="form-control" id="contact_number" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="family_email" class="form-label">Family Email</label>
                                                    <input type="email" name="family_email" class="form-control" id="family_email" value="<?= isset($family['family_email']) ? esc($family['family_email']) : '' ?>">
                                                </div>
                                            </div>
                                            <?php
                                            $generatedPassword = rand(1000, 9999); // ensures 4 digits // Generate random 4-digit code
                                            ?>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="password" class="form-label">Password</label>
                                                    <input
                                                        type="text"
                                                        name="password"
                                                        class="form-control"
                                                        id="password"
                                                        value="<?= isset($family) ? '' : $generatedPassword ?>"
                                                        <?= isset($family) ? '' : 'readonly' ?>>
                                                    <small class="form-text text-muted">
                                                        <?= isset($family)
                                                            ? 'Leave blank if you don\'t want to change the password.'
                                                            : 'Generated 4-digit password for new user (readonly).' ?>
                                                    </small>
                                                </div>
                                            </div>


                                            <!-- Registered On -->
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="registered_on" class="form-label">Registered On</label>
                                                    <input type="date" name="registered_on" class="form-control" id="registered_on">
                                                </div>
                                            </div>

                                            <!-- Photo URL -->
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="photo_url" class="form-label">Photo URL</label>
                                                    <input type="file" accept=".pdf,.jpg,.jpeg,.png" name="photo" class="form-control" id="photo">
                                                </div>
                                            </div>

                                            <!-- Family Members Section -->
                                            <!-- Family Members Section -->
                                            <div class="col-md-12">
                                                <h5 class="mt-4">Family Members</h5>

                                                <div id="members-wrapper">

                                                    <!-- FIRST MEMBER -->
                                                    <div class="member border rounded p-3 mb-3">

                                                        <div class="row g-3">

                                                            <div class="col-md-4">
                                                                <label class="form-label">Full Name</label>
                                                                <input type="text" name="members[0][full_name]" class="form-control">
                                                            </div>

                                                            <div class="col-md-2">
                                                                <label class="form-label">Relation</label>
                                                                <select name="members[0][relation_to_head]" class="form-select">
                                                                    <option value="">Select</option>
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
                                                                <label class="form-label">DOB</label>
                                                                <input type="date" name="members[0][date_of_birth]" class="form-control">
                                                            </div>

                                                            <div class="col-md-2">
                                                                <label class="form-label">Baptism</label>
                                                                <input type="date" name="members[0][baptism_date]" class="form-control">
                                                            </div>

                                                            <div class="col-md-2">
                                                                <label class="form-label">Gender</label>
                                                                <input type="text" name="members[0][gender]" class="form-control">
                                                            </div>

                                                            <div class="col-md-3">
                                                                <label class="form-label">Job Details</label>
                                                                <textarea name="members[0][job]" class="form-control" rows="2" placeholder="Enter job details"></textarea>
                                                            </div>

                                                            <div class="col-md-3">
                                                                <label class="form-label">Education</label>
                                                                <input type="text" name="members[0][education]" class="form-control">
                                                            </div>

                                                            <div class="col-md-3">
                                                                <label class="form-label">Phone</label>
                                                                <input type="text" name="members[0][phone]" class="form-control">
                                                            </div>

                                                            <div class="col-md-3">
                                                                <label class="form-label">Status</label>
                                                                <input type="text" name="members[0][current_status]" class="form-control">
                                                            </div>

                                                            <div class="col-md-3">
                                                                <label class="form-label">Feast (MM-DD)</label>
                                                                <input type="date" name="members[0][feast]" class="form-control">
                                                            </div>

                                                            <div class="col-md-2 d-flex align-items-end">
                                                                <button type="button" class="btn btn-danger btn-sm" onclick="removeMember(this)">Remove</button>
                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                                <button type="button" class="btn btn-outline-secondary btn-sm mt-3" onclick="addMember()">+ Add Another Member</button>
                                            </div>

                                            <script>
                                                let memberIndex = 1;

                                                function addMember() {
                                                    const wrapper = document.getElementById('members-wrapper');
                                                    const div = document.createElement('div');
                                                    div.classList.add('member', 'border', 'rounded', 'p-3', 'mb-3');

                                                    div.innerHTML = `
    <div class="row g-3">

        <div class="col-md-4">
            <label class="form-label">Full Name</label>
            <input type="text" name="members[${memberIndex}][full_name]" class="form-control">
        </div>

        <div class="col-md-2">
            <label class="form-label">Relation</label>
            <select name="members[${memberIndex}][relation_to_head]" class="form-select">
                <option value="">Select</option>
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
            <label class="form-label">DOB</label>
            <input type="date" name="members[${memberIndex}][date_of_birth]" class="form-control">
        </div>

        <div class="col-md-2">
            <label class="form-label">Baptism</label>
            <input type="date" name="members[${memberIndex}][baptism_date]" class="form-control">
        </div>

        <div class="col-md-2">
            <label class="form-label">Gender</label>
            <input type="text" name="members[${memberIndex}][gender]" class="form-control">
        </div>

        <div class="col-md-3">
            <label class="form-label">Job Details</label>
            <textarea name="members[${memberIndex}][job]" class="form-control" rows="2" placeholder="Enter job details"></textarea>
        </div>

        <div class="col-md-3">
            <label class="form-label">Education</label>
            <input type="text" name="members[${memberIndex}][education]" class="form-control">
        </div>

        <div class="col-md-3">
            <label class="form-label">Phone</label>
            <input type="text" name="members[${memberIndex}][phone]" class="form-control">
        </div>

        <div class="col-md-3">
            <label class="form-label">Status</label>
            <input type="text" name="members[${memberIndex}][current_status]" class="form-control">
        </div>

        <div class="col-md-3">
            <label class="form-label">Feast (MM-DD)</label>
            <input type="text" name="members[${memberIndex}][feast]" class="form-control feast-input" placeholder="MM-DD" maxlength="5">
        </div>

        <div class="col-md-2 d-flex align-items-end">
            <button type="button" class="btn btn-danger btn-sm" onclick="removeMember(this)">Remove</button>
        </div>

    </div>
    `;

                                                    wrapper.appendChild(div);
                                                    memberIndex++;
                                                }

                                                // Remove member
                                                function removeMember(btn) {
                                                    btn.closest('.member').remove();
                                                }

                                                // Optional: auto-format Feast input as MM-DD
                                                document.addEventListener('input', function(e) {
                                                    if (e.target.classList.contains('feast-input')) {
                                                        let val = e.target.value.replace(/\D/g, ''); // digits only
                                                        if (val.length >= 2) val = val.slice(0, 2) + '-' + val.slice(2, 4);
                                                        e.target.value = val.slice(0, 5);
                                                    }
                                                });
                                            </script>
                                        </div>


                                        <script>
                                            function addMember() {

                                                const wrapper = document.getElementById('members-wrapper');

                                                const div = document.createElement('div');
                                                div.classList.add('member', 'row', 'g-3', 'mt-2', 'align-items-end');

                                                div.innerHTML = `

        <div class="col-md-3">
            <input type="text" name="members[${memberIndex}][full_name]" class="form-control" placeholder="Full Name">
        </div>

        <div class="col-md-2">
            <select name="members[${memberIndex}][relation_to_head]" class="form-select">
                <option value="">Select Relation</option>
                <option value="Head of Family">Head of Family</option>
                <option value="Father">Father</option>
                <option value="Mother">Mother</option>
                <option value="Son">Son</option>
                <option value="Daughter">Daughter</option>
                <option value="Son-in-law">Son-in-law</option>
                <option value="Daughter-in-law">Daughter-in-law</option>
                <option value="Brother">Brother</option>
                <option value="Sister">Sister</option>
                <option value="Brother-in-law">Brother-in-law</option>
                <option value="Sister-in-law">Sister-in-law</option>
            </select>
        </div>

        <div class="col-md-2">
            <input type="date" name="members[${memberIndex}][date_of_birth]" class="form-control">
        </div>

        <div class="col-md-2">
            <input type="date" name="members[${memberIndex}][baptism_date]" class="form-control">
        </div>

        <div class="col-md-2">
            <input type="date" name="members[${memberIndex}][feast_date]" class="form-control feast-date">
        </div>

        <div class="col-md-1">
            <input type="text" name="members[${memberIndex}][gender]" class="form-control" placeholder="Gender">
        </div>

        <div class="col-md-2">
            <input type="text" name="members[${memberIndex}][job]" class="form-control" placeholder="Job">
        </div>

        <div class="col-md-2">
            <input type="text" name="members[${memberIndex}][education]" class="form-control" placeholder="Education">
        </div>

        <div class="col-md-2">
            <input type="text" name="members[${memberIndex}][phone]" class="form-control" placeholder="Phone">
        </div>

        <div class="col-md-2">
            <input type="text" name="members[${memberIndex}][current_status]" class="form-control" placeholder="Status">
        </div>

        <div class="col-md-1">
            <button type="button" class="btn btn-danger btn-sm" onclick="removeMember(this)">✖</button>
        </div>
    `;

                                                wrapper.appendChild(div);
                                                memberIndex++;
                                            }

                                            function removeMember(button) {
                                                const memberRow = button.closest('.member');
                                                memberRow.remove();
                                            }
                                        </script>
                                        <!-- Submit Button -->
                                        <div class="col-lg-12 mt-4">
                                            <div class="text-end">
                                                <button type="submit" class="btn btn-primary">Save Family</button>
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
</div>
</div>