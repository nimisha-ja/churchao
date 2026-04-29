<style>
    /* General Styling for Pagination */
    .gridjs-pagination .pagination {
        display: flex;
        justify-content: flex-end;
        list-style: none;
        padding: 0;
        margin: 1rem 0;
        flex-wrap: wrap;
        gap: 6px;
    }

    .gridjs-pagination .pagination li {
        border: 1px solid #ddd;
        border-radius: 6px;
        background-color: #f8f9fa;
        font-size: 14px;
        transition: all 0.2s ease-in-out;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    }

    .gridjs-pagination .pagination li a {
        display: block;
        padding: 6px 12px;
        color: #405189;
        text-decoration: none;
        font-weight: 500;
        border-radius: 6px;
    }

    .gridjs-pagination .pagination li a:hover {
        background-color: #405189;
        color: #fff;
        text-decoration: none;
        transition: background-color 0.2s ease;
    }

    .gridjs-pagination .pagination li.active,
    .gridjs-pagination .pagination li.active a {
        background-color: #405189;
        color: white !important;
        border-color: #405189;
        font-weight: 600;
    }

    .gridjs-pagination .pagination li.disabled a {
        color: #ccc;
        pointer-events: none;
        background-color: #e9ecef;
        border-color: #dee2e6;
    }

    .gridjs-pagination .pagination li a:focus {
        outline: none;
        box-shadow: 0 0 0 2px rgba(64, 81, 137, 0.3);
    }

    .gridjs-pagination .pagination li:hover:not(.active):not(.disabled) {
        background-color: #e2e6ea;
        border-color: #ccc;
    }
</style>
<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                    <h4 class="mb-sm-0">Reminder Report</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Donations</a></li>
                            <li class="breadcrumb-item active">Reminder Report</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0 flex-grow-1"> </h4>
                        <h3 class="mb-4">📋 Monthly Reminder Report</h3>

                        <!-- 🔍 Filter Form -->
                        <form method="get" class="row mb-4">
                            <div class="col-md-2">
                                <!-- <input type="number" name="month" class="form-control"
                                    placeholder="Month (1-12)"
                                    value=" //esc($_GET['month'] ?? date('m')) //"> -->
                                <select name="month" class="form-control">
                                    <?php
                                    $selectedMonth = $_GET['month'] ?? date('m');
                                    for ($m = 1; $m <= 12; $m++):
                                        $value = str_pad($m, 2, '0', STR_PAD_LEFT);
                                    ?>
                                        <option value="<?= $value ?>" <?= ($selectedMonth == $value) ? 'selected' : '' ?>>
                                            <?= date('F', mktime(0, 0, 0, $m, 1)) ?>
                                        </option>
                                    <?php endfor; ?>
                                </select>
                            </div>

                            <div class="col-md-2">
                                <input type="number" name="year" class="form-control"
                                    placeholder="Year"
                                    value="<?= esc($_GET['year'] ?? date('Y')) ?>">
                            </div>

                            <div class="col-md-2">
                                <button class="btn btn-primary">Filter</button>
                            </div>

                            <div class="col-md-2">
                                <!-- <button type="button" onclick="window.print()" class="btn btn-secondary">
                                    🖨 Print
                                </button> -->
                            </div>
                        </form>

                        <!-- <form method="get" action="<?= site_url('donations') ?>" class="row mb-3">

                            <div class="col-md-3">
                                <label>From Date</label>
                                <input type="date" name="from_date" class="form-control"
                                    value="<?= esc($_GET['from_date'] ?? '') ?>">
                            </div>

                            <div class="col-md-3">
                                <label>To Date</label>
                                <input type="date" name="to_date" class="form-control"
                                    value="<?= esc($_GET['to_date'] ?? '') ?>">
                            </div>

                            <div class="col-md-3 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary">Search</button>
                                <a href="<?= site_url('donations') ?>" class="btn btn-secondary ms-2">Reset</a>
                            </div>

                        </form> -->
                        <!-- <a href="<?= site_url('donations/downloadPDF') ?>" class="btn btn-success">
                            Download PDF
                        </a> -->
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
                        <div id="table-gridjs">
                            <div role="complementary" class="gridjs gridjs-container" style="width: 100%;">
                                <div class="gridjs-head">
                                    <!-- <div class="gridjs-search">
                                        <input type="search" id="search-bar" placeholder="Search users..." aria-label="Type a keyword..." class="gridjs-input gridjs-search-input">
                                    </div> -->
                                </div>
                                <div class="gridjs-wrapper" style="height: auto;">

                                    <table class="gridjs-table" style="width: 100%; text-align: center;">

                                        <thead class="gridjs-thead">
                                            <tr class="gridjs-tr">
                                                <th class="gridjs-th">#</th>
                                                <th class="gridjs-th">Family Name</th>
                                                <th class="gridjs-th">Head of Family</th>
                                                <th class="gridjs-th">Expected Amount</th>
                                                <th class="gridjs-th">Paid This Month</th>
                                                <th class="gridjs-th">Pending</th>
                                                <th class="gridjs-th">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody class="gridjs-tbody">
                                            <?php if (!empty($report)): ?>
                                                <?php $i = 1;
                                                foreach ($report as $row): ?>
                                                    <tr class="gridjs-tr">
                                                        <td class="gridjs-td"><?= $i++ ?></td>
                                                        <td class="gridjs-td"><?= esc($row['family_name']) ?></td>
                                                        <td class="gridjs-td"><?= esc($row['head_of_family']) ?></td>
                                                        <td class="gridjs-td">₹<?= number_format($row['expected_amount']) ?></td>
                                                        <td class="gridjs-td">₹<?= number_format($row['paid_amount']) ?></td>
                                                        <td class="pending gridjs-td">
                                                            ₹<?= number_format($row['pending_amount']) ?>
                                                        </td>
                                                        <td class="gridjs-td">
                                                            <?php if ($row['status'] == 'Paid'): ?>
                                                                <span class="badge bg-success">Paid</span>
                                                            <?php elseif ($row['status'] == 'Partial'): ?>
                                                                <span class="badge bg-warning text-dark">Partial</span>
                                                            <?php else: ?>
                                                                <span class="badge bg-danger">Pending</span>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="6" class="text-center text-muted">
                                                        No pending reminders 🎉
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- <div class="gridjs-pagination">
                                //$pager->links() ?>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>
</div>