<?php
include_once $plugin_path . 'page-templates/layout/header.php';

?>

<!-- Content Start -->
<div class="content">
    <div class="top-inner-page-btn">
        <span class="umala-head">قائمة الإعداد</span>
    </div>
    <div class="d-flex align-items-center justify-content-between mt-4 flex-wrap">
        <div class="d-flex gap-4 text-white">
            <span>الكل(2)</span>
            <span style="color:#782C96;">|</span>
            <span> نشرت(2)</span>
        </div>
        <div class="top-search">
            <input type="search" class="form-control" placeholder="ابحث هنا...">
            <i class="bi bi-search"></i>
        </div>
    </div>

    <!-- Table Start -->
    <div class="setting-page mt-4">
        <div class="row gy-4">
            <div class="col-lg-4">
                <a href="#">
                    <div class="sales-chart-bg p-4 w-100 text-center">
                        <img src="<?php echo $plugin_url ?>includes/assets/img/setting-page-img-7.png" alt="">
                        <h4 class="text-white fw-bold mt-3">إعدادات المتجر</h4>
                    </div>
                </a>
            </div>
            <div class="col-lg-4">
                <a href="#">
                    <div class="sales-chart-bg p-4 w-100 text-center">
                        <img src="<?php echo $plugin_url ?>includes/assets/img/setting-page-img-2.png" alt="">
                        <h4 class="text-white fw-bold mt-3">إشعارات</h4>
                    </div>
                </a>
            </div>
            <div class="col-lg-4">
                <a href="#">
                    <div class="sales-chart-bg p-4 w-100 text-center">
                        <img src="<?php echo $plugin_url ?>includes/assets/img/setting-page-img-1.png" alt="">
                        <h4 class="text-white fw-bold mt-3">الاعدادات العامة</h4>
                    </div>
                </a>
            </div>


            <div class="col-lg-4">
                <a href="#">
                    <div class="sales-chart-bg p-4 w-100 text-center">
                        <img src="<?php echo $plugin_url ?>includes/assets/img/setting-page-img-8.png" alt="">
                        <h4 class="text-white fw-bold mt-3">قنوات التسويق</h4>
                    </div>
                </a>
            </div>
            <div class="col-lg-4">
                <a href="#">
                    <div class="sales-chart-bg p-4 w-100 text-center">
                        <img src="<?php echo $plugin_url ?>includes/assets/img/setting-page-img-4.png" alt="">
                        <h4 class="text-white fw-bold mt-3">إعدادات المدفوعات</h4>
                    </div>
                </a>
            </div>
            <div class="col-lg-4">
                <a href="#">
                    <div class="sales-chart-bg p-4 w-100 text-center">
                        <img src="<?php echo $plugin_url ?>includes/assets/img/setting-page-img-3.png" alt="">
                        <h4 class="text-white fw-bold mt-3">رموز مخصصة</h4>
                    </div>
                </a>
            </div>


            <div class="col-lg-4">
                <a href="#">
                    <div class="sales-chart-bg p-4 w-100 text-center">
                        <img src="<?php echo $plugin_url ?>includes/assets/img/setting-page-img-9.png" alt="">
                        <h4 class="text-white fw-bold mt-3">إعداد المخزون</h4>
                    </div>
                </a>
            </div>
            <div class="col-lg-4">
                <a href="#">
                    <div class="sales-chart-bg p-4 w-100 text-center">
                        <img src="<?php echo $plugin_url ?>includes/assets/img/setting-page-img-6.png" alt="">
                        <h4 class="text-white fw-bold mt-3">اعدادات الشحن</h4>
                    </div>
                </a>
            </div>
            <div class="col-lg-4">
                <a href="#">
                    <div class="sales-chart-bg p-4 w-100 text-center">
                        <img src="<?php echo $plugin_url ?>includes/assets/img/setting-page-img-5.png" alt="">
                        <h4 class="text-white fw-bold mt-3">الأدوار والأذونات</h4>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <!-- Table End -->

    <!-- Footer Start -->
    <!-- <div class="container-fluid pt-4 px-4">
                <div class="bg-white rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="#">Your Site Name</a>, All Right Reserved. 
                        </div>
                        <div class="col-12 col-sm-6 text-center text-sm-end">
                            Designed By <a href="https://htmlcodex.com">HTML Codex</a>
                        </div>
                    </div>
                </div>
            </div> -->
    <!-- Footer End -->
</div>
<!-- Content End -->

<?php

include_once $plugin_path . 'page-templates/layout/sidebar.php';
include_once $plugin_path . 'page-templates/layout/footer.php';

?>