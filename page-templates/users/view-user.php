<?php include_once $plugin_path . 'page-templates/layout/header.php'; ?>
<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <?php
        // Get the user ID from the URL parameter
        $user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 0;

        // Check if user ID is valid
        if ($user_id > 0) {
            // Fetch user data
            $user_data = get_userdata($user_id);
            if ($user_data) {
                // Display user data
                echo 'User ID: ' . $user_data->ID . '<br>';
                echo 'Username: ' . $user_data->user_login . '<br>';
                echo 'Email: ' . $user_data->user_email . '<br>';
                // Add more fields for viewing as needed
            } else {
                echo 'User not found.';
            }
        } else {
            echo 'Invalid user ID.';
        }
        ?>

    </main><!-- #main -->
</div><!-- #primary -->
<?php

include_once $plugin_path . 'page-templates/layout/sidebar.php';
include_once $plugin_path . 'page-templates/layout/footer.php';

?>