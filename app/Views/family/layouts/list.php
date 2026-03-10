<style>

/* ===== TABLE RESPONSIVE ===== */

.gridjs-wrapper{
    width:100%;
    overflow-x:auto;
}

.gridjs-table{
    width:100%;
    border-collapse:collapse;
    min-width:900px; /* prevents squeezing on mobile */
}

.gridjs-table th,
.gridjs-table td{
    padding:10px 12px;
    border-bottom:1px solid #eee;
    vertical-align:middle;
    text-align:center;
}

.gridjs-th-content{
    font-weight:600;
}

/* Photo */
.gridjs-table img{
    border-radius:6px;
}

/* ===== PAGINATION ===== */

.gridjs-pagination .pagination{
    display:flex;
    justify-content:flex-end;
    list-style:none;
    padding:0;
    margin:1rem 0;
    flex-wrap:wrap;
    gap:6px;
}

.gridjs-pagination .pagination li{
    border:1px solid #ddd;
    border-radius:6px;
    background:#f8f9fa;
    font-size:14px;
}

.gridjs-pagination .pagination li a{
    display:block;
    padding:6px 12px;
    color:#405189;
    text-decoration:none;
    font-weight:500;
}

.gridjs-pagination .pagination li a:hover{
    background:#405189;
    color:#fff;
}

.gridjs-pagination .pagination li.active,
.gridjs-pagination .pagination li.active a{
    background:#405189;
    color:#fff !important;
    border-color:#405189;
}

.gridjs-pagination .pagination li.disabled a{
    color:#ccc;
    pointer-events:none;
    background:#e9ecef;
}

/* ===== MOBILE IMPROVEMENTS ===== */

@media (max-width:768px){

.page-title-box{
    flex-direction:column;
    align-items:flex-start;
    gap:8px;
}

/* smaller font */
.gridjs-table th,
.gridjs-table td{
    font-size:13px;
    padding:8px;
}

/* smaller image */
.gridjs-table img{
    width:34px !important;
    height:34px !important;
}

/* action icons */
.gridjs-td i{
    font-size:16px !important;
}

/* center pagination */
.gridjs-pagination .pagination{
    justify-content:center;
}

}

/* small phones */

@media (max-width:480px){

.gridjs-table th,
.gridjs-table td{
    font-size:12px;
    padding:7px;
}

}

</style>
<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                    <h4 class="mb-sm-0">Family</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Family</a></li>
                            <li class="breadcrumb-item active">Family Details</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0 flex-grow-1">Family List</h4>
                    </div>
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
                    <div class="card-body">
                        <form method="get" action="<?= current_url() ?>" class="row mb-3">
                            <div class="col-md-4">
                                <input
                                    type="text"
                                    name="phone"
                                    class="form-control"
                                    placeholder="Search by phone number"
                                    value="<?= esc($request->getGet('phone')) ?>">
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-primary">Search</button>
                                <!-- <a href="<?= current_url() ?>" class="btn btn-secondary">Reset</a> -->
                            </div>
                        </form>

                        <div id="table-gridjs">
                            <div role="complementary" class="gridjs gridjs-container" style="width: 100%;">
                                <div class="gridjs-head">
                                </div>
                                <div class="gridjs-wrapper">
                                    <table id="family-table" role="grid" class="gridjs-table" style="height: auto; text-align: center;">
                                        <thead class="gridjs-thead">
                                            <tr class="gridjs-tr">
                                                <th class="gridjs-th" style="width: 60px;">
                                                    <div class="gridjs-th-content">#</div>
                                                </th>
                                                <th class="gridjs-th">
                                                    <div class="gridjs-th-content">Family Code</div>
                                                </th>
                                                <th class="gridjs-th">
                                                    <div class="gridjs-th-content">Family Name</div>
                                                </th>
                                                <th class="gridjs-th">
                                                    <div class="gridjs-th-content">Head of Family</div>
                                                </th>
                                                <th class="gridjs-th">
                                                    <div class="gridjs-th-content">Members Count</div>
                                                </th>
                                                <th class="gridjs-th">
                                                    <div class="gridjs-th-content">Address</div>
                                                </th>
                                                <th class="gridjs-th">
                                                    <div class="gridjs-th-content">Contact</div>
                                                </th>
                                                <th class="gridjs-th">
                                                    <div class="gridjs-th-content">Registered On</div>
                                                </th>
                                                <th class="gridjs-th">
                                                    <div class="gridjs-th-content">Photo</div>
                                                </th>
                                          
                                                    <th class="gridjs-th">Action</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody class="gridjs-tbody">
                                            <?php $serial = 1; ?>
                                            <?php if (!empty($families) && is_array($families)): ?>
                                                <?php foreach ($families as $family): ?>
                                                    <tr class="gridjs-tr align-middle">
                                                        <td class="gridjs-td"><?= $serial++ ?></td>
                                                        <td class="gridjs-td"><?= esc($family['family_code']) ?></td>
                                                        <td class="gridjs-td"><?= esc($family['family_name']) ?></td>
                                                        <td class="gridjs-td"><?= esc($family['head_of_family']) ?></td>
                                                        <td class="gridjs-td"><?= esc($family['members_count']) ?></td>
                                                        <td class="gridjs-td"><?= esc($family['address']) ?></td>
                                                        <td class="gridjs-td"><?= esc($family['contact_number']) ?></td>
                                                        <td class="gridjs-td"><?= esc($family['registered_on']) ?></td>
                                                        <td class="gridjs-td">
                                                            <?php if (!empty($family['photo'])): ?>
                                                                <img src="<?= base_url('uploads/family/' . $family['photo']) ?>" style="height:40px;width:40px" alt="Photo">
                                                            <?php else: ?>
                                                                No Photo
                                                            <?php endif; ?>
                                                        </td>
                                                     
                                                            <td class="gridjs-td">
                                                                <div class="d-flex flex-wrap justify-content-start gap-2">
                                                                    <!-- Edit Link -->
                                                                    <a href="<?= site_url('family/edit/' . $family['family_id']) ?>" title="Edit">
                                                                        <i class="ri-file-edit-line" style="font-size: 18px;"></i>
                                                                    </a>

                                                                    <!-- Delete Form -->
                                                                    <form action="<?= site_url('family/delete/' . $family['family_id']) ?>" method="POST" onsubmit="return confirm('Delete this family?');">
                                                                        <?= csrf_field() ?>
                                                                        <button type="submit" style="border: none; background: none;" title="Delete">
                                                                            <i class="ri-delete-bin-6-line" style="font-size: 18px; color: red;"></i>
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </td>
                                                       

                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr class="gridjs-tr">
                                                    <td class="gridjs-td" colspan="10">No families found.</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="gridjs-pagination">
                                <?= $pager->links() ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>
</div>