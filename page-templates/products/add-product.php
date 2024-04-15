<?php

ob_start();

include_once $plugin_path . 'page-templates/layout/header.php';


require_once ('wp-load.php');



if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!class_exists('WC_Product')) {
        require_once (ABSPATH . 'wp-content/plugins/woocommerce/includes/abstracts/abstract-wc-product.php');
    }

    $gallery_image_ids = array();
    if (!empty($_FILES['gallery_images']['name'][0])) {
        foreach ($_FILES['gallery_images']['name'] as $key => $value) {
            require_once ABSPATH . 'wp-admin/includes/image.php';
            require_once ABSPATH . 'wp-admin/includes/file.php';
            require_once ABSPATH . 'wp-admin/includes/media.php';
            $gallery_image_ids[] = media_handle_upload('gallery_images_' . $key, 0);
        }
    }

    $product_type = $product_type = isset($_POST['product_type']) ? sanitize_text_field($_POST['product_type']) : '';

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
    $main_image_id = $sku = isset($_POST['main_image']) ? sanitize_text_field($_POST['main_image']) : '';
    $attachment_id = attachment_url_to_postid($main_image_id);
    if ($main_image_id && !is_wp_error($attachment_id)) {
        $product->set_image_id($attachment_id);
    }

    // Set gallery images
    if (!empty($gallery_image_ids)) {
        foreach ($gallery_image_ids as $gallery_image_id) {
            if ($gallery_image_id && !is_wp_error($gallery_image_id)) {
                $product->add_gallery_image($gallery_image_id);
            }
        }
    }


    $virtual_product = isset($_POST["virtual_product"]) ? true : false;

    $product->update_meta_data('virtual', $virtual_product);


    // Handle downloadable product option
    $downloadable_product = isset($_POST["downloadable_product"]) ? true : false;

    $product->update_meta_data('downloadable', $downloadable_product);

    // Handle download files
    $download_files = array();
    if ($downloadable_product && isset($_FILES["download_files"])) {
        foreach ($_FILES["download_files"]["tmp_name"] as $key => $tmp_name) {
            $upload_dir = wp_upload_dir();
            $target_dir = $upload_dir["basedir"] . '/downloads/';

            // Ensure the directory exists, create it if not
            if (!file_exists($target_dir)) {
                wp_mkdir_p($target_dir);
            }

            // Generate a unique filename
            $file_name = wp_unique_filename($target_dir, $_FILES["download_files"]["name"][$key]);

            // Move the uploaded file to the target directory
            $target_file = $target_dir . $file_name;
            move_uploaded_file($tmp_name, $target_file);

            // Store the file path
            $file_paths[] = $upload_dir["baseurl"] . '/downloads/' . $file_name;

        }
    }

    $product->update_meta_data('downloadable_files', $file_paths);

    $download_limit = isset($_POST["download_limit"]) ? intval($_POST["download_limit"]) : -1;

    $product->update_meta_data('download_limit', $download_limit);

    $download_expiry = isset($_POST["download_expiry"]) ? sanitize_text_field($_POST["download_expiry"]) : '';

    $product->update_meta_data('download_expiry', $download_expiry);


    $discount_type = isset($_POST["discount_type"]) ? sanitize_text_field($_POST["discount_type"]) : 'none';
    // Save discount type as meta data
    $product->update_meta_data('discount_type', $discount_type);

    // Handle discount value
    $discount_value = 0; // Default value
    if ($discount_type == 'percentage') {
        $discount_percentage = isset($_POST["discount_percentage"]) ? floatval($_POST["discount_percentage"]) : 0;
        $discount_value = $discount_percentage;
    } elseif ($discount_type == 'price') {
        $discount_price = isset($_POST["discount_price"]) ? floatval($_POST["discount_price"]) : 0;
        $discount_value = $discount_price;
    }
    //  Save discount value as meta data
    $product->update_meta_data('discount_value', $discount_value);

    $product_status = isset($_POST["product_status"]) ? sanitize_text_field($_POST["product_status"]) : 'draft';

    $product->set_status($product_status);
    $product_categories = isset($_POST["product_category"]) ? $_POST["product_category"] : array();

    $product->set_category_ids($product_categories);

    // Save the product
    $product_id = $product->save();




    $sku = isset($_POST['product_sku']) ? sanitize_text_field($_POST['product_sku']) : '';
    update_post_meta($product_id, '_sku', $sku);


    //shipping..

    $length = isset($_POST['product_length']) ? sanitize_text_field($_POST['product_length']) : '';
    $width = isset($_POST['product_width']) ? sanitize_text_field($_POST['product_width']) : '';
    $height = isset($_POST['product_height']) ? sanitize_text_field($_POST['product_height']) : '';
    update_post_meta($product_id, '_length', $length);
    update_post_meta($product_id, '_width', $width);
    update_post_meta($product_id, '_height', $height);

    // Save shipping class
    $shipping_class = isset($_POST['product_shipping_class']) ? sanitize_text_field($_POST['product_shipping_class']) : '';
    wp_set_object_terms($product_id, $shipping_class, '_shipping_class', false);

    $shipping_weight = isset($_POST['shipping_weight']) ? sanitize_text_field($_POST['shipping_weight']) : '';
    update_post_meta($product_id, '_weight', $shipping_weight);



    if (isset($_POST['recommended_products'])) {
        foreach ($_POST['recommended_products'] as $product_id => $recommended_products) {
            update_post_meta($product_id, '_recommended_ids', $recommended_products);
        }
    }

    // Save cross-sell products
    if (isset($_POST['cross_sell_products'])) {
        foreach ($_POST['cross_sell_products'] as $product_id => $cross_sell_products) {
            update_post_meta($product_id, '_crosssell_ids', $cross_sell_products);
        }
    }


    if (isset($_POST['buy_with_products'])) {
        foreach ($_POST['buy_with_products'] as $product_id => $buy_with_products) {
            update_post_meta($product_id, '_buy_with_ids', $buy_with_products);
        }
    }


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
        <input type="hidden" value="<?= $product_id ?>" name="product_id" id="product_id">
        <div class="row">
            <div class="col-lg-4">
                <div class="pt-4 product-edit-page">
                    <div class="sales-chart-bg p-4" style="text-align:-webkit-center;">
                        <h3 class="text-white fw-bold" style="font-size: 26px;">الصوره المصغره</h3>
                        <div class="product-form-image position-relative">
                            <img class="img-fluid" id="p_image_container"
                                src="<?php echo $plugin_url ?>includes/assets/img/placeholder.jpg" alt="">
                            <button id="main_image_product">
                                <i class="bi bi-pencil-fill product-edits"></i>
                            </button>
                            <input type="hidden" id="main_image" name="main_image">
                            <i class="bi bi-x product-close" id="clear_img"></i>

                            <!-- <input id="main_image_product" type="button" value="Select Images"> -->
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
                                        <input id="virtual-product" name="virtual_product" class="form-check-input me-2"
                                            type="checkbox" value="1" id="flexCheckDefault">
                                        <label for="virtual-product" class="form-check-label text-white"
                                            style=" font-size: 14px;">
                                            منتج افتراضي
                                        </label>

                                    </div>
                                    <div class="form-check ps-0 me-4">
                                        <input class="form-check-input me-2" name="downloadable_product" type="checkbox"
                                            value="1" id="downloadable-product">
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
                                        <button type="button" class="simple-btn px-4" data-bs-toggle="modal"
                                            data-bs-target="#varients"
                                            style="background: none; border: 2px solid rgba(143, 56, 243, 1);">
                                            الاختلافات
                                        </button>
                                    </div>
                                </div>

                                <div class="d-flex align-items-baseline justify-content-between gap-3 flex-wrap">
                                    <div class="d-flex align-items-baseline justify-content-between sahar"
                                        style="gap: 10rem;">
                                        <label for="formFileLg" class="user-form-label mb-2">منتجات</label>
                                        <label for="formFileLg" class="user-form-label mb-2">سعر</label>
                                    </div>
                                    <div class="d-flex align-items-baseline justify-content-between" style="gap: 3rem;">
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
                                            <option>25</option>
                                            <option selected>20</option>
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
                        <div id="price" style="display: block;">
                            <h5 class="text-white mt-4 ">سعر</h5>
                            <div class="form-box  mt-2">
                                <label for="formFileLg" class="user-form-label mb-2">سعر عادي</label>
                                <input type="text" name="product_price" class="form-control mb-3"
                                    placeholder="سعر المنتج" id="inputPassword4"
                                    style="background-color: #5A5A5A; border: none;">
                                <label for="formFileLg" class="user-form-label mb-0">نوع الخصم</label>
                                <div class="d-flex align-items-center gap-3 mb-3 diamension" dir="ltr">
                                    <div class="radio-btn-sec">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                id="flexRadioDefault1">
                                            <label class="form-check-label radio-small" for="flexRadioDefault1">
                                                بدون بيع
                                            </label>
                                        </div>
                                    </div>
                                    <div class="radio-btn-sec">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                id="flexRadioDefault1">
                                            <label class="form-check-label radio-small" for="flexRadioDefault1">
                                                نسبة مئوية٪
                                            </label>
                                        </div>
                                    </div>
                                    <div class="radio-btn-sec">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                id="flexRadioDefault1">
                                            <label class="form-check-label radio-small" for="flexRadioDefault1">
                                                التسعير بعد البيع
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <label for="formFileLg" class="user-form-label mb-2">الوضع الضريبي</label>
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
                                <input type="text" name="product_sku" class="form-control" placeholder="منتج SKU"
                                    id="sku" style="background-color: #5A5A5A; border: none;">
                                <p class="mt-2">أدخل المنتج SKU</p>
                                <div class="form-check ps-0 me-4" style="position: relative;">
                                    <input class="form-check-input me-2" type="checkbox" value="" id="flexCheckDefault"
                                        style="position: absolute; right: -34px;">
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
                                    <input class="form-check-input me-2" type="checkbox" value="" id="flexCheckDefault"
                                        style="position: absolute; right: -34px;">
                                    <label class="form-check-label text-white" for="flexCheckDefault"
                                        style=" font-size: 14px;">
                                        قم بتمكين هذا الخيار للسماح بعملية شراء واحدة فقط لهذا المنتج في طلب منفصل
                                    </label>
                                </div>
                            </div>
                        </div>
                        <h5 class="text-white mt-4 ">بيانات الشحن</h5>
                        <div class="form-box  mt-2">
                            <label for="formFileLg" class="user-form-label mb-2">وزن</label>
                            <input type="text" name="shipping_weight" class="form-control mb-3" placeholder="وزن"
                                id="inputPassword4" style="background-color: #5A5A5A; border: none;">
                            <label for="formFileLg" class="user-form-label mb-0">أبعاد</label>
                            <div class="d-flex align-items-center gap-3 mb-3 diamension">
                                <input type="text" class="form-control" name="product_height" placeholder="ارتفاع"
                                    id="inputPassword4" style="background-color: #5A5A5A; border: none;">
                                <input type="text" class="form-control" name="product_width" placeholder="عرض"
                                    id="inputPassword4" style="background-color: #5A5A5A; border: none;">
                                <input type="text" class="form-control" name="product_length" placeholder="طول"
                                    id="inputPassword4" style="background-color: #5A5A5A; border: none;">
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

                                <?php
                                $products = wc_get_products(array('status' => 'publish'));
                                ?>
                                <select name="recommended_products[]" multiple class="form-select user-form-input"
                                    style="background-color: #5A5A5A;">
                                    <option selected>اشر على الخيارات</option>
                                    <?php foreach ($products as $product): ?>
                                        <option value="<?php echo $product->get_id(); ?>">
                                            <?php echo $product->get_name(); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <label for="formFileLg" class="user-form-label mb-2">بيع الصليب</label>
                            <div class="data-select position-relative edit-drop full-drop mb-3">
                                <i class="fa fa-chevron-down me-5"
                                    style="font-size: 12px; color:rgba(255, 255, 255, 1);"></i>
                                <select name="cross_sell_products[]" multiple class="form-select user-form-input"
                                    style="background-color: #5A5A5A;">
                                    <option selected>اشر على الخيارات</option>
                                    <?php foreach ($products as $product): ?>
                                        <option value="<?php echo $product->get_id(); ?>">
                                            <?php echo $product->get_name(); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <h5 class="text-white mt-4">شراء المنتجات مع</h5>
                        <div class="product-edit-page form-box mt-2">
                            <label for="formFileLg" class="user-form-label mb-2">البحث عن المنتجات</label>
                            <div class="data-select  edit-drop full-drop mb-3">
                                <i class="fa fa-chevron-down me-5"
                                    style="font-size: 12px; color:rgba(255, 255, 255, 1);"></i>
                                <?php
                                $products = wc_get_products(array('status' => 'publish'));
                                ?>
                                <select multiple name="buy_with_products[]" id="inputrole"
                                    class="form-select user-form-input" style="background-color: #5A5A5A;">
                                    <option selected>ابحث عن منتج</option>
                                    <?php foreach ($products as $product): ?>
                                        <option value="<?php echo $product->get_id(); ?>">
                                            <?php echo $product->get_name(); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="top-dropdown mt-3">
                    <button type="submit" class="simple-btn px-5">يحفظ</button>
                </div>
            </div>
        </div>

        <!-- Modal Start-->
        <div class="modal-sec">
            <div class="modal fade" id="varients" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header border-0">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                                    class="bi bi-x product-close"></i></button>
                        </div>
                        <div class="modal-body mt-3">
                            <div class="modal-left-content">
                                <div class="mod-title mb-3">
                                    <span style="font-size: 25px;">صفات</span>
                                </div>

                                <div class="row row-cols-lg-12">
                                    <div class="col-12 col-sm-5 col-md-5 col-lg-5">
                                        <label for="formFileLg" class="user-form-label mb-2">اسم السمة</label>
                                        <div class="data-select position-relative edit-drop full-drop mb-3 num-drop"
                                            style="border-radius: 5px;">
                                            <i class="fa fa-chevron-down"
                                                style="font-size: 12px; color:rgba(255, 255, 255, 1);"></i>
                                            <?php $product_attributes = wc_get_attribute_taxonomies();
                                            ?>
                                            <select id="attr_name" name="attr_name"
                                                class="my-select2  form-select user-form-input"
                                                style="background-color: #5A5A5A; border: 2px solid rgba(143, 56, 243, 1); border-radius: 5px; z-index: 1px;">
                                                <option value=""></option>
                                                <?php foreach ($product_attributes as $attr): ?>
                                                    <option value="pa_<?= $attr->attribute_name; ?>">
                                                        <?= esc_html($attr->attribute_label); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-5 col-md-5 col-lg-5">
                                        <label for="formFileLg" class="user-form-label mb-2">قيم</label>
                                        <div class="data-select position-relative edit-drop full-drop mb-3  num-drop"
                                            style="border-radius: 5px; width: 100% !important;" dir="rtl">
                                            <i class="fa fa-chevron-down"
                                                style="font-size: 12px; color:rgba(255, 255, 255, 1); z-index: 1;"></i>
                                            <select class=" form-select user-form-input my-select2" multiple
                                                id="attr_values" name="attr_values" aria-label="Default select example"
                                                data-live-search="true">

                                            </select>
                                        </div>

                                    </div>
                                </div>
                                <div class="top-dropdown mt-3 d-flex gap-3">
                                    <button onclick="addRow()" type="button"
                                        class="btn-primary add-row simple-btn px-4 mt-4 ms-5"
                                        style="background: none; border: 2px solid rgba(143, 56, 243, 1);">إضافة نوع
                                        جديد</button>

                                    <button type="button" id="save_attr"
                                        class="btn-primary save-btn simple-btn px-4 mt-4">يحفظ</button>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal end -->

    </form>
</div>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script> -->
<script>


    jQuery(document).ready(function ($) {



        $('#imageInput').on('change', function () {
            if (this.files.length > 10) {
                alert('You can only upload a maximum of 10 images.');
                $(this).val('');
            }
        });


        // var attr_name;
        // new TomSelect('#attr_name', {
        //     persist: false,
        //     createOnBlur: true,
        //     create: true,
        //     onOptionAdd: function (value, $item) {
        //         console.log('New item added:', value);
        //         attr_name = value;
        //     }
        // });

        $('#product-type').change(function () {
            var productType = $(this).val();
            // alert(productType);
            if (productType === "variable") {
                $('#variation_data').show();
                $('#price').hide();
            }
            else {
                $('#variation_data').hide();
                $('#price').show();
            }
        });





        //media uploaded

        $("#main_image_product").click(function (e) {
            e.preventDefault();

            // Create a new media uploader instance
            var mediaUploader = wp.media({
                title: "Select Images", // Popup title
                button: {
                    text: "Select", // Button text
                },
                multiple: false, // Allow multiple image selection
            });

            // When images are selected, get the selected images and do something with them
            mediaUploader.on("select", function () {
                var attachment = mediaUploader.state().get("selection").toJSON();



                console.log(attachment[0].url); // Output selected images data to console
                $('#main_image').val(attachment[0].url);
                $('#p_image_container').attr('src', attachment[0].url);
                // // Process selected images (e.g., display them on the page)
                // if (attachments.length > 0) {
                //     attachments.forEach(function (attachment) {
                //         // Process each selected image (e.g., display it on the page)
                //         console.log(attachment.url); // Output image URL to console
                //     });
                // }
            });

            // Open the media uploader popup
            mediaUploader.open();
        });

        $('#clear_img').click(function () {
            $('#p_image_container').attr('src', '<?php echo $plugin_url ?>includes/assets/img/placeholder.jpg');
            $('#main_image').val('');
        })

    });
</script>


<?php

include_once $plugin_path . 'page-templates/layout/sidebar.php';
include_once $plugin_path . 'page-templates/layout/footer.php';

ob_end_flush();

?>