<?php
// Enqueue styles for frontend pages

add_action('wp_enqueue_scripts', 'enqueue_frontend_styles');
function enqueue_frontend_styles()
{
    // Enqueue your CSS stylesheet
    wp_enqueue_style('chart', plugins_url('assets/css/apexcharts.css', __FILE__), array(), '1.0.0', 'all');

    wp_enqueue_style('bootstrap', plugins_url('assets/css/bootstrap.min.css', __FILE__), array(), '1.0.0', 'all');

    wp_enqueue_style('custom-css', plugins_url('assets/css/style.css', __FILE__), array(), '1.0.0', 'all');

    wp_enqueue_style('select2', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css', array());
    // Enqueue your JavaScript file

    wp_enqueue_media(); // Enqueue WordPress media scripts

    wp_enqueue_script('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js', array('jquery'), '1.0.0', true);

    wp_enqueue_script('select2', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js', array('jquery'), '1.0.0', true);

    wp_enqueue_script('chart', 'https://cdn.jsdelivr.net/npm/chart.js', array('jquery'), '1.0.0', true);

    wp_enqueue_script('custom-chart', plugins_url('assets/js/apexcharts.js', __FILE__), array('jquery'), '1.0.0', true);

    wp_enqueue_script('main', plugins_url('assets/js/main.js', __FILE__), array('jquery'), '1.0.0', true);

    wp_enqueue_script('custom-attributes-script', plugins_url('assets/js/custom_attribute.js', __FILE__), array('jquery'), '1.0.0', true);

    // Localize script with AJAX URL
    wp_localize_script('custom-attributes-script', 'custom_attributes_ajax_object', array('ajaxurl' => admin_url('admin-ajax.php')));

    wp_enqueue_script('custom-scripts', plugins_url('assets/js/custom-scripts.js', __FILE__), array('jquery'), '1.0.0', true);
    wp_localize_script('custom-scripts', 'custom_ajax_object', array('ajaxurl' => admin_url('admin-ajax.php')));


}

