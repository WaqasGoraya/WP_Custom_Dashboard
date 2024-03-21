<?php
include_once $plugin_path . 'page-templates/layout/header.php';
?>
<!-- Content Start -->
<div class="content">
    <div class="top-inner-page-btn">
        <span class="umala-head">المواضيع :</span>
    </div>
    <div class="d-flex align-items-center justify-content-between mt-4 flex-wrap">
        <div class="top-inner-page-btn">
            <span class="text-white fw-bold" style="font-size: 20px;">قوالب :</span>
            <button class="text-white"> إضافة قوالب &nbsp; +</button>
        </div>
        <div class="top-search">
            <input type="search" class="form-control" placeholder="ابحث هنا...">
            <i class="bi bi-search"></i>
        </div>
    </div>



    <!-- Table Start -->
    <div class="pt-4 umala-page">
        <div class="sales-chart-bg px-3 d-flex align-items-center justify-content-center">
            <img class="img-fluid" src="./img/appearence-graph.png" alt="">
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