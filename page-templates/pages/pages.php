<?php
include_once $plugin_path . 'page-templates/layout/header.php';
?>
<!-- Content Start -->
<div class="content pt-0 mobile-p">
    <div class="top-inner-page-btn d-flex align-items-center gap-3 mt-3 flex-wrap">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="22" viewBox="0 0 20 22" fill="none">
            <path d="M5 1H14.5L19 5.5V18" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M1 19.5V5.5C1 5.10218 1.15804 4.72064 1.43934 4.43934C1.72064 4.15804 2.10218 4 2.5 4H12.252C12.4111 4.00014 12.5636 4.06345 12.676 4.176L15.824 7.324C15.88 7.3799 15.9243 7.44632 15.9545 7.51943C15.9847 7.59254 16.0002 7.6709 16 7.75V19.5C16 19.8978 15.842 20.2794 15.5607 20.5607C15.2794 20.842 14.8978 21 14.5 21H2.5C2.10218 21 1.72064 20.842 1.43934 20.5607C1.15804 20.2794 1 19.8978 1 19.5Z" fill="white" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M12 4V7.4C12 7.55913 12.0632 7.71174 12.1757 7.82426C12.2883 7.93679 12.4409 8 12.6 8H16" fill="white" />
            <path d="M12 4V7.4C12 7.55913 12.0632 7.71174 12.1757 7.82426C12.2883 7.93679 12.4409 8 12.6 8H16" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
        <span class="umala-head">الصفحات </span>
        <button class="simple-btn">درخواست دیں</button>
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
        <span class="days-sec text-white">13 مادة</span>
    </div>

    <!-- Table Start -->

    <div class="pt-4 coupon-page pages">
        <div class="sales-chart-bg">
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th class="text-end" dir="ltr">عنوان
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            </th>
                            <!-- <th scope="col">شفرة</th> -->
                            <th scope="col">مؤلف</th>
                            <th scope="col">پیغام</th>
                            <th scope="col">تاریخ</th>
                            <th scope="col">صفحہ ٹیمپلیٹ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="background: #20191B;">
                            <td class="text-end" dir="ltr">Lorem Ipsum
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            </td>
                            <td>Sameed Ali</td>
                            <td>پیغام</td>
                            <td>25/07/2024
                                Published</td>
                            <td>Sitemap page</td>
                        </tr>
                        <tr>
                            <td class="text-end" dir="ltr">Lorem Ipsum
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            </td>
                            <td>Sameed Ali</td>
                            <td>پیغام</td>
                            <td>25/07/2024
                                Published</td>
                            <td>Sitemap page</td>
                        </tr>
                        <tr style="background: #20191B;">
                            <td class="text-end" dir="ltr">Lorem Ipsum
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            </td>
                            <td>Sameed Ali</td>
                            <td>پیغام</td>
                            <td>25/07/2024
                                Published</td>
                            <td>Sitemap page</td>
                        </tr>
                        <tr>
                            <td class="text-end" dir="ltr">Lorem Ipsum
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            </td>
                            <td>Sameed Ali</td>
                            <td>پیغام</td>
                            <td>25/07/2024
                                Published</td>
                            <td>Sitemap page</td>
                        </tr>
                        <tr style="background: #20191B;">
                            <td class="text-end" dir="ltr">Lorem Ipsum
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            </td>
                            <td>Sameed Ali</td>
                            <td>پیغام</td>
                            <td>25/07/2024
                                Published</td>
                            <td>Sitemap page</td>
                        </tr>
                        <tr>
                            <td class="text-end" dir="ltr">Lorem Ipsum
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            </td>
                            <td>Sameed Ali</td>
                            <td>پیغام</td>
                            <td>25/07/2024
                                Published</td>
                            <td>Sitemap page</td>
                        </tr>
                        <tr style="background: #20191B;">
                            <td class="text-end" dir="ltr">Lorem Ipsum
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            </td>
                            <td>Sameed Ali</td>
                            <td>پیغام</td>
                            <td>25/07/2024
                                Published</td>
                            <td>Sitemap page</td>
                        </tr>
                        <tr>
                            <td class="text-end" dir="ltr">Lorem Ipsum
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            </td>
                            <td>Sameed Ali</td>
                            <td>پیغام</td>
                            <td>25/07/2024
                                Published</td>
                            <td>Sitemap page</td>
                        </tr>
                        <tr style="background: #20191B;">
                            <td class="text-end" dir="ltr">Lorem Ipsum
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            </td>
                            <td>Sameed Ali</td>
                            <td>پیغام</td>
                            <td>25/07/2024
                                Published</td>
                            <td>Sitemap page</td>
                        </tr>
                        <tr>
                            <td class="text-end" dir="ltr">Lorem Ipsum
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            </td>
                            <td>Sameed Ali</td>
                            <td>پیغام</td>
                            <td>25/07/2024
                                Published</td>
                            <td>Sitemap page</td>
                        </tr>
                        <tr style="background: #20191B;">
                            <td class="text-end" dir="ltr">Lorem Ipsum
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            </td>
                            <td>Sameed Ali</td>
                            <td>پیغام</td>
                            <td>25/07/2024
                                Published</td>
                            <td>Sitemap page</td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Table End -->

    <div class="drop-main d-flex align-items-center mt-4 gap-5 flex-wrap text-white">
        <div class="drop-main d-flex align-items-center gap-3 flex-wrap">
            <a href="#"><img src="./img/right-arrow.png" alt=""></a>
            <span>Next</span>
        </div>
        <div class="drop-main d-flex align-items-center gap-3 flex-wrap">
            <a href="#"><img src="./img/left-arrow.png" alt=""></a>
            <span>Back</span>
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
<!-- Content End -->

<?php

include_once $plugin_path . 'page-templates/layout/sidebar.php';
include_once $plugin_path . 'page-templates/layout/footer.php';

?>