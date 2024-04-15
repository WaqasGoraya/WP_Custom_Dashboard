<?php

add_action('wp_ajax_add_product_attribute', 'custom_add_product_attribute_callback');
add_action('wp_ajax_nopriv_add_product_attribute', 'custom_add_product_attribute_callback');

function custom_add_product_attribute_callback()
{
    // Ensure WooCommerce is loaded
    if (!class_exists('WooCommerce')) {
        echo '<p>WooCommerce is not active.</p>';
        exit;
    }

    // Retrieve attribute name and values from AJAX request
    $attribute_name = isset($_POST['attribute_name']) ? sanitize_text_field($_POST['attribute_name']) : '';
    // $attribute_values = isset ($_POST['attribute_values']) ? sanitize_text_field($_POST['attribute_values']) : '';

    // Add attribute if both name and values are provided

    // Split values into array
    //  $values_array = explode(',', $attribute_values);

    // Add attribute to WooCommerce
    $attribute_data = array(
        'name' => $attribute_name,
        'slug' => sanitize_title($attribute_name),
        'type' => 'select', // Attribute type: select, text, etc.
        'order_by' => 'menu_order', // Attribute order: menu_order or name
        'has_archives' => true, // Whether attribute should have archives
        'variation' => true, // Enable this attribute for variations
    );
    // Add attribute to WooCommerce


    $attribute_value = isset($_POST['attribute_value']) ? sanitize_text_field($_POST['attribute_value']) : '';

    if (!empty($attribute_value) && !empty($attribute_name)) {

        // echo 'here';
        // die();

        register_taxonomy(
            wc_attribute_taxonomy_name($attribute_data['name']),
            'product',
            array(
                'label' => $attribute_data['label'],
                'hierarchical' => $attribute_data['hierarchical'],
                'show_ui' => $attribute_data['show_ui'],
                'query_var' => $attribute_data['query_var'],
                'rewrite' => $attribute_data['rewrite'],
            )
        );

        $taxonomy = 'pa_' . sanitize_title($attribute_name);


        // Add term to the attribute
        $term = wp_insert_term($attribute_value, $taxonomy);

        // Debug term creation
        if (is_wp_error($term)) {
            // If there's an error, print it and continue to the next term
            echo 'Error creating term: ' . $term->get_error_message();
            die;

        }

        // Assign term to attribute
        $term_id = $term['term_id'];
        wp_set_object_terms($term_id, 'pa_' . $attribute_name, true);

        echo 'Term created successfully: ';
    } else {
        $attribute_id = wc_create_attribute($attribute_data);


        if (!is_wp_error($attribute_id)) {

            echo $attribute_id;
        }
    }


    // Add attribute values
    //         foreach ($values_array as $value) {

    //             register_taxonomy(
    //                 wc_attribute_taxonomy_name($attribute_data['name']),
    //                 'product',
    //                 array(
    //                     'label' => $attribute_data['label'],
    //                     'hierarchical' => $attribute_data['hierarchical'],
    //                     'show_ui' => $attribute_data['show_ui'],
    //                     'query_var' => $attribute_data['query_var'],
    //                     'rewrite' => $attribute_data['rewrite'],
    //                 )
    //             );
    //             // Insert attribute term
    //             $taxonomy = 'pa_' . sanitize_title($attribute_name);


    //             // Add term to the attribute
    //             $term = wp_insert_term($value, $taxonomy);

    //             // Debug term creation
    //             if (is_wp_error($term)) {
    //                 // If there's an error, print it and continue to the next term
    //                 echo 'Error creating term: ' . $term->get_error_message();
    //                 die;

    //             }

    //     //         echo 'Term created successfully: ';
    //     //         print_r($term);



    //     //         // Assign term to attribute
    //     //         $term_id = $term['term_id'];
    //     //         wp_set_object_terms($term_id, $attribute_id, 'pa_' . $attribute_name, true);
    //     //     }

    //     //     echo '<p>Attribute added successfully.</p>';
    //     // } else {
    //     //     echo '<p>Error adding attribute: ' . $attribute_id->get_error_message() . '</p>';
    //     // }



    // }



}

add_action('wp_ajax_get_attribute_values', 'get_attribute_values_callback');
add_action('wp_ajax_nopriv_get_attribute_values', 'get_attribute_values_callback');

function get_attribute_values_callback()
{


    $attribute_name = isset($_POST['attribute_name']) ? $_POST['attribute_name'] : '';



    if ($attribute_name) {
        // Retrieve attribute values based on attribute ID
        $values = get_terms(
            array(
                'taxonomy' => $attribute_name,
                'hide_empty' => false,
            )
        );



        if (!empty($values)) {
            // Output attribute values as options
            $options = '';
            foreach ($values as $value) {
                $options .= '<option data-created="true" value="' . $value->slug . '">' . $value->name . '</option>';
            }
            echo $options;
        } else {
            echo '<option disabled>No values found</option>';
        }
    } else {
        echo '<option  disabled>Select Attribute</option>';
    }

    wp_die();
}

add_action('wp_ajax_add_new_variation', 'add_new_variation_callback');
add_action('wp_ajax_nopriv_add_new_variation', 'add_new_variation_callback');

function add_new_variation_callback()
{

    $attName = isset($_POST['attr_name']) ? $_POST['attr_name'] : '';

    $pId = isset($_POST['product_id']) ? $_POST['product_id'] : '';

    $attr_value = isset($_POST['attr_value']) ? $_POST['attr_value'] : '';

    $values_array = explode(',', $attr_value);

    $attrs[] = create_attributes(sanitize_title($attName), $values_array);





    if (!empty($pId)) {
        $product = wc_get_product($pId);

    } else {
        $product = new WC_Product_Variable();
    }



    $product->set_attributes($attrs);

    $product->save();

    $variation_data = array();

    foreach ($values_array as $key => $value) {
        print_r($value);
        array_push($variation_data, [$attName => trim($value)]);
    }

    $data = new stdClass();
    $data->sku = '';
    $data->price = '10';


    create_variations(275, $variation_data[0], $data);


    $pId = $product->get_id();

    echo $pId;

}


function create_attributes($name, $options)
{
    $attribute = new WC_Product_Attribute();
    $attribute->set_id(0);
    $attribute->set_name($name);
    $attribute->set_options($options);
    $attribute->set_visible(true);
    $attribute->set_variation(true);
    return $attribute;
}
function create_variations($product_id, $values, $data)
{
    $variation = new WC_Product_Variation();
    $variation->set_parent_id($product_id);
    $variation->set_attributes($values);
    $variation->set_status('publish');
    $variation->set_sku($data->sku);
    $variation->set_price($data->price);
    $variation->set_regular_price($data->price);
    $variation->set_stock_status();
    $variation->save();
    $product = wc_get_product($product_id);
    $product->save();

}