<?= $this->include('sitecommon/header'); ?>

<div class="wrapper pt-0">
    <div class="main-background-cover breadcrumb-pt">
        <div class="banner-user" style="background-image:url(<?= base_url('public/layout/'); ?>images/banners/bg-3.jpg);">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="banner-item-dts">
                            <div class="banner-content">
                                <div class="banner-media">
                                    <div class="item-profile-img">
                                        <img src="<?= base_url('public/layout/'); ?>images/left-imgs/img-3.jpg" alt="User-Avatar">
                                    </div>
                                    <div class="banner-media-body">
                                   
                                        <ul class="user-meta-btns">
                                            <li class="mt-2"><button type="button" class="profile-edit-btn btn-hover"><i class="feather-plus me-2"></i>Donate</button></li>
                                            <li class="mt-2"><button type="button" class="follow-btn"><i class="feather-user-plus me-2"></i>Dashboard</button></li>
                                            <li class="mt-2"><button type="button" class="pg-message-btn msgngup">Updates</button></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="custom-pl-tabs">
        <div class="container">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                       <?= $this->include('sitecommon/navbar'); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="dtpgusr12">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-4 col-md-12 order-lg-1 order-2">
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
                                <div class="mndesp145 s">
                                    <div class="evarticledes">
                                        <p class="mb-0">St. Alphonsa Syro-Malabar Church, Valiyakolly, is a Roman Catholic church located near Kodenchery in the Kozhikode district of Kerala. Established in 1995, it falls under the jurisdiction of the Diocese of Thamarassery.<br></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-8 col-md-12 order-lg-2 order-1">
                    <div class="pf-deferred-area">
                        <div class="pf-deferred-content">
                            <div class="pf-deferred-dashboard_header">
                                <h4>Dashboard</h4>
                                <!-- <p>Private to you</p> -->
                            </div>
                            <div class="pf-deferred-dashboard_card-section">
                                <div class="pf-deferred-dashboard_card">
                                    <a href="#" class="pf-dashboard-section__card-action">
                                        <span class="pv-dashboard-section__metric-count"><?php echo $totalDonations?></span>
                                        <span class="pv-dashboard-section__metric-text">Total Donations</span>
                                    </a>
                                    <!-- <a href="#" class="pf-dashboard-section__card-action">
                                        <span class="pv-dashboard-section__metric-count">$782</span>
                                        <span class="pv-dashboard-section__metric-text">This month</span>
                                    </a>
                                    <a href="#" class="pf-dashboard-section__card-action">
                                        <span class="pv-dashboard-section__metric-count">$22,550</span>
                                        <span class="pv-dashboard-section__metric-text">Total earning</span>
                                    </a> -->
                                </div>
                                <!-- <div class="pf-deferred-dashboard_card-cate-section">
                                    <div class="row">
                                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                            <a href="my_manage_jobs.html" class="pf-dashboard-section__card-item">
                                                <i class="feather-briefcase"></i>
                                                <h4 class="pv-dashboard-section__metric-title">Jobs</h4>
                                                <p class="pv-dashboard-section__metric-products-totle">4 Posted Jobs</p>
                                            </a>
                                        </div>
                                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                            <a href="my_portfolio.html" class="pf-dashboard-section__card-item">
                                                <i class="feather-shopping-cart"></i>
                                                <h4 class="pv-dashboard-section__metric-title">Products</h4>
                                                <p class="pv-dashboard-section__metric-products-totle">5 Added Products</p>
                                            </a>
                                        </div>
                                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                            <a href="my_courses.html" class="pf-dashboard-section__card-item">
                                                <i class="feather-book-open"></i>
                                                <h4 class="pv-dashboard-section__metric-title">Courses</h4>
                                                <p class="pv-dashboard-section__metric-products-totle">4 Added Courses</p>
                                            </a>
                                        </div>
                                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                            <a href="my_pages.html" class="pf-dashboard-section__card-item">
                                                <i class="feather-flag"></i>
                                                <h4 class="pv-dashboard-section__metric-title">Pages</h4>
                                                <p class="pv-dashboard-section__metric-products-totle">1 Created Page</p>
                                            </a>
                                        </div>
                                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                            <a href="my_groups.html" class="pf-dashboard-section__card-item">
                                                <i class="feather-users"></i>
                                                <h4 class="pv-dashboard-section__metric-title">Groups</h4>
                                                <p class="pv-dashboard-section__metric-products-totle">1 Created Group</p>
                                            </a>
                                        </div>
                                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                            <a href="my_events.html" class="pf-dashboard-section__card-item">
                                                <i class="feather-calendar"></i>
                                                <h4 class="pv-dashboard-section__metric-title">Events</h4>
                                                <p class="pv-dashboard-section__metric-products-totle">1 Created Event</p>
                                            </a>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->include('sitecommon/footer'); ?>