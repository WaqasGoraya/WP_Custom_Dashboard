jQuery(document).ready(function ($) {
  // Customers Export function
  $("#exportCustomersButton").on("click", function () {
    $.ajax({
      url: custom_ajax_object.ajaxurl,
      type: "POST",
      data: {
        action: "custom_export_customers",
      },
      success: function (response) {
        console.log("Export success!");
        // Optionally, you can redirect the user or display a success message

        // Create a hidden anchor element to trigger the file download
        var downloadLink = document.createElement("a");
        downloadLink.href =
          "data:text/csv;charset=utf-8," + encodeURIComponent(response);
        downloadLink.download = "customer-data.csv";
        downloadLink.style.display = "none";
        document.body.appendChild(downloadLink);
        downloadLink.click();
        document.body.removeChild(downloadLink);
      },
      error: function (xhr, status, error) {
        console.error("Export error:", error);
        // Handle error scenario
      },
    });
  });

  // Search customers function

  //   $("#customerSearchForm").on("submit", function (event) {
  //     event.preventDefault(); // Prevent form submission

  //     var searchQuery = $("#customerSearchInput").val();

  $("#customerSearchInput").on("input", function () {
    var searchQuery = $(this).val();

    $.ajax({
      url: custom_ajax_object.ajaxurl,
      type: "POST",
      data: {
        action: "search_customers",
        search_query: searchQuery,
      },
      success: function (response) {
        console.log(response);
        $("#customerSearchResults").html(response);
      },
      error: function (xhr, status, error) {
        console.error("AJAX error:", error);
      },
    });
  }); //function end
});
