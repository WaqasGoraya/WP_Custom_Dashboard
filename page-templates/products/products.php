<?php

include_once $plugin_path . 'page-templates/layout/header.php';


$args = array(
    'post_type' => 'product',
    'posts_per_page' => -1 // Retrieve all products
);

$products = new WP_Query($args);


wp_reset_postdata();

?>




<div class="content">
    <div class="top-inner-page-btn">
        <span class="umala-head">منتجات</span>
        <button class="text-white">اضف جديد &nbsp; +</button>
        <button class="text-white">يستورد &nbsp;</button>
        <button class="text-white">يصدّر &nbsp;</button>
    </div>
    <div class="d-flex align-items-center justify-content-between mt-4 flex-wrap">
        <div class="dropdown">
            <button class="btn btn-drop dropdown-toggle text-white" dir="rtl" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">فرز
                نشرت 10
                الكل 23<i class="fa fa-chevron-down me-2" style="font-size: 12px; color: #8F38F3;"></i></button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
            </ul>
        </div>
        <div class="top-search">
            <input type="search" class="form-control" placeholder="ابحث هنا...">
            <i class="bi bi-search"></i>
        </div>
    </div>
    <div class="drop-main d-flex align-items-center justify-content-between mt-4 flex-wrap">
        <div class="top-dropdown d-flex align-items-center gap-2 flex-wrap">
            <div class="dropdown">
                <button class="btn btn-drop dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-chevron-down ms-2" style="font-size: 12px; color: white;"></i>العمل بالجملة</button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                </ul>
            </div>
            <button class="simple-btn">يتقدم</button>
        </div>
        <div class="d-flex flex-wrap">
            <div class="top-dropdown">
                <div class="dropdown">
                    <button class="btn btn-drop dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"> <i class="fa fa-chevron-down ms-2" style="font-size: 12px; color: white;"></i>حدد العلامة</button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                    </ul>
                </div>
            </div>

            &nbsp; &nbsp;
            <div class="top-dropdown">
                <div class="dropdown">
                    <button class="btn btn-drop dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"> <i class="fa fa-chevron-down ms-2" style="font-size: 12px; color: white;"></i>اختر الفئة</button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                    </ul>
                </div>
            </div>
            &nbsp; &nbsp;
            <div class="top-dropdown">
                <div class="dropdown">
                    <button class="btn btn-drop dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"> <i class="fa fa-chevron-down ms-2" style="font-size: 12px; color: white;"></i>وضع مخزون</button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                    </ul>
                </div>
            </div>
            &nbsp; &nbsp;
            <div class="top-dropdown">
                <button class="simple-btn">يتقدم</button>
            </div>

        </div>
    </div>



    <!-- Table Start -->
    <div class="pt-4 product-page">
        <div class="sales-chart-bg px-4">
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr class="first-row">
                            <th scope="col" class="text-end pe-2" dir="ltr">اسم المنتج
                                <img class="isam-image ms-2" src="<?php echo $plugin_url ?>includes/assets/img/product-gallery-img.png" style="width: 30px; height: 30px;" alt="">
                                <input class="form-check-input" style="margin-top: 2px;" type="checkbox" value="" id="flexCheckDefault">
                            </th>
                            <th scope="col">SKU</th>
                            <th scope="col">مخزون</th>
                            <th scope="col">سعر</th>
                            <th scope="col">فئات</th>
                            <th scope="col">تاريخ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products->posts as $product) :
                            $title = $product->post_title;
                            $category = get_the_terms($product->ID, "product_cat");
                            $tags = get_the_terms($product->ID, 'product_tag');
                            $categories = get_the_terms($product->ID, 'product_cat');

                            // Get the featured image ID
                            $image_id = get_post_thumbnail_id($product->ID);



                            // Get the image URL
                            $image_url = wp_get_attachment_image_src($image_id, 'full');
                            // echo '<pre>';
                            // print_r($image_url[0]);
                            // die();
                            // Get the product object
                            $product_obj = wc_get_product($product->ID);

                            // Check if the product object exists
                            if ($product_obj) {
                                $sku = $product_obj->get_sku();
                                $stock_quantity = $product_obj->get_stock_quantity();
                                $price = $product_obj->get_price();
                            } else {
                                $sku = '';
                                $stock_quantity = '';
                                $price = '';
                            }
                            // echo '<pre>';
                            // print_r($product);
                            // die();
                        ?>
                            <tr class="text-white">
                                <td class="text-end" dir="ltr"><?= $title ?>
                                    <a href="<?php echo home_url('/admin/products/edit-product/?product_id=' . $product->ID); ?>">
                                        <img class="isam-image ms-2" src="<?= $image_url[0]; ?>" alt="">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                    </a>

                                </td>
                                <td><?= $sku ?></td>
                                <td>في الأوراق المالية</td>
                                <td>$<?= $price ?></td>
                                <td><?php foreach ($categories as $key => $cat) { ?>
                                        <span class=""><?= $cat->name ?></span>
                                    <?php  } ?>
                                </td>
                                <td>22-02-2023</td>
                            </tr>

                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Table End -->

    <div class="drop-main d-flex align-items-baseline justify-content-between mt-4 flex-wrap">
        <div class="top-dropdown d-flex align-items-center gap-2 flex-wrap">
            <div class="dropdown">
                <button class="btn btn-drop dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-chevron-down ms-2" style="font-size: 12px; color: white;"></i>العمل بالجملة</button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                </ul>
            </div>
            <button class="simple-btn">يتقدم</button>
        </div>
        <div class="product-left-btn d-flex align-items-center gap-4">
            <span class="text-white"><a href="#"> <img class="ms-2" src="./img/right-arrow.png" alt=""></a> التالي</span>
            <span class="mubmering text-white">01</span>
            <span class="text-white">سابق <a href="#"><img class="me-2" src="./img/left-arrow.png" alt=""></a> </span>

        </div>
    </div>


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


<?php


include_once $plugin_path . 'page-templates/layout/sidebar.php';
include_once $plugin_path . 'page-templates/layout/footer.php';

?>