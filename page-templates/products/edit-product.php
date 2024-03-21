<?php

include_once $plugin_path . 'page-templates/layout/header.php';

if (isset($_POST['submit']) && $_POST['submit'] === 'Update Product') {
    $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;

    // Get product object
    $product = wc_get_product($product_id);



    if (!$product) {
        return;
    }

    // Update product name
    if (isset($_POST['product_name'])) {
        $product->set_name(sanitize_text_field($_POST['product_name']));
    }

    // Update product price
    if (isset($_POST['product_price'])) {



        $product->set_price(floatval($_POST['product_price']));
    }

    // Save changes
    $product->save();

    // Redirect back to the edit product page
    echo "<script>
                window.location='admin/products/';
                </script>";
}


?>


<div id="primary" class="container-fluid stats mt-4">
    <main id="main" class="col-md-12" role="main">

        <?php
        // Check if user is logged in and has permission to edit products
        if (is_user_logged_in() && current_user_can('edit_products')) {
            $product_id = isset($_GET['product_id']) ? intval($_GET['product_id']) : 0;

            $product = wc_get_product($product_id);

            // echo '<pre>';
            // print_r($product->get_available_variations());
            // die();
        ?>

            <form id="" method="post" class="stat-card">
                <!-- You can design your form fields here -->
                <input type="hidden" name="product_id" value="<?php echo esc_attr($_GET['product_id']); ?>">
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" name="product_id" value="<?php echo esc_attr($product->get_name()); ?>" class="form-control mb-2">
                </div>
                <div class="form-group">
                    <label for="">SKU</label>
                    <input type="text" name="product_id" value="<?php echo esc_attr($product->get_sku()); ?>" class="form-control mb-2">
                </div>
                <!-- <div class="form-group">
                    <label for="">Price</label>
                    <input type="text" name="product_price" value="<?php echo esc_attr($product->get_price()); ?>" class="form-control mb-2">
                </div> -->

                <div class="form-group mb-2">
                    <label for="">Short Description</label>
                    <textarea name="short_description" class="form-control" rows="3">
                        <?php echo esc_html(wc_clean($product->get_short_description())); ?>
                    </textarea>
                </div>
                <div class="form-group mb-2">
                    <label for="">Description</label>
                    <textarea name="description" class="form-control" rows="3">
                        <?php echo esc_html(wc_clean($product->get_description())); ?>
                    </textarea>
                </div>


                <div class="form-group col-md-6">
                    <label for="exampleFormControlSelect1">Product Type</label>
                    <select name="p_type" class="form-control mb-2" id="exampleFormControlSelect1">
                        <option value="variable" <?php if ($product->get_type() === 'variable') { ?> selected <?php } ?>>Variable Product</option>
                        <option value="external" <?php if ($product->get_type() === 'external') { ?> selected <?php } ?>>External Product</option>
                        <option value="simple" <?php if ($product->get_type() === 'simple') { ?> selected <?php } ?>>Simple Product</option>
                    </select>
                </div>

                <?php
                if ($product->is_type('variable')) {
                    // Get variations
                    $variations = $product->get_available_variations();

                    // Loop through the variations
                    foreach ($variations as $variation) {
                        // Get variation ID
                        $variation_id = $variation['variation_id'];

                        // Get variation attributes
                        $variation_attributes = $variation['attributes'];

                        // Output variation ID and attributes
                        echo '<p>Variation ID: ' . $variation_id . '</p>';
                        echo '<p>Variation Attributes: ';
                        foreach ($variation_attributes as $key => $value) {
                            echo ucfirst(str_replace('attribute_', '', $key)) . ': ' . $value . ', ';
                        }
                        echo '</p>';
                    }
                }
                ?>




                <input type="submit" class="btn btn-sm btn-primary" name="submit" value="Update Product">
            </form>

        <?php
        } else {
            // Display message if user is not logged in or doesn't have permission
            echo '<p>You do not have permission to edit products.</p>';
        }
        ?>

    </main><!-- #main -->
</div><!-- #primary -->


<?php

include_once $plugin_path . 'page-templates/layout/sidebar.php';
include_once $plugin_path . 'page-templates/layout/footer.php';

?>