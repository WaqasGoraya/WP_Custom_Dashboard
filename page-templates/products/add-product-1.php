<div class="content">
    <div class="col-md-10">
        <form action="" method="post" enctype="multipart/form-data">
            <h2 class="text-white">Add Product</h2><br />
            <div class="row card p-4">

                <div class="form-group mb-3">
                    <label for="product-name">Name:</label>
                    <input type="text" class="form-control" id="product-name" name="product_name">
                </div>
                <div class="form-group mb-3">
                    <label for="product-price">Price:</label>
                    <input type="text" class="form-control" id="product-price" name="product_price">
                </div>
                <div class="form-group mb-3">
                    <label for="product-description">Description:</label>
                    <textarea class="form-control" id="product-description" name="product_description"></textarea>
                </div>
                <div class="form-group mb-3">
                    <label for="product-description">Short Description:</label>
                    <textarea class="form-control" id="short-description" name="short_description"></textarea>
                </div>
                <!-- Main Image -->
                <div class="form-group mb-3">
                    <label for="main-image">Main Image:</label>
                    <input type="file" class="form-control-file" id="main-image" name="main_image">
                </div>

                <!-- Gallery Images -->
                <div class="form-group mb-3">
                    <label for="gallery-images">Gallery Images:</label>
                    <input type="file" class="form-control-file" id="gallery-images" name="gallery_images[]" multiple>
                    <small class="form-text text-muted">You can upload multiple images by selecting multiple
                        files.</small>
                </div>


                <div class="form-group mb-3">
                    <label for="product-type">Product Type:</label>
                    <select class="form-control" id="product-type" name="product_type">
                        <option value="simple">Simple</option>
                        <option value="variable">Variable</option>
                        <option value="external">External</option>
                    </select>
                </div>
                <div id="variation_data" class="mb-4 mt-4" style="display: none;">
                    <?php include_once $plugin_path . 'page-templates/products/variation.php';


                    // echo '<pre>';
                    // print_r($product_attributes);
                    ?>

                </div>
                <div class="form-group mb-3">
                    <label for="virtual-product">Virtual Product:</label>
                    <input type="checkbox" id="virtual-product" name="virtual_product" value="1">
                </div>

                <div class="form-group mb-3">
                    <label for="downloadable-product">Downloadable Product:</label>
                    <input type="checkbox" id="downloadable-product" name="downloadable_product" value="1">
                </div>

                <div class="form-group mb-3">
                    <label for="download-files">Download Files:</label>
                    <input type="file" class="form-control-file" id="download-files" name="download_files[]" multiple>
                    <small class="form-text text-muted">Select files for download (if applicable).</small>
                </div>

                <div class="form-group mb-3">
                    <label for="download-limit">Download Limit:</label>
                    <input type="number" class="form-control" id="download-limit" name="download_limit">
                </div>

                <div class="form-group mb-3">
                    <label for="download-expiry">Download Expiry:</label>
                    <input type="date" class="form-control" id="download-expiry" name="download_expiry">
                </div>
                <div class="form-group mb-3">
                    <label for="discount-type">Discount Type:</label>
                    <select class="form-control" id="discount-type" name="discount_type">
                        <option value="none">Without Sale</option>
                        <option value="percentage">Percentage</option>
                        <option value="price">Price After Sale</option>
                    </select>
                </div>

                <div id="discount-fields" style="display: none;">
                    <div class="form-group mb-3" id="percentage-field">
                        <label for="discount-percentage">Discount Percentage:</label>
                        <input type="number" class="form-control" id="discount-percentage" name="discount_percentage">
                    </div>

                    <div class="form-group mb-3" id="price-field">
                        <label for="discount-price">Price After Sale:</label>
                        <input type="number" class="form-control" id="discount-price" name="discount_price">
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label for="product-status">Product Status:</label>
                    <select class="form-control" id="product-status" name="product_status">
                        <option value="draft">Draft</option>
                        <option value="pending">Pending</option>
                        <option value="publish">Publish</option>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="product-category">Product Category:</label>
                    <select class="form-control" id="product-category" name="product_category[]" multiple>
                        <?php
                        $product_categories = get_terms(
                            array(
                                'taxonomy' => 'product_cat',
                                'hide_empty' => false,
                            )
                        );
                        foreach ($product_categories as $category) {
                            echo '<option value="' . $category->term_id . '">' . $category->name . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" class="btn mt-4 btn-primary">Add Product</button>

            </div>
        </form>


    </div>


</div>


<script>
    jQuery(document).ready(function ($) {
        $('#discount-type').change(function () {
            var selectedType = $(this).val();

            if (selectedType == 'percentage') {
                $('#discount-fields').show();
                $('#percentage-field').show();
                $('#price-field').hide();
            } else if (selectedType == 'price') {
                $('#discount-fields').show();
                $('#percentage-field').hide();
                $('#price-field').show();
            } else {
                $('#percentage-field').hide();
                $('#price-field').hide();
            }
        });


        $('#product-type').change(function () {
            var productType = $(this).val();
            // alert(productType);
            if (productType === "variable") {
                $('#variation_data').show();
            }
            else {
                $('#variation_data').hide();
            }
        });


        $('#add-variation').click(function () {
            // Clone the first variation group
            var newVariation = $('.form-group:first').clone();

            // Reset input values
            newVariation.find('input[type="number"]').val('');

            // Append the new variation group to the form
            $('.form-group:last').after(newVariation);
        });


        $('#attr-add-more').click(function () {
            var attrRow = $('#attribute-row').html();
            $('#attributes-list').append(attrRow);
        });

    });
</script>



<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!class_exists('WC_Product')) {
        require_once (ABSPATH . 'wp-content/plugins/woocommerce/includes/abstracts/abstract-wc-product.php');
    }

    if (!empty ($_FILES['main_image']['name'])) {
        require_once ABSPATH . 'wp-admin/includes/image.php';
        require_once ABSPATH . 'wp-admin/includes/file.php';
        require_once ABSPATH . 'wp-admin/includes/media.php';
        $main_image_id = media_handle_upload('main_image', 0);
    } else {
        $main_image_id = 0;
    }

    // echo '<pre>';
    // var_dump($main_image_id);
    // die();



    // Check for gallery images
    $gallery_image_ids = array();
    if (!empty ($_FILES['gallery_images']['name'][0])) {
        foreach ($_FILES['gallery_images']['name'] as $key => $value) {
            require_once ABSPATH . 'wp-admin/includes/image.php';
            require_once ABSPATH . 'wp-admin/includes/file.php';
            require_once ABSPATH . 'wp-admin/includes/media.php';
            $gallery_image_ids[] = media_handle_upload('gallery_images_' . $key, 0);
        }
    }

    $product_type = $product_type = isset ($_POST['product_type']) ? sanitize_text_field($_POST['product_type']) : '';

    // Create the product based on the selected type
    switch ($product_type) {
        case 'simple':
            $product = new WC_Product();

            break;
        case 'variable':
            $product = new WC_Product_Variable();

            break;
        case 'external':
            $product = new WC_Product_External();

            break;
        default:
            // Invalid product type
            // Handle error or display a message
            break;
    }
    // $product_id = get_the_ID(); // Get product ID
    // echo '<pre>';
    // print_r($product_id);
    // die();



    $product->set_name(sanitize_text_field($_POST['product_name']));
    $product->set_regular_price(floatval($_POST['product_price']));
    $product->set_description(wp_kses_post($_POST['product_description']));
    $product->set_short_description(wp_kses_post($_POST['short_description']));
    $product->set_status('publish');
    $product->update_meta_data('product_type', $product_type);

    // Set main image
    if ($main_image_id && !is_wp_error($main_image_id)) {
        $product->set_image_id($main_image_id);
    }

    // Set gallery images
    if (!empty ($gallery_image_ids)) {
        foreach ($gallery_image_ids as $gallery_image_id) {
            if ($gallery_image_id && !is_wp_error($gallery_image_id)) {
                $product->add_gallery_image($gallery_image_id);
            }
        }
    }


    $virtual_product = isset ($_POST["virtual_product"]) ? true : false;

    $product->update_meta_data('virtual', $virtual_product);


    // Handle downloadable product option
    $downloadable_product = isset ($_POST["downloadable_product"]) ? true : false;

    $product->update_meta_data('downloadable', $downloadable_product);

    // Handle download files
    $download_files = array();
    if ($downloadable_product && isset ($_FILES["download_files"])) {
        foreach ($_FILES["download_files"]["tmp_name"] as $key => $tmp_name) {
            $upload_dir = wp_upload_dir();
            $target_dir = $upload_dir["basedir"] . '/downloads/';

            // Ensure the directory exists, create it if not
            if (!file_exists($target_dir)) {
                wp_mkdir_p($target_dir);
            }

            // Generate a unique filename
            $file_name = wp_unique_filename($target_dir, $_FILES["download_files"]["name"][$key]);

            // Move the uploaded file to the target directory
            $target_file = $target_dir . $file_name;
            move_uploaded_file($tmp_name, $target_file);

            // Store the file path
            $file_paths[] = $upload_dir["baseurl"] . '/downloads/' . $file_name;

        }
    }

    $product->update_meta_data('downloadable_files', $file_paths);

    $download_limit = isset ($_POST["download_limit"]) ? intval($_POST["download_limit"]) : -1;

    $product->update_meta_data('download_limit', $download_limit);

    $download_expiry = isset ($_POST["download_expiry"]) ? sanitize_text_field($_POST["download_expiry"]) : '';

    $product->update_meta_data('download_expiry', $download_expiry);


    $discount_type = isset ($_POST["discount_type"]) ? sanitize_text_field($_POST["discount_type"]) : 'none';
    // Save discount type as meta data
    $product->update_meta_data('discount_type', $discount_type);

    // Handle discount value
    $discount_value = 0; // Default value
    if ($discount_type == 'percentage') {
        $discount_percentage = isset ($_POST["discount_percentage"]) ? floatval($_POST["discount_percentage"]) : 0;
        $discount_value = $discount_percentage;
    } elseif ($discount_type == 'price') {
        $discount_price = isset ($_POST["discount_price"]) ? floatval($_POST["discount_price"]) : 0;
        $discount_value = $discount_price;
    }
    // Save discount value as meta data
    $product->update_meta_data('discount_value', $discount_value);

    $product_status = isset ($_POST["product_status"]) ? sanitize_text_field($_POST["product_status"]) : 'draft';

    $product->set_status($product_status);
    $product_categories = isset ($_POST["product_category"]) ? $_POST["product_category"] : array();

    $product->set_category_ids($product_categories);

    // Save the product
    $product_id = $product->save();




    $attr_name = $_POST['attr_name'];
    $attr_value = $_POST['attr_value'];
    $attr_price = $_POST['attr_price'];
    $attr_qty = $_POST['attr_qty'];








    try {
        $variation_data = array(
            'attributes' => array(
                'pa_' . $attr_name => $attr_value // Set the attributes for this variation
            ),
            'regular_price' => $attr_price, // Regular price
            'stock_qty' => $attr_qty,
        );

        // Debugging output
        echo '<pre>';
        print_r($variation_data);
        echo '</pre>';

        $variation = new WC_Product_Variation();
        $variation->set_regular_price($variation_data['regular_price']);
        $variation->set_stock_quantity($variation_data['stock_qty']);
        $variation->set_manage_stock(true); // Set to true to manage stock for this variation

        // Set attributes for the variation
        $variation->set_attributes($variation_data['attributes']);

        // Set parent product ID
        $parent_product_id = $product->get_id();
        echo "Parent Product ID: $parent_product_id"; // Debugging output

        $variation->set_parent_id($parent_product_id);

        // Save the variation
        $variation_id = $variation->save();
        echo "Variation ID: $variation_id"; // Debugging output
    } catch (Exception $e) {
        echo 'Error creating variation: ' . $e->getMessage();
    }








    // foreach ($product_categories as $key => $value) {
    //     echo '<pre>';
    //     print_r($value);

    //     wp_set_object_terms($product_id, $value, 'product_cat');
    // }





    // if (!empty ($_POST["new_attribute"]) && !empty ($_POST["new_attribute_value"])) {
    //     // Sanitize input
    //     $new_attribute = sanitize_text_field($_POST["new_attribute"]);
    //     $new_attribute_value = sanitize_text_field($_POST["new_attribute_value"]);

    //     // Insert the new attribute term
    //     $term = wp_insert_term($new_attribute, 'pa_' . sanitize_title($new_attribute));

    //     if (is_wp_error($term)) {
    //         // Handle error
    //         echo "Error creating new attribute: " . $term->get_error_message();
    //     } else {
    //         // Get the newly created term ID
    //         $term_id = $term["term_id"];

    //         // Add the attribute value
    //         $result = wp_set_object_terms($product_id, $term_id, 'pa_' . sanitize_title($new_attribute), true);

    //         if (is_wp_error($result)) {
    //             // Handle error
    //             echo "Error adding attribute value: " . $result->get_error_message();
    //         }
    //     }
    // }


    if ($product_id) {
        if (!session_id()) {
            session_start();
        }
        $_SESSION['update_message'] = 'Product added successfully.';

        // wp_redirect(add_query_arg('create', 'success', home_url('/admin/products')));

        // Redirect after successful update with message
    } else {
        echo 'error';
    }

}