<?php
// Custom export function
add_action('wp_ajax_custom_export_customers', 'custom_export_customers');
add_action('wp_ajax_nopriv_custom_export_customers', 'custom_export_customers');

function custom_export_customers()
{
    // Get users with the 'customer' role
    $customers = get_users(array('role' => 'customer'));
    $csv_output = "Customer Email,Customer Name,Total Spending,Orders\n";


    foreach ($customers as $customer) {
        $spent = wc_get_customer_total_spent($customer->ID);
        $order_count = wc_get_customer_order_count($customer->ID);

        $last_active = get_user_meta($customer->ID, 'wc_last_active', true);
        $last_date = date('M d,Y', $last_active);

        $currency = $spent .' '. get_woocommerce_currency_symbol();
        $csv_output .= "{$customer->user_email},{$customer->display_name},{$currency},{$order_count}\n";
    }

    echo $csv_output;
    exit;
}

// Customer Search function
add_action('wp_ajax_search_customers', 'search_customers_callback');
add_action('wp_ajax_nopriv_search_customers', 'search_customers_callback');

function search_customers_callback()
{
    if (isset($_POST['search_query'])) {
        $searchQuery = sanitize_text_field($_POST['search_query']);

        $args = array(
            'role' => 'customer',
            'meta_query' => array(
                'relation' => 'OR',
                array(
                    'key' => 'billing_first_name',
                    'value' => $searchQuery,
                    'compare' => 'LIKE',
                ),
                array(
                    'key' => 'billing_last_name',
                    'value' => $searchQuery,
                    'compare' => 'LIKE',
                ),
                array(
                    'key' => 'billing_email',
                    'value' => $searchQuery,
                    'compare' => 'LIKE',
                ),
            ),
        );

        $customers = get_users($args);

        if (!empty($customers)) {
            foreach ($customers as $customer) {
                $spent = wc_get_customer_total_spent($customer->ID);
                $order_count = wc_get_customer_order_count($customer->ID);

                $last_active = get_user_meta($customer->ID, 'wc_last_active', true);
                $last_date = date('M d,Y', $last_active);
                // Display more customer information as needed
            }
            echo '<tr>
                    <td class="text-end" dir="ltr">'. $customer->display_name .'</td>
                    <td class="email-sec">'. $customer->user_email .'</td>
                    <td class="ejmali">'. $spent .' ' . get_woocommerce_currency_symbol() .'</td>
                    <td>'. $last_date . '</td>
                    <td class="talab">'. $order_count . '</td>
                    </tr>';
        } else {
            echo '<h4 style="text-align:center; color:white;">No Customer Found.</h4>';
        }
    }

    wp_die();
}
