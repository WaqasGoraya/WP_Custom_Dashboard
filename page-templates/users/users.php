<?php

include_once $plugin_path . 'page-templates/layout/header.php';

$current_user = wp_get_current_user();

$users = get_users();
?>
<div style="padding: 20px;">
    <h2 style="color: white;">Users</h2>

    <div class="container-fluid line-container pt-4 stats">
        <div class="row g-4">
            <div class="col-md-12">
                <div class="stat-card">
                    <?php
                    // Check if there's a success message in the session
                    if (!empty($_SESSION['update_message'])) {
                    echo '<div class="success-message">' . esc_html($_SESSION['update_message']) . '</div>';
                    // Clear the message from the session to avoid displaying it again
                    // unset($_SESSION['update_message']);
                    }
                    ?>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">رقم الهوية</th>
                                    <th scope="col">اسم المستخدم</th>
                                    <th scope="col"> بريد إلكتروني</th>
                                    <th scope="col">فعل</th>
                                    <!-- <th scope="col">حالة</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $user) : ?>
                                    <tr>
                                        <td class="text-sec"><?= $user->ID ?></td>
                                        <td><?= $user->user_login ?></td>
                                        <td><?= $user->user_email ?></td>
                                        <?php if ($user->roles[0] == 'administrator') : ?>
                                            <td>
                                                <a class="btn btn-success btn-sm" href="<?php echo home_url('/admin/users/edit-user/?user_id=' . $user->ID); ?>">Edit</a>
                                                <a class="btn btn-info btn-sm" href="<?php echo home_url('/admin/users/view-user/?user_id=' . $user->ID); ?>">View</a>
                                            </td>
                                        <?php else : ?>
                                            <td>
                                                <a class="btn btn-success btn-sm" href="">Remove</a>
                                                <a class="btn btn-info btn-sm" href="<?php echo home_url('/admin/users/view-user/?user_id=' . $user->ID); ?>">View</a>
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php


include_once $plugin_path . 'page-templates/layout/sidebar.php';
include_once $plugin_path . 'page-templates/layout/footer.php';

?>