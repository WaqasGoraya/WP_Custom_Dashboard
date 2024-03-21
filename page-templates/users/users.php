<?php

include_once $plugin_path . 'page-templates/layout/header.php';

$current_user = wp_get_current_user();

$users = get_users();

?>


<div class="content">
    <div class="top-inner-page-btn">
        <span class="umala-head">المستخدمين</span>
        <button>اضف جديد &nbsp; +</button>
    </div>
    <div class="d-flex align-items-center justify-content-between mt-4 flex-wrap">
        <div class="dropdown">
            <button class="btn btn-drop dropdown-toggle text-white" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">فرز
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
            &nbsp; &nbsp;
            <div class="dropdown">
                <button class="btn btn-drop dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"> <i class="fa fa-chevron-down ms-2" style="font-size: 12px; color: white;"></i>وضع مخزون</button>
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
    <div class="pt-4 umala-page user-page">
        <div class="sales-chart-bg px-3">
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th scope="col">اسم المستخدم</th>
                            <th scope="col">اسم</th>
                            <th scope="col">بريد إلكتروني</th>
                            <th scope="col">دور</th>
                            <th scope="col">بريد</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user) :
                            // Get profile picture attachment ID
                            $profile_picture_id = get_user_meta($user->ID, 'profile_picture', true);
                            // Get the profile picture URL
                            $profile_picture_url = wp_get_attachment_url($profile_picture_id);

                            $first_name = get_user_meta($user->ID, 'first_name', true); // Get the first name
                            $last_name = get_user_meta($user->ID, 'last_name', true); // Get the last name
                        ?>
                            <tr>
                                <a href="<?php echo home_url('/admin/users/edit-user/?user_id=' . $user->ID); ?>">
                                    <td class="text-end ejmali" dir="ltr"><?= $first_name .' '. $last_name; ?>
                                        <img class="isam-image ms-2" src="<?= $profile_picture_url; ?>" alt="">
                                    </td>
                                </a>
                                <td><?= $user->user_login ?></td>
                                <td class="email-sec"><?= $user->user_email ?></td>
                                <td><?= $current_user->roles[0] ?></td>
                                <td class="talab">4</td>
                            </tr>
                        <?php endforeach; ?>
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
                <button class="btn btn-drop dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"> <i class="fa fa-chevron-down ms-2" style="font-size: 12px; color: white;"></i>وضع مخزون</button>
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

<?php


include_once $plugin_path . 'page-templates/layout/sidebar.php';
include_once $plugin_path . 'page-templates/layout/footer.php';

?>