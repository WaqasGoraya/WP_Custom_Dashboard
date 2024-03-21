<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Favicon -->
    <link href="<?php echo $plugin_url ?>includes/assets/img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <?php wp_head(); ?>
</head>

<body>
    <?php
    $img =  get_avatar(get_current_user_id(), 150);
    $current_user = wp_get_current_user();

    // Get profile picture attachment ID
    $profile_picture_id = get_user_meta($current_user->ID, 'profile_picture', true);

    // Get the profile picture URL
    $profile_picture_url = wp_get_attachment_url($profile_picture_id);
    // echo "<pre>";
    // print_r($profile_picture_url); 
    // exit;
    ?>
    <div class="position-relative bg-container d-flex p-0">
        <!-- Content Start -->

        <div class="content">
            <!-- Navbar Start -->
            <div class="px-lg-4">
                <nav class="navbar navbar-expand bg-navbar flex-wrap justify-content-center justify-content-lg-end navbar-light px-lg-4 py-3 gap-1">
                    <div class="navbar-nav flex-wrap align-items-center gap-3">
                        <div class="nav-item d-flex gap-3">
                            <span class="d-flex">
                                <div class="info">
                                    <p class="mb-0 p-name"><?php echo $current_user->display_name; ?></p>
                                    <p class="p-email"><?php echo $current_user->user_email; ?></p>
                                </div>
                                <div class="profile">
                                    <img class="rounded-circle me-lg-2" src="<?php echo $profile_picture_url; ?>" alt="" style="width: 40px; height: 40px; cursor: pointer;">
                                    <div class="profile-menu">
                                        <div class="main-header-profile bg-menu p-2">
                                            <div class="d-flex wd-100p gap-3">
                                                <div class="main-img-user">
                                                    <img alt="user_profile" src="<?php echo $profile_picture_url; ?>">
                                                </div>
                                                <div class="ms-3 my-auto main-user-info">
                                                    <h6 class="title"><?php echo $current_user->display_name; ?></h6>
                                                    <!-- <span class="subtitle">قسط الأعضاء </span> -->
                                                </div>
                                            </div>
                                        </div>
                                        <a class="dropdown-item" href="#"><i class="fas fa-cog ms-2"></i> تعديل الملف الشخصي </a>
                                        <a class="dropdown-item" href="<?php echo wp_logout_url(); ?>"><i class="fas fa-sign-out-alt ms-2"></i> خروج</a>
                                    </div>
                                </div>
                            </span>
                        </div>
                    </div>
                </nav>
            </div>
            <!-- Navbar End -->