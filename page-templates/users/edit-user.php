<?php
ob_start();
include_once $plugin_path . 'page-templates/layout/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the user ID from the form data
    $user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 0;

    // Check if user ID is valid
    if ($user_id > 0) {
        // Fetch user data
        $user_data = get_userdata($user_id);
        // Get additional user meta fields
        $first_name = get_user_meta($user_id, 'first_name', true);
        $last_name = get_user_meta($user_id, 'last_name', true);
        $display_name = get_user_meta($user_id, 'display_name', true);
        $profile_picture_id = get_user_meta($user_id, 'profile_picture', true);

        if ($user_data) {
            global $wpdb;
            // Sanitize and validate form data
            $email = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
            $password = isset($_POST['password']) ? sanitize_text_field($_POST['password']) : '';
            $first_name = isset($_POST['first_name']) ? sanitize_text_field($_POST['first_name']) : '';
            $last_name = isset($_POST['last_name']) ? sanitize_text_field($_POST['last_name']) : '';
            $display_name = isset($_POST['display_name']) ? sanitize_text_field($_POST['display_name']) : '';

            if (!empty($email)) {
                // Update user data
                $user_data = array(
                    'ID' => $user_id,
                    'user_email' => $email,
                );

                // Update password if provided
                if (!empty($password)) {
                    $user_data['user_pass'] = $password;
                }

                // Update user data
                wp_update_user($user_data);

                // Update additional user meta fields
                update_user_meta($user_id, 'first_name', $first_name);
                update_user_meta($user_id, 'last_name', $last_name);
                update_user_meta($user_id, 'display_name', $display_name);

                // Handle profile picture upload
                if (!empty($_FILES['profile_picture']['tmp_name'])) {
                    require_once ABSPATH . 'wp-admin/includes/image.php';
                    require_once ABSPATH . 'wp-admin/includes/file.php';
                    require_once ABSPATH . 'wp-admin/includes/media.php';

                    $attachment_id = media_handle_upload('profile_picture', 0); // 0 for current user

                    if (!is_wp_error($attachment_id)) {
                        update_user_meta($user_id, 'profile_picture', $attachment_id);
                    } else {
                        // Handle error
                    }
                }

                // Set a success message in the session
                if (!session_id()) {
                    session_start();
                }
                $_SESSION['update_message'] = 'User information updated successfully.';

                // Redirect after successful update with message
                wp_redirect(add_query_arg('update', 'success', home_url('/admin/users')));
                exit;
            } else {
                echo 'Email is required.';
            }
        } else {
            echo 'User not found.';
        }
    } else {
        echo 'Invalid user ID.';
    }
}
?>

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
                $first_name = get_user_meta($user_id, 'first_name', true);
                $last_name = get_user_meta($user_id, 'last_name', true);
                $display_name = get_user_meta($user_id, 'display_name', true);
                $profile_picture_id = get_user_meta($user_id, 'profile_picture', true);
        ?>

                <div class="col-md-6 stat-card">
                    <form method="post" enctype="multipart/form-data">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" value="<?php echo esc_attr($user_data->user_login); ?>" readonly><br>

                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" value="<?php echo esc_attr($user_data->user_email); ?>"><br>

                        <label for="password">New Password:</label>
                        <input type="password" id="password" name="password"><br>

                        <label for="first_name">First Name:</label>
                        <input type="text" id="first_name" name="first_name" value="<?php echo esc_attr($first_name); ?>"><br>

                        <label for="last_name">Last Name:</label>
                        <input type="text" id="last_name" name="last_name" value="<?php echo esc_attr($last_name); ?>"><br>

                        <label for="display_name">Display Name:</label>
                        <input type="text" id="display_name" name="display_name" value="<?php echo esc_attr($display_name); ?>"><br>

                        <label for="profile_picture">Profile Picture:</label>
                        <?php if ($profile_picture_id) : ?>
                            <img src="<?php echo wp_get_attachment_image_url($profile_picture_id, 'thumbnail'); ?>" alt="Profile Picture"><br>
                        <?php endif; ?>
                        <input type="file" id="profile_picture" name="profile_picture"><br>

                        <input type="submit" name="update_user" value="Update User">
                    </form>
                </div>

        <?php
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
ob_end_flush();
?>