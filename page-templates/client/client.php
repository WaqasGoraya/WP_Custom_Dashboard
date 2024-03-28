<?php
include_once $plugin_path . 'page-templates/layout/header.php';

$customers = get_users(array('role' => 'customer'));

?>

<!-- Content Start -->
<div class="content">
    <div class="top-inner-page-btn">
        <span class="umala-head">عملاء</span>
        <!-- <button>اضف جديد &nbsp; +</button> -->
    </div>
    <div class="d-flex align-items-center justify-content-between mt-4 flex-wrap">
        <div class="dropdown">
            <button class="btn btn-drop dropdown-toggle text-white" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"> إجمالي العملاء (<?php echo count($customers); ?>)</button>
        </div>
        <button id="exportCustomersButton">Export Customers</button>
        <div class="top-search">
            <!-- <form id="customerSearchForm"> -->
            <input type="search" class="form-control" placeholder="ابحث هنا..." id="customerSearchInput">
            <i class="bi bi-search"></i>

            <!-- </form> -->
        </div>
    </div>
    <!-- Table Start -->
    <div class="pt-4 umala-page">
        <div class="sales-chart-bg px-3">
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr class="first-row">
                            <th scope="col">اسم العميل</th>
                            <th scope="col">بريد إلكتروني</th>
                            <th scope="col">إجمالي الإنفاق</th>
                            <th scope="col">آخر نشاط </th>
                            <th scope="col">طلبات</th>
                        </tr>
                    </thead>
                    <tbody id="customerSearchResults">
                        <?php
                        if ($customers) :
                            foreach ($customers as $customer) :

                                $spent = wc_get_customer_total_spent($customer->ID);
                                $order_count = wc_get_customer_order_count($customer->ID);

                                $last_active = get_user_meta($customer->ID, 'wc_last_active', true);
                                $last_date = date('M d,Y', $last_active);
                        ?>
                                <tr>
                                    <td class="text-end" dir="ltr"><?= $customer->display_name; ?></td>
                                    <td class="email-sec"><?= $customer->user_email; ?></td>
                                    <td class="ejmali"><?= $spent; ?> <?= get_woocommerce_currency_symbol(); ?></td>
                                    <td> <?= $last_date; ?></td>
                                    <td class="talab"><?= $order_count; ?></td>
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

    <!-- <div class="drop-main d-flex align-items-center justify-content-between mt-4 flex-wrap">
        <span class="days-sec text-white">30 بند</span>
    </div> -->
</div>
<!-- Content End -->
<?php

include_once $plugin_path . 'page-templates/layout/sidebar.php';
include_once $plugin_path . 'page-templates/layout/footer.php';

?>