<?= $this->include('sitecommon/header'); ?>

<div class="wrapper">
    <div class="main-setting">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-4 col-md-12">
                    <div class="event-card rrmt-30">
                        <div class="product_total_stats">
                            <strong class="product_total_numberic">
                                <span class="product_stats_icon"><i class="feather-shopping-cart"></i></span><?php echo $totalFamilies; ?>
                            </strong>
                            <span class="product_stats_label">Families</span>
                        </div>
                    </div>
                    <div class="event-card mt-4">
                        <div class="headtte14m">
                            <span><i class="feather-info"></i></span>
                            <h4>Info</h4>
                        </div>
                        <div class="evntdt99">
                            <div class="mndtlist">
                                <div class="mndesp145 ">
                                    <div class="evarticledes">
                                        <p class="mb-0">St. Alphonsa Syro-Malabar Church, Valiyakolly, is a Roman Catholic church located near Kodenchery in the Kozhikode district of Kerala. Established in 1995, it falls under the jurisdiction of the Diocese of Thamarassery.<br></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><?php if (session()->getFlashdata('success')): ?>

                    <!-- Success Modal -->
                    <div class="modal fade" id="successModal" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-success text-white">
                                    <h5 class="modal-title">Success</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body text-center">
                                    <?= session()->getFlashdata('success'); ?>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">
                                        OK
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            var successModal = new bootstrap.Modal(document.getElementById('successModal'));
                            successModal.show();
                        });
                    </script>

                <?php endif; ?>
                <div class="col-xl-9 col-lg-8 col-md-12">
                    <form action="<?= base_url('save-certificate'); ?>" method="post">
                        <?= csrf_field(); ?>

                        <div class="card mb-4">
                            <div class="card-header bg-light">
                                <h4 class="mb-0">Request Certificate</h4>
                            </div>

                            <div class="card-body">

                                <!-- Family Selection -->
                                <div class="mb-3">
                                    <label for="family_id" class="form-label">Family</label>
                                    <select name="family_id" id="family_id" class="form-control" required>
                                        <option value="">-- Select Family --</option>
                                        <?php foreach ($families as $family): ?>
                                            <option value="<?= $family['family_id']; ?>">
                                                <?= esc($family['family_name']); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <!-- Certificate Type -->
                                <div class="mb-3">
                                    <label for="certificate_type" class="form-label">Certificate Type</label>
                                    <select name="certificate_type" id="certificate_type" class="form-control" required>
                                        <option value="">-- Select Type --</option>
                                        <option value="Baptism">Baptism</option>
                                        <option value="Marriage">Marriage</option>
                                        <option value="Death">Death</option>
                                    </select>
                                </div>

                                <!-- Details -->
                                <div class="mb-3">
                                    <label for="details" class="form-label">Details</label>
                                    <textarea name="details" id="details" class="form-control" rows="3" placeholder="Optional"></textarea>
                                </div>

                                <!-- Submit Button -->
                                <div class="save-change-btns mt-3 text-center">
                                    <button type="submit"
                                        class="btn btn-primary"
                                        style="
                color: #fff !important; 
                font-size: 16px !important; 
                line-height: 1.5 !important; 
                text-shadow: none !important;
                background-color: #0d6efd !important;
            ">
                                        Submit Request
                                    </button>
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