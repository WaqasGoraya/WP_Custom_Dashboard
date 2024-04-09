<form id="product_attributes_form" method="post">
    <h4>Add Product Attributes</h4>
    <div class="form-group">
        <label for="attribute_name">Attribute Name:</label>
        <input type="text" class="form-control" id="attribute_name" name="attribute_name">
    </div>
    <div class="form-group">
        <label for="attribute_values">Attribute Values (comma-separated):</label>
        <input type="text" class="form-control" id="attribute_values" name="attribute_values">
    </div>

    <input type="button" id="add_attribute_button" name="add_attribute" value="Add Attribute">
</form>

<div class="mt-4">
    <h4>Add Variation</h4>
    <?php $product_attributes = wc_get_attribute_taxonomies(); ?>
    <select name="attr_name" id="p_attributes" class="form-control">
        <option selected disabled>Select Attribute</option>
        <?php foreach ($product_attributes as $attr): ?>
            <option value="<?= $attr->attribute_name; ?>">
                <?= esc_html($attr->attribute_name); ?>
            </option>
        <?php endforeach; ?>
    </select>

    <select name="attr_value" id="attr_values" class="form-control mt-2" style="display: none;">

    </select>
    <input placeholder="Enter Price..." type="text" class="form-control mt-2" name="attr_price">
    <input placeholder="Enter Quantity" type="text" class="form-control mt-2" name="attr_qty">
</div>