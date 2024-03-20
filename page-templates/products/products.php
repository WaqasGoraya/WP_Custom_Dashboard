<?php

include_once $plugin_path . 'page-templates/layout/header.php';


$args = array(
    'post_type' => 'product',
    'posts_per_page' => -1 // Retrieve all products
);

$products = new WP_Query($args);


wp_reset_postdata();

?>


<div style="padding: 20px;">
    <h2 style="color: white;">Products</h2>

    <div class="container-fluid line-container pt-4 stats">
        <div class="row g-4">
            <div class="col-md-12">
                <div class="stat-card">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Tags</th>
                                    <th scope="col">فعل</th>
                                    <!-- <th scope="col">حالة</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($products->posts as $product) :
                                    $title =  $product->post_title;
                                    $category =  get_the_terms(get_the_ID(), "product_cat");
                                    $tags = get_the_terms($product->ID, 'product_tag');
                                    $categories = get_the_terms($product->ID, 'product_cat');

                                    // echo '<pre>';
                                    // print_r($product);
                                    // die();
                                ?>
                                    <tr>
                                        <td><?= $title; ?></td>
                                        <td><?php foreach ($categories as $key => $cat) { ?>
                                                <span class="badge bg-info"><?= $cat->name ?></span>
                                            <?php  } ?>
                                        </td>
                                        <td><?php foreach ($tags as $key => $tag) { ?>
                                                <span class="badge bg-primary"><?= $tag->name ?></span>
                                            <?php  } ?>
                                        </td>

                                        <td>
                                            <a class="btn btn-danger btn-sm" href="">Delete</a>
                                            <a class="btn btn-success btn-sm" href="<?php echo home_url('/admin/products/edit-product/?product_id=' . $product->ID); ?>">Edit</a>
                                        </td>

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