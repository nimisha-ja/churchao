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
                    <form action="<?= base_url('donation/save'); ?>" method="post">
                        <?= csrf_field(); ?>

                        <div class="event-card rrmt-30">
                            <div class="headtte14m item-setting-top">
                                <span class="color_bb"><i class="feather-edit"></i></span>
                                <h4>Donate Now</h4>
                            </div>

                            <div class="item-setting">
                                <div class="item-padding30 main-form">
                                    <div class="row">

                                        <div class="col-lg-6 col-md-6">
                                            <div class="form_group mt-30">
                                                <label class="label25">Family</label>
                                                <select name="family_id" class="form_input_1" required>
                                                    <option value="">-- Select Family --</option>
                                                    <?php foreach ($families as $family): ?>
                                                        <option value="<?= $family['family_id']; ?>">
                                                            <?= esc($family['family_name']); ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6">
                                            <div class="form_group mt-30">
                                                <label class="label25">Type of Payment*</label>
                                                <select name="purpose_id" class="form_input_1" required>
                                                    <option value="">-- Select Purpose --</option>
                                                    <?php foreach ($purposes as $purpose): ?>
                                                        <option value="<?= $purpose['id'] ?>">
                                                            <?= esc($purpose['title']) ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6">
                                            <div class="form_group mt-30">
                                                <label class="label25">Amount</label>
                                                <input name="amount" class="form_input_1" type="number" step="0.01" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6">
                                            <div class="form_group mt-30">
                                                <label class="label25">Donation Date</label>
                                                <input name="donation_date" class="form_input_1" type="date" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="form_group mt-30">
                                                <label class="label25">Notes</label>
                                                <textarea name="notes" class="form_input_1"></textarea>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="save-change-btns">
                                    <button type="submit" class="main-save-btn color btn-hover">
                                        Donate Now
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