<?php

include_once $plugin_path . 'page-templates/layout/header.php';

?>
<!-- Graph Start -->
<div class="container-fluid line-container pt-4 px-lg-4 stats">
    <div class="row g-4">
        <div class="col-md-12">
            <div class="stat-card">
                <div class="d-flex align-items-center justify-content-between line-chart-box">
                    <div class="chartBox">
                        <canvas id="line-chart"></canvas>
                    </div>
                </div>
                <div class="row gy-3 align-items-center graph-border mt-lg-3">
                    <div class="col-md-6">
                        <div class="d-flex flex-column flex-md-row gap-3">
                            <div class="dropdown">
                                <button class="btn btn-drop dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"> اختر الشهر </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                </ul>
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-drop dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"> لمدة شهر </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex justify-content-between">
                            <div class="graph-content">
                                <span class="purple-dot"></span>
                                <span class="graph-label">ربح</span>
                            </div>
                            <div class="graph-content">
                                <span class="red-dot"></span>
                                <span class="graph-label">خسارة</span>
                            </div>
                            <div class="graph-content">
                                <span class="yellow-dot"></span>
                                <span class="graph-label">أُوكَازيُون</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Graph End -->

<!-- Sales Chart Start -->
<div class="container-fluid pt-4 px-md-4">
    <div class="row gy-4">
        <div class="col-lg-6">
            <div class="row gy-4">
                <div class="col-md-6 d-flex">
                    <div class="sales-chart-bg p-3 flex-grow-1">
                        <div class="d-flex align-items-center justify-content-between mb-5">
                            <h6 class="mb-0 text-stat">عدد العملاء :</h6>
                            <img src="<?php echo $plugin_url ?>includes/assets/img/user-group.png" alt="icon" class="img-icon">
                        </div>
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="bar-chart-text">40k</p>
                                <div class="d-flex align-items-center mt-3">
                                    <div class="box-one text-center ps-2">
                                        <p class="bar-chart-sub">نجح الشراء</p>
                                        <span class="dot-one"></span>
                                    </div>
                                    <div class="box-two text-center border-e pe-2">
                                        <p class="bar-chart-sub">لم يتم شراؤها</p>
                                        <span class="dot-two"></span>
                                    </div>
                                </div>
                            </div>
                            <canvas id="bar-chart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 d-flex">
                    <div class="sales-chart-bg p-3 flex-grow-1">
                        <div class="d-flex align-items-center justify-content-between mb-5">
                            <h6 class="mb-0 text-stat">الربح المتوقع</h6>
                            <img src="<?php echo $plugin_url ?>includes/assets/img/icon-green.png" alt="icon" class="img-icon">
                        </div>
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="bar-chart-subtext">يعالج</p>
                                <p class="bar-chart-subtext">في الانتظار</p>
                                <p class="bar-chart-subtext">دفعات مؤجلة</p>
                            </div>
                            <canvas id="doughnut-chart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="sales-chart-bg">
                        <div class="d-flex align-items-center justify-content-between mb-5 p-3">
                            <h6 class="mb-0 text-stat">متوسط قيمة الطلب</h6>
                            <img src="<?php echo $plugin_url ?>includes/assets/img/icon-red.png" alt="icon" class="img-icon">
                        </div>
                        <div class="px-4 d-flex align-items-center gap-1">
                            <span class="text-white">أعلى</span>
                            <img src="<?php echo $plugin_url ?>includes/assets/img/icon-upward.png" alt="icon" class="img-fluid">
                        </div>
                        <div id="spark6"></div>
                    </div>
                </div>
                <div class="col-md-6 d-flex">
                    <div class="sales-chart-bg p-3 w-100">
                        <div class="d-flex align-items-center justify-content-between mb-5">
                            <h6 class="mb-0 text-stat">إجمالي الطلبات</h6>
                            <img src="<?php echo $plugin_url ?>includes/assets/img/icon-yellow.png" alt="icon" class="img-icon">
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <img src="<?php echo $plugin_url ?>includes/assets/img/icon-eye.png" alt="icon" class="img-fluid">
                            <span class="text-white">طلبات 200</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 d-flex">
            <div class="sales-chart-bg rounded p-3 w-100">
                <div class="d-flex align-items-center justify-content-between">
                    <h6 class="mb-0 text-stat">
                        <div class="dropdown char-dropdown">
                            <button class="btn btn-drop dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">30 days</button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                            </ul>
                        </div>
                    </h6>
                    <h6 class="mb-0 text-stat">مبيعات</h6>
                </div>
                <div id="chart"></div>
            </div>
        </div>
    </div>
</div>
<!-- Sales Chart End -->

<!-- Table Start -->
<div class="container-fluid pt-4 px-md-4">
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
        <div class="col-lg-5 d-flex">
            <div class="sales-chart-bg d-flex flex-column justify-content-between p-3 w-100">
                <h6 class="mb-0 text-stat">Weekly Sales</h6>
                <canvas id="weekly-updates" class="mt-5"></canvas>
            </div>
        </div>
    </div>
</div>
<!-- Table End -->

<!-- Radial Chart Start -->
<div class="container-fluid pt-4 px-md-4">
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

<?php


include_once $plugin_path . 'page-templates/layout/sidebar.php';
include_once $plugin_path . 'page-templates/layout/footer.php';

?>