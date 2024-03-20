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


        if ($user_data) {
            global $wpdb;
            // Update user information
            $username = isset($_POST['username']) ? sanitize_user($_POST['username']) : '';
            $email = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';

            if (!empty($username) && !empty($email)) {

                $table = 'wp_users';

                $args = array(
                    'user_login' => $username,
                    'user_email' => $email
                );

                // Where condition
                $where = array(
                    'ID' => $user_id
                );
                // Update user data
                $wpdb->update($table, $args, $where);
                // Set a success message in the session
                if (!session_id()) {
                    session_start();
                }
                $_SESSION['update_message'] = 'User information updated successfully.';

                // Redirect after successful update with message
                wp_redirect(add_query_arg('update', 'success', home_url('/admin/users')));
                // echo 'User information updated successfully.';
                // wp_redirect(home_url().'/admin/users');
                exit;
            } else {
                echo 'Username and email are required.';
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
            if ($user_data) {  ?>

                <div class="col-md-6 stat-card">
                    <form action="" method="post">
                        <h1 style="color:white">Edit User</h1><br />
                        <!-- Display errors -->
                        <div class="mb-2">
                            <label for="">UserName</label>
                            <input type="text" class="form-control" name="username" value="<?= $user_data->user_login ?>">
                        </div>
                        <div class="mb-2">
                            <label for="">Email</label>
                            <input type="email" class="form-control" name="email" value="<?= $user_data->user_email ?>">
                        </div>

                        <input type="submit" value="Update" class="btn btn-primary btn-sm">

                    </form>
                </div>


        <?php   } else {
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