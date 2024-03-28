<?php

ob_start();

include_once $plugin_path . 'page-templates/layout/header.php';


require_once ('wp-load.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!class_exists('WC_Product')) {
        require_once (ABSPATH . 'wp-content/plugins/woocommerce/includes/abstracts/abstract-wc-product.php');
    }

    if (!empty ($_FILES['main_image']['name'])) {
        require_once ABSPATH . 'wp-admin/includes/image.php';
        require_once ABSPATH . 'wp-admin/includes/file.php';
        require_once ABSPATH . 'wp-admin/includes/media.php';
        $main_image_id = media_handle_upload('main_image', 0);
    } else {
        $main_image_id = 0;
    }

    $gallery_image_ids = array();
    if (!empty ($_FILES['gallery_images']['name'][0])) {
        foreach ($_FILES['gallery_images']['name'] as $key => $value) {
            require_once ABSPATH . 'wp-admin/includes/image.php';
            require_once ABSPATH . 'wp-admin/includes/file.php';
            require_once ABSPATH . 'wp-admin/includes/media.php';
            $gallery_image_ids[] = media_handle_upload('gallery_images_' . $key, 0);
        }
    }

    $product_type = $product_type = isset ($_POST['product_type']) ? sanitize_text_field($_POST['product_type']) : '';

    switch ($product_type) {
        case 'simple':
            $product = new WC_Product();

            break;
        case 'variable':
            $product = new WC_Product_Variable();

            break;
        case 'external':
            $product = new WC_Product_External();

            break;
        default:
            // Invalid product type
            // Handle error or display a message
            break;
    }

    $product->set_name(sanitize_text_field($_POST['product_name']));
    $product->set_regular_price(floatval($_POST['product_price']));
    $product->set_description(wp_kses_post($_POST['description']));
    $product->set_short_description(wp_kses_post($_POST['short_description']));
    $product->update_meta_data('product_type', $product_type);

    // Set main image
    if ($main_image_id && !is_wp_error($main_image_id)) {
        $product->set_image_id($main_image_id);
    }

    // Set gallery images
    if (!empty ($gallery_image_ids)) {
        foreach ($gallery_image_ids as $gallery_image_id) {
            if ($gallery_image_id && !is_wp_error($gallery_image_id)) {
                $product->add_gallery_image($gallery_image_id);
            }
        }
    }


    $virtual_product = isset ($_POST["virtual_product"]) ? true : false;

    $product->update_meta_data('virtual', $virtual_product);


    // // Handle downloadable product option
    // $downloadable_product = isset ($_POST["downloadable_product"]) ? true : false;

    // $product->update_meta_data('downloadable', $downloadable_product);

    // // Handle download files
    // $download_files = array();
    // if ($downloadable_product && isset ($_FILES["download_files"])) {
    //     foreach ($_FILES["download_files"]["tmp_name"] as $key => $tmp_name) {
    //         $upload_dir = wp_upload_dir();
    //         $target_dir = $upload_dir["basedir"] . '/downloads/';

    //         // Ensure the directory exists, create it if not
    //         if (!file_exists($target_dir)) {
    //             wp_mkdir_p($target_dir);
    //         }

    //         // Generate a unique filename
    //         $file_name = wp_unique_filename($target_dir, $_FILES["download_files"]["name"][$key]);

    //         // Move the uploaded file to the target directory
    //         $target_file = $target_dir . $file_name;
    //         move_uploaded_file($tmp_name, $target_file);

    //         // Store the file path
    //         $file_paths[] = $upload_dir["baseurl"] . '/downloads/' . $file_name;

    //     }
    // }

    // $product->update_meta_data('downloadable_files', $file_paths);

    // $download_limit = isset ($_POST["download_limit"]) ? intval($_POST["download_limit"]) : -1;

    // $product->update_meta_data('download_limit', $download_limit);

    // $download_expiry = isset ($_POST["download_expiry"]) ? sanitize_text_field($_POST["download_expiry"]) : '';

    // $product->update_meta_data('download_expiry', $download_expiry);


    // $discount_type = isset ($_POST["discount_type"]) ? sanitize_text_field($_POST["discount_type"]) : 'none';
    // // Save discount type as meta data
    // $product->update_meta_data('discount_type', $discount_type);

    // // Handle discount value
    // $discount_value = 0; // Default value
    // if ($discount_type == 'percentage') {
    //     $discount_percentage = isset ($_POST["discount_percentage"]) ? floatval($_POST["discount_percentage"]) : 0;
    //     $discount_value = $discount_percentage;
    // } elseif ($discount_type == 'price') {
    //     $discount_price = isset ($_POST["discount_price"]) ? floatval($_POST["discount_price"]) : 0;
    //     $discount_value = $discount_price;
    // }
    // Save discount value as meta data
    // $product->update_meta_data('discount_value', $discount_value);

    $product_status = isset ($_POST["product_status"]) ? sanitize_text_field($_POST["product_status"]) : 'draft';

    $product->set_status($product_status);
    $product_categories = isset ($_POST["product_category"]) ? $_POST["product_category"] : array();

    $product->set_category_ids($product_categories);

    // Save the product
    $product_id = $product->save();



    if ($product_id) {
        if (!session_id()) {
            session_start();
        }
        $_SESSION['update_message'] = 'Product added successfully.';

        wp_redirect(add_query_arg('create', 'success', home_url('/admin/products')));

        // Redirect after successful update with message
    } else {
        echo 'error';
    }

}


?>

<div class="content">
    <div class="top-inner-page-btn">
        <span class="umala-head">إضافة منتج</span>
    </div>

    <!-- form Start -->
    <form action="" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-4">
                <div class="pt-4 product-edit-page">
                    <div class="sales-chart-bg p-4" style="text-align:-webkit-center;">
                        <h3 class="text-white fw-bold" style="font-size: 26px;">الصوره المصغره</h3>
                        <div class="product-form-image position-relative">
                            <img class="img-fluid"
                                src="<?php echo $plugin_url ?>includes/assets/img/product-form-img.png" alt="">
                            <label for="main_image">
                                <i class="bi bi-pencil-fill product-edits"></i>
                            </label>
                            <input type="file" id="main_image" name="main_image" class="d-none" id="product_img">
                            <i class="bi bi-x product-close"></i>
                        </div>
                    </div>
                </div>
                <div class="pt-4 product-edit-page mt-3">
                    <div class="sales-chart-bg p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="text-white fw-bold" style="font-size: 26px;">حالة</h3>
                            <img class="img-fluid" src="<?php echo $plugin_url ?>includes/assets/img/dots.png"
                                width="15" height="15" alt="">
                        </div>
                        <div class="data-select position-relative edit-drop full-drop mb-3">
                            <i class="fa fa-chevron-down me-5"
                                style="font-size: 12px; color:rgba(255, 255, 255, 1);"></i>
                            <select name="product_status" id="inputrole" class="form-select user-form-input"
                                style="background-color: #5A5A5A;">
                                <option value="publish" selected>نشر</option>
                                <option value="draft">مسودة</option>
                                <option value="pending">في انتظار المراجعة</option>
                            </select>
                        </div>
                        <p>تعيين حالة المنتج</p>
                    </div>
                </div>
                <div class="pt-4 product-edit-page mt-3">
                    <div class="sales-chart-bg p-4">
                        <h3 class="text-white fw-bold" style="font-size: 26px;">فئات المنتجات</h3>
                        <div class="data-select position-relative edit-drop full-drop mb-3">
                            <i class="fa fa-chevron-down me-5"
                                style="font-size: 12px; color:rgba(255, 255, 255, 1);"></i>
                            <select name="product_category[]" multiple id="inputrole"
                                class="form-select user-form-input" style="background-color: #5A5A5A;">
                                <?php
                                $product_categories = get_terms(
                                    array(
                                        'taxonomy' => 'product_cat',
                                        'hide_empty' => false,
                                    )
                                );
                                foreach ($product_categories as $category) {
                                    echo '<option value="' . $category->term_id . '">' . $category->name . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <p>أضف أضف فئات إلى المنتج</p>
                        <div class="top-dropdown mt-3">

                            <button class="simple-btn"><span class="fs-4 ms-2 ">+</span> إضافة فئة جديدة</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="pt-4 product-edit-page">
                    <div class="sales-chart-bg p-4">
                        <h3 class="text-white fw-bold mt-3" style="font-size: 26px;">رئيسي</h3>
                        <form class="form-sec">
                            <label for="productName" class="form-label user-form-label mt-3">اسم المنتج</label>
                            <input type="text" name="product_name" class="form-control" placeholder="اسم المنتج"
                                id="productName">
                            <!-- <label for="permalink" class="form-label user-form-label mt-3 ">الرابط
                            الثابت</label>
                        <input type="text" name="product_permalink" class="form-control" placeholder="" id="permalink"> -->
                            <label for="short-description" class="form-label user-form-label mt-3 ">وصف قصير</label>
                            <textarea name="short_description" class="form-control" rows="3" placeholder="وصف قصير"
                                id="short-description"></textarea>
                            <label for="description" class="form-label user-form-label mt-3 ">وصف</label>
                            <textarea name="description" class="form-control" rows="3" placeholder="وصف"
                                id="description"></textarea>
                            <label for="formFileLg" class="user-form-label mt-3     border: 0.5px solid rgba(255, 255, 255, 1);
                                padding: 20px 10px;
                                border-radius: 5px;
                                background: #2C2C2C;">صالة عرض</label>
                            <div class="d-flex upload-box mt-2 mb-4">
                                <input type="file" id="gallery-images" name="gallery_images[]" multiple />
                                <label for="gallery-images"><img
                                        src="<?php echo $plugin_url ?>includes/assets/img/upload-img.png" width="30"
                                        height="30" alt=""></label>
                                <div>
                                    <h5 class="text-white">اسحب الملفات هنا أو انقر للتحميل</h5>
                                    <p>تحميل ما يصل إلى 10 صور</p>
                                </div>
                            </div>
                            <h5 class="text-white mt-3">تفاصيل المنتج</h5>
                            <div class="form-box mb-4">
                                <label for="formFileLg" class="user-form-label mb-2">نوع المنتج</label>
                                <div>
                                    <div class="dropdown d-flex align-items-center main-div">
                                        <div class="data-select position-relative edit-drop">
                                            <i class="fa fa-chevron-down me-5"
                                                style="font-size: 12px; color:rgba(255, 255, 255, 1);"></i>
                                            <select id="product-type" name="product_type"
                                                class="form-select user-form-input" style="background-color: #5A5A5A;">
                                                <option value="simple" selected>منتج بسيط</option>
                                                <option value="variable">منتج متغير</option>
                                                <option value="external">المنتج الخارجي</option>
                                            </select>
                                        </div>
                                        <div class="form-check ps-0 me-4">
                                            <input id="virtual-product" name="virtual_product"
                                                class="form-check-input me-2" value="1" id="flexCheckDefault">
                                            <label for="virtual-product" class="form-check-label text-white"
                                                style=" font-size: 14px;">
                                                منتج افتراضي
                                            </label>

                                        </div>
                                        <div class="form-check ps-0 me-4">
                                            <input class="form-check-input me-2" name="downloadable_product"
                                                type="checkbox" value="1" id="downloadable-product">
                                            <label class="form-check-label text-white" for="downloadable-product"
                                                style=" font-size: 14px;">
                                                منتج قابل للتنزيل
                                            </label>

                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div id="variation_data" style="display: none;">
                                <h5 class="text-white mt-4 ">تفاوت</h5>
                                <div class="form-box  mt-2">
                                    <div class="d-flex align-items-baseline justify-content-between gap-3 Differences">
                                        <div class="d-flex align-items-baseline gap-4 disparity">
                                            <div class="data-select position-relative edit-drop full-drop mb-3">
                                                <i class="fa fa-chevron-down me-5"
                                                    style="font-size: 12px; color:rgba(255, 255, 255, 1);"></i>
                                                <select id="inputrole" class="form-select user-form-input"
                                                    style="background-color: #5A5A5A;">
                                                    <option selected>حذف كافة الاختلافات</option>
                                                    <option>Option one</option>
                                                    <option>Option one</option>
                                                </select>
                                            </div>
                                            <div class="top-dropdown mt-3">
                                                <button class="simple-btn px-4"
                                                    style="background: none; border: 2px solid rgba(143, 56, 243, 1);">يتقدم</button>
                                            </div>
                                        </div>
                                        <div class="top-dropdown mt-3">
                                            <button class="simple-btn px-4"
                                                style="background: none; border: 2px solid rgba(143, 56, 243, 1);">الاختلافات</button>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-baseline justify-content-between gap-3 flex-wrap">
                                        <div class="d-flex align-items-baseline justify-content-between sahar"
                                            style="gap: 10rem;">
                                            <label for="formFileLg" class="user-form-label mb-2">منتجات</label>
                                            <label for="formFileLg" class="user-form-label mb-2">سعر</label>
                                        </div>
                                        <div class="d-flex align-items-baseline justify-content-between"
                                            style="gap: 3rem;">
                                            <label for="formFileLg" class="user-form-label mb-2">أجراءات</label>
                                            <label for="formFileLg" class="user-form-label mb-2">مخزون</label>
                                        </div>

                                    </div>
                                    <h6 class="text-white">لا توجد بيانات متاحة في الجدول</h6>
                                    <div class="d-flex align-items-baseline justify-content-between">
                                        <div class="nav-sec">
                                            <button><i class="bi bi-chevron-right"></i></button>
                                            <button><i class="bi bi-chevron-left"></i></button>
                                        </div>
                                        <div class="data-select position-relative edit-drop full-drop mb-3 w-25 num-drop"
                                            style="border-radius: 5px;">
                                            <i class="fa fa-chevron-down me-5"
                                                style="font-size: 12px; color:rgba(255, 255, 255, 1);"></i>
                                            <select id="inputrole" class="form-select user-form-input"
                                                style="background-color: #5A5A5A; border: 2px solid rgba(143, 56, 243, 1); border-radius: 5px;">
                                                <option selected>25</option>
                                                <option>20</option>
                                                <option>30</option>
                                                <option>30</option>
                                                <option>30</option>
                                                <option>30</option>
                                                <option>30</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div id="price">
                                <h5 class="text-white mt-4 ">سعر</h5>
                                <div class="form-box  mt-2">
                                    <label for="formFileLg" class="user-form-label mb-2">Regular Price</label>
                                    <input type="text" name="product_price" class="form-control mb-3"
                                        placeholder="Product Price" id="inputPassword4"
                                        style="background-color: #5A5A5A; border: none;">
                                    <label for="formFileLg" class="user-form-label mb-0">Discount Type</label>
                                    <div class="d-flex align-items-center gap-3 mb-3 diamension" dir="ltr">
                                        <div class="radio-btn-sec">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                    id="flexRadioDefault1">
                                                <label class="form-check-label radio-small" for="flexRadioDefault1">
                                                    Without Sale
                                                </label>
                                            </div>
                                        </div>
                                        <div class="radio-btn-sec">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                    id="flexRadioDefault1">
                                                <label class="form-check-label radio-small" for="flexRadioDefault1">
                                                    Percentage%
                                                </label>
                                            </div>
                                        </div>
                                        <div class="radio-btn-sec">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                    id="flexRadioDefault1">
                                                <label class="form-check-label radio-small" for="flexRadioDefault1">
                                                    Pricing After Sale
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <label for="formFileLg" class="user-form-label mb-2">Tax status</label>
                                    <div class="data-select position-relative edit-drop full-drop mb-3">
                                        <i class="fa fa-chevron-down me-5"
                                            style="font-size: 12px; color:rgba(255, 255, 255, 1);"></i>
                                        <select id="inputrole" class="form-select user-form-input"
                                            style="background-color: #5A5A5A;">
                                            <option selected>None</option>
                                            <option>Option one</option>
                                            <option>Option one</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <h5 class="text-white mt-4 ">جرد</h5>
                                <div class="form-box  mt-2">
                                    <label for="sku" class="user-form-label mb-2">منتج SKU</label>
                                    <input type="text" class="form-control" placeholder="منتج SKU" id="sku"
                                        style="background-color: #5A5A5A; border: none;">
                                    <p class="mt-2">أدخل المنتج SKU</p>
                                    <div class="form-check ps-0 me-4" style="position: relative;">
                                        <input class="form-check-input me-2" type="checkbox" value=""
                                            id="flexCheckDefault" style="position: absolute; right: -34px;">
                                        <label class="form-check-label text-white" for="flexCheckDefault"
                                            style=" font-size: 14px;">
                                            قم بتمكين هذا الخيار لتمكين إدارة المخزون
                                        </label>
                                    </div>
                                    <label for="formFileLg" class="user-form-label mb-2 mt-3">حالة الرصيد، وضع
                                        مخزون</label>
                                    <div class="data-select position-relative edit-drop full-drop mb-3">
                                        <i class="fa fa-chevron-down me-5"
                                            style="font-size: 12px; color:rgba(255, 255, 255, 1);"></i>
                                        <select id="inputrole" class="form-select user-form-input"
                                            style="background-color: #5A5A5A;">
                                            <option selected>حالة الرصيد، وضع مخزون</option>
                                            <option>Option one</option>
                                            <option>Option one</option>
                                        </select>
                                    </div>
                                    <div class="form-check ps-0 me-4" style="position: relative;">
                                        <input class="form-check-input me-2" type="checkbox" value=""
                                            id="flexCheckDefault" style="position: absolute; right: -34px;">
                                        <label class="form-check-label text-white" for="flexCheckDefault"
                                            style=" font-size: 14px;">
                                            قم بتمكين هذا الخيار للسماح بعملية شراء واحدة فقط لهذا المنتج في طلب منفصل
                                        </label>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <h5 class="text-white mt-4 ">بيانات الشحن</h5>
                    <div class="form-box  mt-2">
                        <label for="formFileLg" class="user-form-label mb-2">وزن</label>
                        <input type="text" class="form-control mb-3" placeholder="وزن" id="inputPassword4"
                            style="background-color: #5A5A5A; border: none;">
                        <label for="formFileLg" class="user-form-label mb-0">أبعاد</label>
                        <div class="d-flex align-items-center gap-3 mb-3 diamension">
                            <input type="text" class="form-control" placeholder="ارتفاع" id="inputPassword4"
                                style="background-color: #5A5A5A; border: none;">
                            <input type="text" class="form-control" placeholder="عرض" id="inputPassword4"
                                style="background-color: #5A5A5A; border: none;">
                            <input type="text" class="form-control" placeholder="طول" id="inputPassword4"
                                style="background-color: #5A5A5A; border: none;">
                        </div>
                        <label for="formFileLg" class="user-form-label mb-2">فئة الشحن</label>
                        <div class="data-select position-relative edit-drop full-drop mb-3">
                            <i class="fa fa-chevron-down me-5"
                                style="font-size: 12px; color:rgba(255, 255, 255, 1);"></i>
                            <select id="inputrole" class="form-select user-form-input"
                                style="background-color: #5A5A5A;">
                                <option selected>فئة الشحن</option>
                                <option>Option one</option>
                                <option>Option one</option>
                            </select>
                        </div>
                    </div>
                    <h5 class="text-white mt-4">المنتجات المرتبطة</h5>
                    <div class="product-edit-page form-box mt-2">
                        <label for="formFileLg" class="user-form-label mb-2">المنتجات الموصى بها</label>
                        <div class="data-select position-relative edit-drop full-drop mb-3">
                            <i class="fa fa-chevron-down me-5"
                                style="font-size: 12px; color:rgba(255, 255, 255, 1);"></i>
                            <select id="inputrole" class="form-select user-form-input"
                                style="background-color: #5A5A5A;">
                                <option selected>اشر على الخيارات</option>
                                <option>Option one</option>
                                <option>Option one</option>
                            </select>
                        </div>
                        <label for="formFileLg" class="user-form-label mb-2">بيع الصليب</label>
                        <div class="data-select position-relative edit-drop full-drop mb-3">
                            <i class="fa fa-chevron-down me-5"
                                style="font-size: 12px; color:rgba(255, 255, 255, 1);"></i>
                            <select id="inputrole" class="form-select user-form-input"
                                style="background-color: #5A5A5A;">
                                <option selected>اشر على الخيارات</option>
                                <option>Option one</option>
                                <option>Option one</option>
                            </select>
                        </div>
                    </div>

                    <h5 class="text-white mt-4">شراء المنتجات مع</h5>
                    <div class="product-edit-page form-box mt-2">
                        <label for="formFileLg" class="user-form-label mb-2">البحث عن المنتجات</label>
                        <div class="data-select position-relative edit-drop full-drop mb-3">
                            <i class="fa fa-chevron-down me-5"
                                style="font-size: 12px; color:rgba(255, 255, 255, 1);"></i>
                            <select id="inputrole" class="form-select user-form-input"
                                style="background-color: #5A5A5A;">
                                <option selected>ابحث عن منتج</option>
                                <option>Option one</option>
                                <option>Option one</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="top-dropdown mt-3">

                    <button type="submit" class="simple-btn px-5">يحفظ</button>
                </div>
    </form>
</div>

<script>
    jQuery(document).ready(function ($) {

        $('#imageInput').on('change', function () {
            if (this.files.length > 10) {
                alert('You can only upload a maximum of 10 images.');
                $(this).val('');
            }
        });


        $('#product-type').change(function () {
            var productType = $(this).val();
            // alert(productType);
            if (productType === "variable") {
                $('#variation_data').show();
            }
            else {
                $('#variation_data').hide();
            }
        });
    });
</script>


<?php

include_once $plugin_path . 'page-templates/layout/sidebar.php';
include_once $plugin_path . 'page-templates/layout/footer.php';

ob_end_flush();

?>