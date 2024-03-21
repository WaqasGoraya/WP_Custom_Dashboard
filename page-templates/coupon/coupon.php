<?php
include_once $plugin_path . 'page-templates/layout/header.php';
?>
<!-- Content Start -->
<div class="content">
    <div class="top-inner-page-btn">
        <span class="umala-head">كوبونات </span>
        <button>أضف عرض&nbsp; +</button>
    </div>
    <div class="d-flex align-items-center justify-content-between mt-4 flex-wrap">
        <div class="d-flex gap-4 text-white">
            <span>الكل(2)</span>
            <span style="color:#782C96;">|</span>
            <span> نشرت(2)</span>
        </div>
        <div class="top-search">
            <input type="search" class="form-control" placeholder="صفحات البحث">
            <i class="bi bi-search"></i>
        </div>
    </div>
    <div class="drop-main d-flex align-items-center justify-content-between mt-4 flex-wrap">
        <div class="top-dropdown d-flex align-items-center gap-2 flex-wrap">
            <div class="dropdown">
                <button class="btn btn-drop dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-chevron-down ms-2" style="font-size: 12px; color: white;"></i>إجراءات جملة</button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                </ul>
            </div>
            <button class="simple-btn">درخواست دیں</button>
            &nbsp; &nbsp;
            <div class="dropdown">
                <button class="btn btn-drop dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"> <i class="fa fa-chevron-down ms-2" style="font-size: 12px; color: white;"></i>إظهار جميع الأنواع</button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                </ul>
            </div>
            <button class="simple-btn">فلٹر</button>
        </div>
        <span class="days-sec text-white">2 بند</span>
    </div>







    <!-- Table Start -->

    <div class="pt-4 coupon-page">
        <div class="sales-chart-bg">
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th class="text-end" dir="ltr">شفرة
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            </th>
                            <!-- <th scope="col">شفرة</th> -->
                            <th scope="col">نوع القسيمة</th>
                            <th scope="col">مبلغ القسيمة</th>
                            <th scope="col">وصف</th>
                            <th scope="col">معرف المنتج</th>
                            <th scope="col">الاستخدام/الحد</th>
                            <th scope="col">تاريخ الانتهاء</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="background: #20191B;">
                            <td class="text-end" dir="ltr">Demo
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            </td>
                            <!-- <td>Demo</td> -->
                            <td>Fixed card discount</td>
                            <td>100</td>
                            <td>50% off</td>
                            <td>123</td>
                            <td>6/12</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td class="text-end" dir="ltr">Demo
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            </td>
                            <!-- <td>Demo</td> -->
                            <td>Fixed card discount</td>
                            <td>100</td>
                            <td>50% off</td>
                            <td>123</td>
                            <td>6/12</td>
                            <td>-</td>
                        </tr>

                    </tbody>
                    <thead>
                        <tr style="background: #20191B;">
                            <th class="text-end" dir="ltr">شفرة
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            </th>
                            <!-- <th scope="col">شفرة</th> -->
                            <th scope="col">نوع القسيمة</th>
                            <th scope="col">مبلغ القسيمة</th>
                            <th scope="col">وصف</th>
                            <th scope="col">معرف المنتج</th>
                            <th scope="col">الاستخدام/الحد</th>
                            <th scope="col">تاريخ الانتهاء</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <!-- Table End -->

    <div class="drop-main d-flex align-items-center justify-content-between mt-4 flex-wrap">
        <div class="top-dropdown d-flex align-items-center gap-2 flex-wrap">
            <div class="dropdown">
                <button class="btn btn-drop dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-chevron-down ms-2" style="font-size: 12px; color: white;"></i>إجراءات جملة</button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                </ul>
            </div>
            <button class="simple-btn">درخواست دیں</button>
            &nbsp; &nbsp;
            <!-- <div class="dropdown">
                        <button class="btn btn-drop dropdown-toggle" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false"> <i class="fa fa-chevron-down ms-2"
                                style="font-size: 12px; color: white;"></i>العمل بالجملة</button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                        </ul>
                    </div>
                    <button class="simple-btn">يتقدم</button> -->
        </div>
        <span class="days-sec text-white">2 بند</span>
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
<!-- Content End -->

<?php

include_once $plugin_path . 'page-templates/layout/sidebar.php';
include_once $plugin_path . 'page-templates/layout/footer.php';

?>