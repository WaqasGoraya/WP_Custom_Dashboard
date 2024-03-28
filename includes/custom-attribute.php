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
    $attribute_name = isset ($_POST['attribute_name']) ? sanitize_text_field($_POST['attribute_name']) : '';
    $attribute_values = isset ($_POST['attribute_values']) ? sanitize_text_field($_POST['attribute_values']) : '';

    // Add attribute if both name and values are provided
    if (!empty ($attribute_name) && !empty ($attribute_values)) {
        // Split values into array
        $values_array = explode(',', $attribute_values);

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
        $attribute_id = wc_create_attribute($attribute_data);


        if (!is_wp_error($attribute_id)) {


            // Add attribute values
            foreach ($values_array as $value) {

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
                // Insert attribute term
                $taxonomy = 'pa_' . sanitize_title($attribute_name);


                // Add term to the attribute
                $term = wp_insert_term($value, $taxonomy);

                // Debug term creation
                if (is_wp_error($term)) {
                    // If there's an error, print it and continue to the next term
                    echo 'Error creating term: ' . $term->get_error_message();
                    die;

                }

                echo 'Term created successfully: ';
                print_r($term);



                // Assign term to attribute
                $term_id = $term['term_id'];
                wp_set_object_terms($term_id, $attribute_id, 'pa_' . $attribute_name, true);
            }

            echo '<p>Attribute added successfully.</p>';
        } else {
            echo '<p>Error adding attribute: ' . $attribute_id->get_error_message() . '</p>';
        }



    }

}



add_action('wp_ajax_get_attribute_values', 'get_attribute_values_callback');
add_action('wp_ajax_nopriv_get_attribute_values', 'get_attribute_values_callback');

function get_attribute_values_callback()
{


    $attribute_name = isset ($_POST['attribute_name']) ? $_POST['attribute_name'] : '';



    if ($attribute_name) {
        // Retrieve attribute values based on attribute ID
        $values = get_terms(
            array(
                'taxonomy' => 'pa_' . $attribute_name,
                'hide_empty' => false,
            )
        );



        if (!empty ($values)) {
            // Output attribute values as options
            $options = '<option selected>Select Attribute Value</option>';
            foreach ($values as $value) {
                $options .= '<option value="' . $value->slug . '">' . $value->name . '</option>';
            }
            echo $options;
        } else {
            echo '<option selected disabled>No values found</option>';
        }
    } else {
        echo '<option selected disabled>Select Attribute</option>';
    }

    wp_die();
}