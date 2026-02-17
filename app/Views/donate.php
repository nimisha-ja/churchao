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
                </div>
                <div class="col-xl-9 col-lg-8 col-md-12">
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
                                            <label class="label25">Name</label>
                                            <input class="form_input_1" type="text" placeholder="" value="">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form_group mt-30">
                                            <label class="label25">House Name</label>
                                            <input class="form_input_1" type="text" placeholder="" value="">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form_group mt-30">
                                            <label class="label25">Type of Payment*</label>
                                            <select class="selectpicker" title="Select Gender">
                                                <option value="donation" selected>Donation</option>
                                                <option value="periodical payment">Periodical Payment</option>
                                                <option value="other">Other</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form_group mt-30">
                                            <label class="label25">Amount</label>
                                            <input class="form_input_1" type="text" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="terms-dt">
                                            <div class="form_group mt-30">
                                                <div class="cogs-toggle">
                                                    <label class="switch">
                                                        <input type="checkbox" id="publish_post" value="">
                                                        <span></span>
                                                    </label>
                                                    <label for="publish_post" class="lbl-quiz">
                                                        Members can see phone number? (on/off)
                                                        <small class="block-small">Privacy</small>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="save-change-btns">
                                <button class="main-save-btn color btn-hover">Donate Now</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->include('sitecommon/footer'); ?>