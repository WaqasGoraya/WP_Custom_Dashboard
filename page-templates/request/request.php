<?php
include_once $plugin_path . 'page-templates/layout/header.php';
// Get all orders
$orders = wc_get_orders(array(
    'limit' => -1, // Get all orders
    'status' => array('completed', 'processing', 'on-hold', 'pending', 'cancelled', 'refunded', 'failed'), // Filter by order statuses
));

// echo"<pre>";
// print_r($orders);
// exit;
?>

<!-- Content Start -->
<div class="content">
    <div class="top-inner-page-btn">
        <span class="umala-head">الطلبات</span>
        <!-- <button class="text-white">اضف جديد &nbsp; +</button> -->
    </div>
    <div class="d-flex align-items-center justify-content-between mt-4 flex-wrap">
        <div>
        </div>
        <div class="top-search">
            <input type="search" class="form-control" placeholder="ابحث هنا...">
            <i class="bi bi-search"></i>
        </div>
    </div>

    <div>
        <div class="top-boxes">
            <div class="top-icon-box">
                <div class="align-items-center" style="display: flex; justify-content: space-between; padding-bottom:15px; vertical-align: middle;">
                    <h1 class="box-text">38</h1>
                    <img class="box-icon-img" src="<?php echo $plugin_url ?>includes/assets/img/blue-bag.png" alt="icon">
                </div>
                <div style="display: flex; vertical-align: middle; text-align: center;">
                    <span class="dot dotone"></span>
                    <h1 class="box-text">متهم</h1>
                </div>
            </div>

            <div class="top-icon-box">
                <div class="align-items-center" style="display: flex; justify-content: space-between; padding-bottom:15px; vertical-align: middle;">
                    <h1 class="box-text">45</h1>
                    <img class="box-icon-img" src="<?php echo $plugin_url ?>includes/assets/img/icon-red.png" alt="icon">
                </div>
                <div style="display: flex; vertical-align: middle; text-align: center;">
                    <span class="dot dotone" style="background-color:#F0A0A0;"></span>
                    <h1 class="box-text">ألغيت</h1>
                </div>
            </div>

            <div class="top-icon-box">
                <div class="align-items-center" style="display: flex; justify-content: space-between; padding-bottom:15px; vertical-align: middle;">
                    <h1 class="box-text">23</h1>
                    <img class="box-icon-img" src="<?php echo $plugin_url ?>includes/assets/img/user-group.png" alt="icon">
                </div>
                <div style="display: flex; vertical-align: middle; text-align: center;">
                    <span class="dot dotone" style="background-color: #9181DB;"></span>
                    <h1 class="box-text">تم الاسترجاع</h1>
                </div>
            </div>

            <div class="top-icon-box">
                <div class="align-items-center" style="display: flex; justify-content: space-between; padding-bottom:15px;">
                    <h1 class="box-text">78</h1>
                    <img class="box-icon-img" src="<?php echo $plugin_url ?>includes/assets/img/icon-green.png" alt="icon">
                </div>
                <div style="display: flex; vertical-align: middle; text-align: center;">
                    <span class="dot dotone" style="background-color: #05E771;"></span>
                    <h1 class="box-text">يجري إرجاعها</h1>
                </div>
            </div>

            <div class="top-icon-box">
                <div class="align-items-center" style="display: flex; justify-content: space-between; padding-bottom:15px; vertical-align: middle;">
                    <h1 class="box-text">0</h1>
                    <img class="box-icon-img" src="<?php echo $plugin_url ?>includes/assets/img/icon-yellow.png" alt="icon">
                </div>
                <div style="display: flex; vertical-align: middle; text-align: center;">
                    <span class="dot dotone" style="background-color: #FFA800;"></span>
                    <h1 class="box-text">طلب عرض أسعار</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="container" style="padding: 35px 0px;">
        <div class="row" style="justify-content: space-between;">

            <div class="col-md-6">
                <div class="dropdown">
                    <button class="btn btn-drop dropdown-toggle text-white" dir="rtl" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="word-spacing:10px;">فرز |
                        نشرت 10 |
                        الكل 23<i class="fa fa-chevron-down me-2" style="font-size: 12px; color: #8F38F3;"></i></button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-md-6" style="display: flex;  justify-content: flex-end; ">
                &nbsp; &nbsp;
                <div class="top-dropdown">
                    <div class="dropdown">
                        <button class="btn btn-drop dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"><img class="ms-2" src="<?php echo $plugin_url ?>includes/assets/img/drop-threeline.png" alt="">المرشحات
                            <i class="fa fa-chevron-down me-2" style="font-size: 12px; color: white;"></i>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                        </ul>
                    </div>
                </div>

                &nbsp; &nbsp;
                &nbsp; &nbsp;
                <div class="top-dropdown">
                    <div class="dropdown">
                        <button class="btn btn-drop dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"><img class="ms-2" src="<?php echo $plugin_url ?>includes/assets/img/lock-img.png" alt="">خدمات
                            <i class="fa fa-chevron-down me-2" style="font-size: 12px; color: white;"></i>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="container request-page px-4">

        <!-- <h1 class="request-heading mt-3">الطلبات</h1> -->

        <!-- Table Start -->
        <div class="pt-4 umala-page">
            <div class="sales-chart-bg px-3">
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr class="first-row">
                                <th scope="col">طلب</th>
                                <th scope="col">تاريخ</th>
                                <th scope="col">حالة</th>
                                <th scope="col">المجموع</th>
                                <th scope="col">فعل</th>
                            </tr>
                        </thead>
                        <tbody id="customerSearchResults">
                            <?php
                            if (!empty($orders)) :
                                foreach ($orders as $order) :

                                    $order_id = $order->get_id();
                                    $order_number = $order->get_order_number();
                                    $customer_name = $order->get_billing_first_name() . ' ' . $order->get_billing_last_name();
                                    $order_total = $order->get_total();
                                    $order_status = $order->get_status();
                                    $order_date = $order->get_date_created()->format('M d, Y'); // Format order date

                            ?>
                                    <tr>
                                        <td class="text-end" dir="ltr">#<?= $order_number . ' ' . $customer_name; ?></td>


                                        <td> <?= $order_date; ?></td>
                                        <td class="talab"><?= $order_status; ?></td>

                                        <td class="ejmali"><?= $order_total; ?> <?= get_woocommerce_currency_symbol(); ?></td>
                                        <td>
                                            <a href="#"><i class="bi bi-pencil-square edit"></i></a>
                                            <a href="#"><i class="bi bi-trash-fill ms-3 delete"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach;
                            else : ?>
                                <h4 style="text-align:center; color:white;">No Customer Data Available!</h4>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Table End -->

    </div>


    <div class="drop-main d-flex align-items-baseline justify-content-between mt-4 flex-wrap">
        <!-- <div class="top-dropdown d-flex align-items-center gap-2 flex-wrap">
            <div class="dropdown">
                <button class="btn btn-drop dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-chevron-down ms-2" style="font-size: 12px; color: white;"></i>العمل بالجملة</button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                </ul>
            </div>
            <button class="simple-btn">يتقدم</button>
        </div> -->
        <div class="product-left-btn d-flex align-items-center gap-4">
            <span class="text-white"><a href="#"> <img class="ms-2" src="<?php echo $plugin_url ?>includes/assets/img/right-arrow.png" alt=""></a>
                التالي</span>
            <span class="mubmering text-white">01</span>
            <span class="text-white">سابق <a href="#"><img class="me-2" src="<?php echo $plugin_url ?>includes/assets/img/left-arrow.png" alt=""></a>
            </span>

        </div>
    </div>
</div>



<!-- Content End -->
<?php

include_once $plugin_path . 'page-templates/layout/sidebar.php';
include_once $plugin_path . 'page-templates/layout/footer.php';

?>