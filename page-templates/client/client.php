<?php
include_once $plugin_path . 'page-templates/layout/header.php';
?>

<!-- Content Start -->
<div class="content">
    <div class="top-inner-page-btn">
        <span class="umala-head">عملاء</span>
        <button>اضف جديد &nbsp; +</button>
    </div>
    <div class="d-flex align-items-center justify-content-between mt-4 flex-wrap">
        <div class="dropdown">
            <button class="btn btn-drop dropdown-toggle text-white" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">فرز
                الكل 23<i class="fa fa-chevron-down me-2" style="font-size: 12px; color: white;"></i></button>
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
            &nbsp; &nbsp;
            <div class="dropdown">
                <button class="btn btn-drop dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"> <i class="fa fa-chevron-down ms-2" style="font-size: 12px; color: white;"></i>العمل بالجملة</button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                </ul>
            </div>
            <button class="simple-btn">يتقدم</button>
        </div>
        <span class="days-sec text-white">30 بند</span>
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
                            <th scope="col">أخر ظهور</th>
                            <th scope="col">طلب</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td class="text-end" dir="ltr">نعيم اوزول
                                <img class="isam-image ms-2" src="./img/table-img-1.png" alt="">
                            </td>
                            <td class="email-sec">example@gmail.com</td>
                            <td class="ejmali">3856 بس</td>
                            <td>منذ 25 دقيقة</td>
                            <td class="talab">4</td>
                        </tr>

                        <tr>
                            <td class="text-end" dir="ltr">نعيم اوزول
                                <img class="isam-image ms-2" src="./img/table-img-2.png" alt="">
                            </td>
                            <td class="email-sec">example@gmail.com</td>
                            <td class="ejmali">3856 بس</td>
                            <td>منذ 25 دقيقة</td>
                            <td class="talab">4</td>
                        </tr>
                        <tr>
                            <td class="text-end" dir="ltr">نعيم اوزول
                                <img class="isam-image ms-2" src="./img/table-img-3.png" alt="">
                            </td>
                            <td class="email-sec">example@gmail.com</td>
                            <td class="ejmali">3856 بس</td>
                            <td>منذ 25 دقيقة</td>
                            <td class="talab">4</td>
                        </tr>
                        <tr>
                            <td class="text-end" dir="ltr">نعيم اوزول
                                <img class="isam-image ms-2" src="./img/table-img-4.png" alt="">
                            </td>
                            <td class="email-sec">example@gmail.com</td>
                            <td class="ejmali">3856 بس</td>
                            <td>منذ 25 دقيقة</td>
                            <td class="talab">4</td>
                        </tr>
                        <tr>
                            <td class="text-end" dir="ltr">نعيم اوزول
                                <img class="isam-image ms-2" src="./img/table-img-5.png" alt="">
                            </td>
                            <td class="email-sec">example@gmail.com</td>
                            <td class="ejmali">3856 بس</td>
                            <td>منذ 25 دقيقة</td>
                            <td class="talab">4</td>
                        </tr>
                        <tr>
                            <td class="text-end" dir="ltr">نعيم اوزول
                                <img class="isam-image ms-2" src="./img/table-img-6.png" alt="">
                            </td>
                            <td class="email-sec">example@gmail.com</td>
                            <td class="ejmali">3856 بس</td>
                            <td>منذ 25 دقيقة</td>
                            <td class="talab">4</td>
                        </tr>
                        <tr>
                            <td class="text-end" dir="ltr">نعيم اوزول
                                <img class="isam-image ms-2" src="./img/table-img-7.png" alt="">
                            </td>
                            <td class="email-sec">example@gmail.com</td>
                            <td class="ejmali">3856 بس</td>
                            <td>منذ 25 دقيقة</td>
                            <td class="talab">4</td>
                        </tr>
                        <tr>
                            <td class="text-end" dir="ltr">نعيم اوزول
                                <img class="isam-image ms-2" src="./img/table-img-8.png" alt="">
                            </td>
                            <td class="email-sec">example@gmail.com</td>
                            <td class="ejmali">3856 بس</td>
                            <td>منذ 25 دقيقة</td>
                            <td class="talab">4</td>
                        </tr>
                        <tr>
                            <td class="text-end" dir="ltr">نعيم اوزول
                                <img class="isam-image ms-2" src="./img/table-img-9.png" alt="">
                            </td>
                            <td class="email-sec">example@gmail.com</td>
                            <td class="ejmali">3856 بس</td>
                            <td>منذ 25 دقيقة</td>
                            <td class="talab">4</td>
                        </tr>
                        <tr>
                            <td class="text-end" dir="ltr">نعيم اوزول
                                <img class="isam-image ms-2" src="./img/table-img-1.png" alt="">
                            </td>
                            <td class="email-sec">example@gmail.com</td>
                            <td class="ejmali">3856 بس</td>
                            <td>منذ 25 دقيقة</td>
                            <td class="talab">4</td>
                        </tr>
                        <tr>
                            <td class="text-end" dir="ltr">نعيم اوزول
                                <img class="isam-image ms-2" src="./img/table-img-1.png" alt="">
                            </td>
                            <td class="email-sec">example@gmail.com</td>
                            <td class="ejmali">3856 بس</td>
                            <td>منذ 25 دقيقة</td>
                            <td class="talab">4</td>
                        </tr>
                        <tr>
                            <td class="text-end" dir="ltr">نعيم اوزول
                                <img class="isam-image ms-2" src="./img/table-img-1.png" alt="">
                            </td>
                            <td class="email-sec">example@gmail.com</td>
                            <td class="ejmali">3856 بس</td>
                            <td>منذ 25 دقيقة</td>
                            <td class="talab">4</td>
                        </tr>
                        <tr>
                            <td class="text-end" dir="ltr">نعيم اوزول
                                <img class="isam-image ms-2" src="./img/table-img-1.png" alt="">
                            </td>
                            <td class="email-sec">example@gmail.com</td>
                            <td class="ejmali">3856 بس</td>
                            <td>منذ 25 دقيقة</td>
                            <td class="talab">4</td>
                        </tr>
                        <tr>
                            <td class="text-end" dir="ltr">نعيم اوزول
                                <img class="isam-image ms-2" src="./img/table-img-1.png" alt="">
                            </td>
                            <td class="email-sec">example@gmail.com</td>
                            <td class="ejmali">3856 بس</td>
                            <td>منذ 25 دقيقة</td>
                            <td class="talab">4</td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Table End -->

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
            &nbsp; &nbsp;
            <div class="dropdown">
                <button class="btn btn-drop dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"> <i class="fa fa-chevron-down ms-2" style="font-size: 12px; color: white;"></i>العمل بالجملة</button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                </ul>
            </div>
            <button class="simple-btn">يتقدم</button>
        </div>
        <span class="days-sec text-white">30 بند</span>
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