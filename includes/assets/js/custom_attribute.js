jQuery(document).ready(function ($) {
  $("#add_attribute_button").click(function () {
    var attribute_name = $("#attribute_name").val();
    var attribute_values = $("#attribute_values").val();

    // alert(attribute_name)

    $.ajax({
      url: custom_attributes_ajax_object.ajaxurl,
      type: "post",
      data: {
        action: "add_product_attribute",
        attribute_name: attribute_name,
        attribute_values: attribute_values,
      },
      success: function (response) {
        $("#attribute_result").html(response);
      },
    });
  });

  $("#p_attributes").change(function () {
    var attribute_name = $(this).val();

    ///alert(attribute_name);

    if (attribute_name) {
      // AJAX request to retrieve attribute values based on attribute ID
      $.ajax({
        url: custom_attributes_ajax_object.ajaxurl,
        type: "post",
        data: {
          action: "get_attribute_values",
          attribute_name: attribute_name,
        },
        success: function (response) {
          console.log(response);
          $("#attr_values").empty();
          $("#attr_values").html(response).show();
        },
      });
    } else {
      $("#attr_values")
        .html("<option selected disabled>Select Attribute Value</option>")
        .hide();
    }
  });
});
