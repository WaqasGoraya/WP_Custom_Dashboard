<?php
include_once $plugin_path . 'page-templates/layout/header.php';


require_once ('wp-load.php');

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
        foreach ($_FILES["download_files"]["tmp_name"] as $tmp_name) {
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

    // Handle download limit
    $download_limit = isset ($_POST["download_limit"]) ? intval($_POST["download_limit"]) : -1;

    $product->update_meta_data('download_limit', $download_limit);

    // Handle download expiry
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
    // echo '<pre>';
    // print_r($custom_product_type);
    // die();

    // Save the product
    $product_id = $product->save();

    if ($product_id) {
        if (!session_id()) {
            session_start();
        }
        $_SESSION['update_message'] = 'Product added successfully.';

        // Redirect after successful update with message
        echo "<script>
                window.location.href = 'admin/products/';
                </script>";
    } else {
        echo 'error';
    }

    wp_die();
}

?>

<div class="content">
    <div class="col-md-8 ">
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
    });
</script>

<?php






include_once $plugin_path . 'page-templates/layout/sidebar.php';
include_once $plugin_path . 'page-templates/layout/footer.php';

?>