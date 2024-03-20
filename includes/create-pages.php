<?php
add_action('init', 'create_dashboard_pages_for_existing_sites');

function create_dashboard_pages_for_existing_sites()
{
    // Check if the pages are already created
    if (!get_option('dashboard_pages_created')) {

        // Define an array of pages with their titles, slugs, and parent slugs
        $pages = array(
            array(
                'title' => 'Admin Dashboard',
                'slug' => 'admin',
                'parent_slug' => '', // No parent
            ),
            array(
                'title' => 'Themes',
                'slug' => 'themes',
                'parent_slug' => 'admin',
            ),
            array(
                'title' => 'Users',
                'slug' => 'users',
                'parent_slug' => 'admin',
            ),
            array(
                'title' => 'Edit User',
                'slug' => 'edit-user',
                'parent_slug' => 'admin/users',
            ),
            array(
                'title' => 'View User',
                'slug' => 'view-user',
                'parent_slug' => 'admin/users',
            ),
        );

        // Loop through the pages array and create each page
        foreach ($pages as $page_data) {
            $page_args = array(
                'post_title' => $page_data['title'],
                'post_name' => $page_data['slug'],
                'post_content' => '', // Add your content if needed
                'post_status' => 'private',
                'post_type' => 'page',
            );

            // Check if the parent slug is specified
            if (!empty($page_data['parent_slug'])) {
                // Get the parent page ID using the parent slug
                $parent_page = get_page_by_path($page_data['parent_slug']);
                if ($parent_page) {
                    // Set the parent page ID
                    $page_args['post_parent'] = $parent_page->ID;
                }
            }

            // Insert the page
            $page_id = wp_insert_post($page_args);

            if (!is_wp_error($page_id)) {
                // Page created successfully
            }
        }

        // Mark pages as created
        update_option('dashboard_pages_created', true);
    }
}
