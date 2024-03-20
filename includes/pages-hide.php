<?php

// Hide Pages
// add_action('pre_get_posts', 'custom_hide_pages_from_subsite_admin');

// function custom_hide_pages_from_subsite_admin($query)
// {
// 	global $pagenow;

// 	if (is_admin() && $pagenow === 'edit.php' && isset($_GET['post_type']) && $_GET['post_type'] === 'page') {
// 		$query->set('post__not_in', array(9)); // Replace 1, 2, 3 with the IDs of the pages you want to hide
// 	}
// }
// Hide Pages
// add_action('pre_get_posts', 'custom_hide_pages_from_subsite_admin');

// function custom_hide_pages_from_subsite_admin($query)
// {
// 	global $pagenow;

// 	if (is_admin() && $pagenow === 'edit.php' && isset($_GET['post_type']) && $_GET['post_type'] === 'page') {
// 		$query->set('post__not_in', array(9)); // Replace 1, 2, 3 with the IDs of the pages you want to hide
// 	}
// }
