<?php


include_once $plugin_path . 'page-templates/layout/header-main.php';

if (isset ($_POST['submit']) && $_POST['submit'] === 'Update Product') {
    $product_id = isset ($_POST['product_id']) ? intval($_POST['product_id']) : 0;

    // Get product object
    $product = wc_get_product($product_id);



    if (!$product) {
        return;
    }

    // Update product name
    if (isset ($_POST['product_name'])) {
        $product->set_name(sanitize_text_field($_POST['product_name']));
    }

    // Update product price
    if (isset ($_POST['product_price'])) {



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
            $product_id = isset ($_GET['product_id']) ? intval($_GET['product_id']) : 0;

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
                    <input type="text" name="product_id" value="<?php echo esc_attr($product->get_name()); ?>"
                        class="form-control mb-2">
                </div>
                <div class="form-group">
                    <label for="">SKU</label>
                    <input type="text" name="product_id" value="<?php echo esc_attr($product->get_sku()); ?>"
                        class="form-control mb-2">
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
                        <option value="variable" <?php if ($product->get_type() === 'variable') { ?> selected <?php } ?>>
                            Variable Product</option>
                        <option value="external" <?php if ($product->get_type() === 'external') { ?> selected <?php } ?>>
                            External Product</option>
                        <option value="simple" <?php if ($product->get_type() === 'simple') { ?> selected <?php } ?>>Simple
                            Product</option>
                    </select>
                </div>


                <div class="row">
                    <h2 class="text-white">Varaints</h2>




                    <?php
                    if ($product->is_type('variable')) {
                        // Get variations
                        $variations = $product->get_available_variations();



                        // Loop through the variations
                        foreach ($variations as $variation) {

                            $attributes = $product->get_attributes();

                            // Get variation attributes
                            $variation_attributes = $variation['attributes'];

                            foreach ($attributes as $attribute => $data) {

                                $attribute_name = str_replace('attribute_', '', $attribute);
                                $selected_attr = $variation_attributes['attribute_' . $attribute];

                                // echo '<pre>';
                                // print_r($selected_attr);
                                // echo '</pre>';
                
                                ?>



                                <div class="form-group mb-2 col-md-6">
                                    <label class="form-label" for="">
                                        <?= strtoupper($attribute_name) ?>
                                    </label>
                                    <select class="form-control" name="" id="">
                                        <?php foreach ($attributes[$attribute]['options'] as $attr): ?>
                                            <option value="" <?php selected($selected_attr, $attr, true) ?>>

                                                <?= esc_html($attr) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <br>


                                <?php
                            }
                        } ?>

                    <?php } ?>


                </div>


                <div class="mt-6 mb-4 col-md-6">
                    <h1 class="text-white">Shipping</h1>

                    <div class="form-group">
                        <label for="">Shipping weight</label>
                        <input type="number" class="form-control" name="shipping_wght"
                            value="<?= $product->get_weight(); ?>" id="">
                    </div>
                    <div class="form-group">

                        <?php

                        $dimensions_string = $product->get_dimensions();

                        $dimensions_array = explode('×', $dimensions_string);

                        // Trim whitespace from each dimension value
                        $dimensions_array = array_map('trim', $dimensions_array);

                        $length = $dimensions_array[0];
                        $width = $dimensions_array[1];
                        $height = $dimensions_array[2];

                        // Remove 'cm' unit from height dimension
                        $height = str_replace('cm', '', $height);

                        ?>

                        <label for="">Diamenssion</label>
                        <input placeholder="Width" type="number" class="form-control col-md-2" name="shipping_wght"
                            value="<?= $width; ?>" id="">
                        <input placeholder="Height" type="number" class="form-control col-md-2" name="shipping_hgt"
                            value="<?= $height; ?>" id="">
                        <input placeholder="Length" type="number" class="form-control col-md-2" name="shipping_lngth"
                            value="<?= $length; ?>" id="">
                    </div>
                </div>


                <div class="mb-2">
                    <h1 class="text-white">Linked Products</h1>
                    <?php
                    $upsell_ids = $product->get_upsell_ids();

                   

                    $all_products = wc_get_products(
                        array(
                            'limit' => -1,
                            'status' => 'publish',
                            'return' => 'array'
                        )
                    );



                    // Get downsell product IDs
                    $downsell_ids = $product->get_cross_sell_ids(); ?>

                    <select class="form-control" name="" id="" multiple>
                        <!-- Loop through upsells -->
                        <option value="">Select a related product...</option>

                        <?php foreach ($all_products as $single_product): ?>

                         
                                <option value="<?= $single_product->get_id() ?>"
                                   <?php if (in_array($single_product->get_id(), $upsell_ids)): ?>
                                     selected <?php endif; ?>
                                >
                                    <?= $single_product->get_name() ?>
                                </option>

                           
                        <?php endforeach; ?>

                    </select>
                    <!-- echo "Upsell Products: <br>";
                    foreach ($upsell_ids as $upsell_id) {
                    $upsell_product = wc_get_product($upsell_id);
                    echo $upsell_product->get_name() . "<br>";
                    }

                    // Output downsell products
                    echo "<br>Downsell Products: <br>";
                    foreach ($downsell_ids as $downsell_id) {
                    $downsell_product = wc_get_product($downsell_id);
                    echo $downsell_product->get_name() . "<br>";
                    }
                    ?> -->
                </div>


                <div class="mb-2 col-md-6">
                    <h1 class="text-white">Status</h1>
                     <?php
                    $status = $product->get_status();
                      
                    // echo '<pre>';
                    // print_r($status);
                    // die();
                   
                  ?>
                    <label for="">Select Status</label>
                    <select name="status" id="" class="form-control">
                        <option 
                        <?php
                        if($status == 'publish'): ?>
                        selected
                   <?php endif; ?>

                          value="publish">Published</option>
                         <option 
                           <?php
                        if($status == 'pending'): ?>
                        selected
                   <?php endif; ?>
                         value="pending_review">Pending Review</option>
                          <option 
                            <?php
                        if($status == 'draft'): ?>
                        selected
                   <?php endif;?>
                          value="publish">Draft</option>
                    </select>
                </div>


                <div class="mb-2">
                    <h1>Product Image</h1>
                    <img src="<?= base_url() .'uploads/products/' .$product->image ;?>" alt="" style="width:300px;">
                </div>

                <div class="mb-2">
                     <h1>Product Categories</h1>
                     <small>Please select categories below.
                        You can also add new category by clicking on "Add New Category".
                      </small><br>
                       <a href="<?= base_url('admin/category/add')?>" class="btn btn-primary mb-3">Add New Category</a>
                       <?php
                       $product_categories = get_categories( array(
                                    'taxonomy'     => 'product_cat',
                                    'orderby'      => 'name',
                                    'hide_empty'   => false,
                                    ) );

// Output the select input
                            ?>
                            <select name="product_category">
                                <option value="">Select a category</option>
                                <?php foreach ($product_categories as $category): ?>
                            <option value="<?php echo esc_attr($category->term_id); ?>">
                                <?php echo esc_html($category->name); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    



                </div>

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