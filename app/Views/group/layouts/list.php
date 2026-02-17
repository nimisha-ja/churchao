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

        <!-- Page Title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                    <h4 class="mb-sm-0">Group</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Group</a></li>
                            <li class="breadcrumb-item active">Group Details</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">

                    <div class="card-header">
                        <h4 class="card-title mb-0 flex-grow-1">Group List</h4>
                    </div>

                    <!-- Flash Messages -->
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
                                <div class="gridjs-head"></div>
                                <div class="gridjs-wrapper" style="height: auto;">

                                    <table id="group-table" role="grid" class="gridjs-table" style="height: auto; text-align: center;">
                                        <thead class="gridjs-thead">
                                            <tr class="gridjs-tr">
                                                <th class="gridjs-th" style="width: 60px;">
                                                    <div class="gridjs-th-content">#</div>
                                                </th>
                                                <th class="gridjs-th">
                                                    <div class="gridjs-th-content">Group Name</div>
                                                </th>
                                                <th class="gridjs-th">
                                                    <div class="gridjs-th-content">Description</div>
                                                </th>
                                                <th class="gridjs-th">
                                                    <div class="gridjs-th-content">Members</div>
                                                </th>
                                                <th class="gridjs-th">
                                                    <div class="gridjs-th-content">Action</div>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="gridjs-tbody">
                                            <?php $serial = 1; ?>
                                            <?php if (!empty($groups) && is_array($groups)): ?>
                                                <?php foreach ($groups as $group): ?>
                                                    <tr class="gridjs-tr align-middle">
                                                        <td class="gridjs-td"><?= $serial++ ?></td>
                                                        <td class="gridjs-td"><?= esc($group['group_name']) ?></td>
                                                        <td class="gridjs-td"><?= esc($group['description']) ?></td>
                                                        <td class="gridjs-td">
                                                            <?php if (!empty($groupMembers[$group['group_id']])): ?>
                                                                <ul class="mb-0 text-start">
                                                                    <?php foreach ($groupMembers[$group['group_id']] as $member): ?>
                                                                        <li>
                                                                            <?= esc($member['full_name']) ?>
                                                                            <small>(<?= esc($member['family_name']) ?>)</small>
                                                                        </li>
                                                                    <?php endforeach; ?>
                                                                </ul>
                                                            <?php else: ?>
                                                                <em>No members</em>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td class="gridjs-td">
                                                            <?php
                                                            $role_id = session()->get('role_id'); // get current user's role
                                                            $group_id = $group['group_id'];

                                                            if ($role_id == 1 || (!empty($groupPermissions[$group_id]) && $groupPermissions[$group_id])): ?>
                                                                <a href="<?= site_url('groups/view/' . $group_id) ?>" class="btn btn-sm btn-success">View</a>
                                                            <?php else: ?>
                                                                <span class="text-muted">Not a member</span>
                                                            <?php endif; ?>


                                                            <a href="<?= site_url('groups/edit/' . $group['group_id']) ?>" class="btn btn-sm btn-warning">Edit</a>
                                                            <a href="<?= site_url('groups/delete/' . $group['group_id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr class="gridjs-tr">
                                                    <td class="gridjs-td" colspan="5">No groups found.</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>

                                </div>
                            </div>

                            <!-- Pagination -->
                            <div class="gridjs-pagination mt-3">
                                <?= $pager->links() ?>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>