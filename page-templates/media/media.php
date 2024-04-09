<?php
include_once $plugin_path . 'page-templates/layout/header.php';
// Query to fetch all media items
$media_query = new WP_Query(array(
    'post_type' => 'attachment', // Fetch attachments
    'post_status' => 'inherit', // Include inherited statuses like 'inherit' and 'trash'
    'posts_per_page' => -1, // Retrieve all attachments
));

?>
<!-- Content Start -->
<div class="content">
    <div class="top-inner-page-btn mb-3">
        <span class="umala-head">وسائط</span>
    </div>

    <div class="sales-chart-bg p-4">
        <!-- medias tabs starts -->

        <ul class="nav nav-medias medias-tabs-sec gap-3 pt-4 " id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active media-tabs-btn text-white" id="medias-tab-1" data-bs-toggle="pill" data-bs-target="#media1" type="button" role="tab" aria-controls="media1" aria-selected="true">مكتبة الوسائط</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link media-tabs-btn text-white" id="medias-tab-2" data-bs-toggle="pill" data-bs-target="#medias2" type="button" role="tab" aria-controls="medias2" aria-selected="false">تحميل الملفات</button>
            </li>

        </ul>

        <div class="tab-content" id="pills-tabContent">
            <!-- first Tab start -->
            <div class="tab-pane fade show active" id="media1" role="tabpanel" aria-labelledby="medias-tab-1">

                <div class="row gy-4 mt-3">
                    <?php if ($media_query->have_posts()) :
                        while ($media_query->have_posts()) : $media_query->the_post();

                            // Get attachment data
                            $attachment_id = get_the_ID();
                            $attachment_url = wp_get_attachment_url($attachment_id);
                            $attachment_image = wp_get_attachment_image($attachment_id, 'thumbnail');

                            // Display each media item
                    ?>
                            <div class="col-12 col-sm-6 col-md-3 col-lg-2">
                                <div class="mideas-image-sec" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                    <img src="<?php echo esc_url($attachment_url); ?>" class="img-fluid medias-image" alt="Image 1">
                                </div>
                            </div>
                    <?php
                        endwhile;
                        wp_reset_postdata();
                    else :
                        echo 'No media items found.';
                    endif; ?>
                </div>

            </div>
            <!-- first Tab end -->

            <div class="tab-pane fade" id="medias2" role="tabpanel" aria-labelledby="medias-tab-2">
                <div class="row gy-4 mt-3">
                    <div class="col-12 col-sm-6 col-md-3 col-lg-2">
                        <div class="mideas-image-sec" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            <img src="./img/media-library-img-5.png" class="img-fluid medias-image" alt="Image 1">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- medias tabs ends -->

    <!-- Modal Start-->
    <div class="modal-sec">
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x product-close"></i></button>
                    </div>
                    <div class="modal-body mt-3">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                                <div>
                                    <img class="img-fluid" src="./img/modal-img.png" alt="">
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-8 col-lg-8">
                                <div class="modal-left-content">
                                    <div class="mod-title">
                                        <span>تفاصيل الصورة</span>
                                    </div>
                                    <div class="d-flex gap-5 mt-3 pb-3" style="border-bottom: 2px solid rgba(219, 219, 219, 1);">
                                        <div>
                                            <p>تم الرفع بواسطة</p>
                                            <p>أبعاد</p>
                                            <p>تاريخ الرفع</p>
                                            <p>مقاس</p>
                                        </div>


                                        <div>
                                            <p>مشاري</p>
                                            <p>536 * 452 px</p>
                                            <p>الأربعاء، ٢٠ مارس</p>
                                            <p>30 KB</p>
                                        </div>
                                    </div>
                                    <form>
                                        <label for="inputPassword4" class="form-label user-form-label mt-3">عنوان
                                        </label>
                                        <input type="text" class="form-control" placeholder="عنوان" id="inputPassword4">
                                        <label for="inputPassword4" class="form-label user-form-label mt-3">وصف
                                        </label>
                                        <input type="text" class="form-control" placeholder="وصف" id="inputPassword4">
                                        <label for="inputPassword4" class="form-label user-form-label mt-3">رابط
                                            الملف
                                        </label>
                                        <input type="text" class="form-control" placeholder="رابط الملف" id="inputPassword4">
                                    </form>
                                </div>
                                <div class="top-dropdown d-flex flex-wrap mt-4">
                                    <button class="simple-btn px-4">تعديل الملف</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Modal end -->
</div>

<!-- Content End -->

<?php
include_once $plugin_path . 'page-templates/layout/sidebar.php';
include_once $plugin_path . 'page-templates/layout/footer.php';
?>