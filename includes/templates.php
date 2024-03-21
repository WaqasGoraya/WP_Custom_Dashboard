<?php

// Assign Templates 
add_filter('page_template', 'custom_template_plugin_page_template', 10, 1);

function custom_template_plugin_page_template($template)
{
    // Get the slug of the current page
    $current_page_slug = get_post_field('post_name', get_post());

    // Define an array of page slugs and their corresponding templates
    $custom_templates = array(
        'admin' => 'custom-dashboard.php',
        'users' => 'users/users.php',
        'themes' => 'themes/themes.php',
        'edit-user' => 'users/edit-user.php',
        'view-user' => 'users/view-user.php',

        //clinet 
        'client' => 'client/client.php',

        //products
        'products' => 'products/products.php',
        'edit-product' => 'products/edit-product.php',

        //setting
        'setting' => 'setting/setting.php',

        //pages
        'pages' => 'pages/pages.php',

        //request
        'request' => 'request/request.php',

        //support
        'support' => 'support/support.php',

        //coupon
        'coupon' => 'coupon/coupon.php',

        //analytics
        'analytics' => 'analytics/analytics.php',

    );

    // Check if the current page slug is in the custom_templates array
    if (array_key_exists($current_page_slug, $custom_templates)) {
        // Set the template path based on the custom_templates array
        $template = DASHBOARD_PLUGIN  . 'page-templates/' . $custom_templates[$current_page_slug];
    }

    return $template;
}
