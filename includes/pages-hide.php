<?php

// Hide Pages
// add_action('pre_get_posts', 'custom_hide_pages_from_subsite_admin');

// function custom_hide_pages_from_subsite_admin($query)
// {
//     global $pagenow;

//     if (is_admin() && $pagenow === 'edit.php' && isset($_GET['post_type']) && $_GET['post_type'] === 'page') {
//         // Array of page slugs to hide
//         $pages_to_hide_slugs = array('admin', 'admin/themes', 'admin/users', 'admin/users/edit-user', 'admin/users/view-user', 'admin/products', 'admin/products/edit-product', 'admin/clients', 'admin/request', 'admin/coupon', 'admin/setting', 'admin/support', 'admin/analytics', 'admin/pages',);

//         // Initialize an empty array to store page IDs
//         $pages_to_hide_ids = array();

//         // Loop through each slug to get the corresponding page ID
//         foreach ($pages_to_hide_slugs as $slug) {
//             $page = get_page_by_path($slug);
//             if ($page) {
//                 $pages_to_hide_ids[] = $page->ID;
//             }
//         }

//         // Set the 'post__not_in' parameter in the query to exclude the specified page IDs
//         if (!empty($pages_to_hide_ids)) {
//             $query->set('post__not_in', $pages_to_hide_ids);
//         }
//     }
// }
