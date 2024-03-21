<?php
ob_start();
include_once $plugin_path . 'page-templates/layout/header.php';

// Initialize message variable
$message = '';

// Get the active theme
$active_theme = wp_get_theme();

// Get a list of installed themes
$themes = wp_get_themes();

// Handle form submission
if (isset($_POST['selected_theme'])) {
    $selected_theme = sanitize_text_field($_POST['selected_theme']);

    // Check if the selected theme exists
    if (isset($themes[$selected_theme])) {
        // Check if the selected theme is already active
        if ($active_theme->get_stylesheet() !== $selected_theme) {
            // Attempt to switch to the selected theme
            switch_theme($selected_theme);
            $message = 'Theme activated successfully.';
            $active_theme = $themes[$selected_theme]; // Update active theme after switching

            // Redirect to the same page to prevent form resubmission
            wp_redirect($_SERVER['REQUEST_URI']);
        } else {
            $message = 'Theme already active.';
        }
    } else {
        $message = 'Invalid theme selection.';
    }
}
?>

<style>
    /* Theme item container */
    .theme-item {
        display: flex;
        flex-direction: column;
        margin-bottom: 20px;
        border: 1px solid #ddd;
        border-radius: 5px;
        overflow: hidden;
    }

    /* Theme screenshot */
    .theme-screenshot img {
        width: 100%;
        height: auto;
    }

    /* Theme details */
    .theme-details {
        padding: 10px;
        background-color: #f9f9f9;
        color: #000;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    /* Theme name */
    .theme-details h3 {
        margin-top: 0;
        margin-bottom: 10px;
        font-size: 18px;
    }

    /* Theme actions */
    .theme-actions {
        display: flex;
        align-items: center;
    }

    /* Activate button */
    .theme-actions .button {
        padding: 6px 12px;
        border-radius: 3px;
        margin-right: 10px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    /* Active theme button */
    .active-theme .button {
        background-color: #0073aa;
        color: #fff;
    }

    /* Popup modal */
    .modal-content {
        height: 80vh;
        /* Adjust popup height */
        overflow-y: auto;
        /* Enable vertical scrolling */
    }

    /* Ensure three themes in a row */
    .themes-list {
        display: flex;
        flex-wrap: wrap;
        margin: -10px;
        /* Adjust for padding */
    }

    .theme-item {
        flex-basis: calc(33.333% - 20px);
        /* Adjust for margin */
        margin: 10px;
        /* Padding between items */
    }

    @media (max-width: 768px) {
        .theme-item {
            flex-basis: calc(50% - 20px);
            /* Two themes per row on smaller screens */
        }
    }

    /* Set themes heading to white */
    .wp-heading-inline {
        color: #fff;
    }

    /* Active theme card footer in black */
    .theme-item.active-theme .theme-details {
        background-color: #000;
        color: #fff;
    }

    .theme-item.active-theme .theme-details h3 {
        margin-bottom: 0;
        color: #fff;
    }
</style>
<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <div class="wrap">
            <h1 class="wp-heading-inline">Themes</h1>
            <?php if (!empty($message)) : ?>
                <div id="message" class="updated notice is-dismissible">
                    <p><?php echo esc_html($message); ?></p>
                    <button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button>
                </div>
            <?php endif; ?>
            <div class="theme-browser">
                <div class="themes-list">
                    <?php foreach ($themes as $theme) : ?>
                        <div class="theme-item<?php echo ($active_theme->get_stylesheet() === $theme->get_stylesheet()) ? ' active-theme' : ''; ?>">
                            <div class="theme-screenshot">
                                <img src="<?php echo esc_url($theme->get_screenshot()); ?>" alt="<?php echo esc_attr($theme->get('Name')); ?>">
                            </div>
                            <div class="theme-details">
                                <h3><?php echo esc_html($theme->get('Name')); ?></h3>
                                <div class="theme-actions">
                                    <form method="post">
                                        <input type="hidden" name="selected_theme" value="<?php echo esc_attr($theme->get_stylesheet()); ?>">
                                        <button type="submit" class="button button-primary"><?php echo ($active_theme->get_stylesheet() === $theme->get_stylesheet()) ? 'Activated' : 'Activate'; ?></button>

                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </main>
</div>

<?php
include_once $plugin_path . 'page-templates/layout/sidebar.php';
include_once $plugin_path . 'page-templates/layout/footer.php';

ob_end_flush();
?>