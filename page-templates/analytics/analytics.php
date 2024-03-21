<?php
include_once $plugin_path . 'page-templates/layout/header.php';
?>
<!-- Content Start -->
<div class="content">
    <div class="top-inner-page-btn d-flex align-items-center justify-content-between flex-wrap">
        <span class="umala-head">تحليلات الموقع :</span>
        <div class="top-dropdown d-flex align-items-center gap-2 flex-wrap">
            <div class="dropdown">
                <button class="btn btn-drop dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-chevron-down ms-2" style="font-size: 12px; color: white;"></i>المرشحات</button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                </ul>
            </div>
            <button class="simple-btn">يتقدم</button>
        </div>
    </div>

    <!-- Radial Chart Start -->
    <div class="pt-4 analytics-page">
        <div class="row">
            <div class="col-12">
                <div class="sales-chart-bg p-3 w-100">
                    <div class="row gy-4 align-items-center">
                        <div class="col-md-6">
                            <div class="d-flex flex-column flex-lg-row align-items-center justify-content-between">
                                <div class="w-50">
                                    <canvas id="doughnut-chart2"></canvas>
                                </div>
                                <div class="doughnut-content">
                                    <div class="d-flex align-items-center gap-3 mb-4">
                                        <div class="rep-line1"></div>
                                        <div>
                                            <p class="title">Google.com .Inc</p>
                                            <p class="text"> 3,124,213 الزائرين</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center gap-3 mb-4">
                                        <div class="rep-line2"></div>
                                        <div>
                                            <p class="title">Google.com .Inc</p>
                                            <p class="text"> 3,124,213 الزائرين</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="rep-line3"></div>
                                        <div>
                                            <p class="title">Google.com .Inc</p>
                                            <p class="text"> 3,124,213 الزائرين</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="border-y d-none d-md-block"></div>
                        </div>
                        <div class="col-md-5">
                            <h6 class="text-white">النسبة المئوية للمستخدم النشط</h6>
                            <div class="d-flex align-items-center gap-3 mt-5">
                                <span class="text-white">594</span>
                                <span class="text-white-2">المجموع</span>
                            </div>
                            <div class="progress progress-2">
                                <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="doughnut-content d-flex align-items-center gap-4 mt-3">
                                <div class="d-flex align-items-center gap-3 mb-4">
                                    <div class="rep-line4"></div>
                                    <div>
                                        <p class="title">غير متصل</p>
                                        <p class="text"> 394 users</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center gap-3 mb-4">
                                    <div class="rep-line5"></div>
                                    <div>
                                        <p class="title">متصل</p>
                                        <p class="text"> 179 users</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Radial Chart End -->
    <div class="analytics-page my-5">
        <div class="row gy-4">
            <div class="col-md-3">
                <div class="sales-chart-bg p-3 w-100">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h6 class="mb-0 text-stat">إجمالي الطلبات</h6>
                        <img src="./img/icon-yellow.png" alt="icon" class="img-icon">
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <img src="./img/icon-eye.png" alt="icon" class="img-fluid">
                        <span class="text-white fw-bold" style="font-size: 22px;">طلبات 200</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="sales-chart-bg px-3 pt-3">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h6 class="mb-0 text-stat">متوسط قيمة الطلب</h6>
                        <img src="./img/icon-red.png" alt="icon" class="img-icon">
                    </div>
                    <div class="px-4 d-flex align-items-center gap-1">
                        <span class="text-white">أعلى</span>
                        <img src="./img/icon-upward.png" alt="icon" class="img-fluid">
                    </div>
                    <div id="spark6"></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="sales-chart-bg px-3 pt-3 flex-grow-1">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h6 class="mb-0 text-stat">عدد العملاء :</h6>
                        <img src="./img/user-group.png" alt="icon" class="img-icon">
                    </div>
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="bar-chart-text">40k</p>
                            <div class="d-flex align-items-center mt-2">
                                <div class="box-one text-center ps-2">
                                    <p class="bar-chart-sub mb-0">نجح الشراء</p>
                                    <span class="dot-one"></span>
                                </div>
                                <div class="box-two text-center border-e pe-2">
                                    <p class="bar-chart-sub mb-0">لم يتم شراؤها</p>
                                    <span class="dot-two"></span>
                                </div>
                            </div>
                        </div>
                        <canvas id="bar-chart" style="width: 40px !; height: 100px !important;"></canvas>

                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="sales-chart-bg p-3 flex-grow-1">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h6 class="mb-0 text-stat">الربح المتوقع</h6>
                        <img src="./img/icon-green.png" alt="icon" class="img-icon">
                    </div>
                    <div style="text-align: -webkit-left;">
                        <canvas id="doughnut-chart"></canvas>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <!-- Table Start -->
    <div class="pt-4">
        <div class="row g-4">
            <div class="col-lg-7">
                <div class="sales-chart-bg p-4">
                    <h6 class="mb-4 text-white">المستخدمين المستائين : </h6>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">رقم الهوية</th>
                                    <th scope="col">اسم المستخدم</th>
                                    <th scope="col">تاريخ</th>
                                    <th scope="col">مدة</th>
                                    <th scope="col">حالة</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-sec">RZ17308</td>
                                    <td>Ali khan</td>
                                    <td>13/01/2023</td>
                                    <td>12 : 00 H</td>
                                    <td class="text-warning">نشيط</td>
                                </tr>
                                <tr>
                                    <td class="text-sec">RZ17308</td>
                                    <td>Ali khan</td>
                                    <td>13/01/2023</td>
                                    <td>12 : 00 H</td>
                                    <td class="text-success">نشيط</td>
                                </tr>
                                <tr>
                                    <td class="text-sec">RZ17308</td>
                                    <td>Ali khan</td>
                                    <td>13/01/2023</td>
                                    <td>12 : 00 H</td>
                                    <td class="text-primary">نشيط</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 d-flex analytics-page">
                <div class="sales-chart-bg d-flex flex-column justify-content-between p-3 w-100">
                    <h6 class="mb-0 text-stat">Weekly Sales</h6>
                    <canvas id="weekly-updates" class="mt-5"></canvas>
                </div>
            </div>
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