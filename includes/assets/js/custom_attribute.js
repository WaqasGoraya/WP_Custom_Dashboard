jQuery(document).ready(function ($) {
  // $("#add_attribute_button").click(function () {
  //   var attribute_name = $("#attribute_name").val();
  //   var attribute_values = $("#attribute_values").val();

  //   // alert(attribute_name)

  //   $.ajax({
  //     url: custom_attributes_ajax_object.ajaxurl,
  //     type: "post",
  //     data: {
  //       action: "add_product_attribute",
  //       attribute_name: attribute_name,
  //       attribute_values: attribute_values,
  //     },
  //     success: function (response) {
  //       $("#attribute_result").html(response);
  //     },
  //   });
  // });

  $(".my-select2").each(function () {
    $(this).select2({
      tags: true,
      dropdownParent: $(this).parent(),
    });
  });

  var a_name;
  $("#attr_name").on("select2:select", function (e) {
    var data = e.params.data;

    a_name = data.text;
    var val = data.id;

    console.log(data);
    var svalue = a_name.toLowerCase();

    if (!val.includes("pa_")) {
      //   alert(svalue)
      $.ajax({
        url: custom_attributes_ajax_object.ajaxurl,
        type: "post",
        data: {
          action: "add_product_attribute",
          attribute_name: data.text,
          // attribute_values: value
        },
        success: function (response) {
          console.log("Success!", response);
          $("#attr_name").append(
            $("<option>", {
              value: "pa_" + svalue,
              text: data.text,
            })
          );
          $(this).val(null).trigger("change");
          $("#attr_name")
            .val("pa_" + svalue)
            .trigger("change");
        },
      });
    }
  });
  $("#attr_values").on("select2:select", function (e) {
    var data = e.params.data;

    var text = data.text;
    var val = data.id;

    console.log(a_name);

    if (!data._resultId) {
      $.ajax({
        url: custom_attributes_ajax_object.ajaxurl,
        type: "post",
        data: {
          action: "add_product_attribute",
          attribute_name: a_name,
          attribute_value: data.text,
        },
        success: function (response) {
          console.log("Success!", response);
        },
      });
    }
  });

  $("#attr_name").change(function () {
    var attribute_name = $(this).val();

    //alert(attribute_name);

    $("#attr_values").empty();

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

  $("#save_attr").click(function (e) {
    e.preventDefault();

    var p_id = $("#product_id").val();

    let attrName = $("#attr_name option:selected").val().trim();

    var selectedValues = []; // Array to store selected values

    // Iterate over selected options and push their values to the array
    $("#attr_values option:selected").each(function () {
      selectedValues.push($(this).val());
    });

    if (!attrName || !selectedValues) {
      alert("Please select an attribute name and value");
      return false;
    }

    $.ajax({
      method: "POST",
      url: custom_attributes_ajax_object.ajaxurl,
      data: {
        action: "add_new_variation",
        attr_name: attrName,
        product_id: p_id,
        attr_value: selectedValues.join(","),
      },
      success: function (data) {
        console.log(data);
        // $("#myModal").modal("toggle");
        // location.reload();

        window.location.href = "";
      },
      error: function () {
        alert("Error! Please try again later.");
      },
    });
  });
});
