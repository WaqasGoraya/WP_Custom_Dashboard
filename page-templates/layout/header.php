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
