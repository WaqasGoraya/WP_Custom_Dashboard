<?php
include_once $plugin_path . 'page-templates/layout/header.php';

// Handle form submission
if (isset($_POST['selected_theme'])) {
    $selected_theme = sanitize_text_field($_POST['selected_theme']);
    switch_theme($selected_theme);
}

// Get a list of installed themes
$themes = wp_get_themes();
?>
<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <div class="theme-selector">
            <h2>Select a Theme</h2>
            <form method="post">
                <div class="themes-list">
                    <?php foreach ($themes as $theme) : ?>
                        <div class="theme-item">
                            <img src="<?php echo $theme->get_screenshot(); ?>" alt="<?php echo esc_attr($theme->get('Name')); ?>" width="250px">
                            <h3><?php echo $theme->get('Name'); ?></h3>
                            <p><?php echo $theme->get('Description'); ?></p>
                            <input type="hidden" name="selected_theme" value="<?php echo $theme->get_stylesheet(); ?>">
                            <button type="submit" class="activate-button">Activate</button>
                        </div>
                    <?php endforeach; ?>
                </div>
            </form>
        </div>
    </main>
</div>
<?php


include_once $plugin_path . 'page-templates/layout/sidebar.php';
include_once $plugin_path . 'page-templates/layout/footer.php';

?>