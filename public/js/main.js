$(document).ready(function () {
    // Get the input element and buttons
    var quantityInput = $(".quantity");
    var minusButton = $(".minus-btn");
    var plusButton = $(".plus-btn");

    // When the minus button is clicked
    minusButton.click(function () {
        var currentValue = parseInt(quantityInput.val());
        if (currentValue > 1) {
            quantityInput.val(currentValue - 1);
        }
    });

    // When the plus button is clicked
    plusButton.click(function () {
        var currentValue = parseInt(quantityInput.val());
        if (currentValue < 50) {
            quantityInput.val(currentValue + 1);
        }
    });

    // On change event listener
    $(".quantity").on("change", function () {
        var input = $(this);
        var value = parseInt(input.val());

        if (value > 50) {
            input.val(50);
        }
    });

    // remove item from cart
    $(".remove-item").click(function (e) {
        e.preventDefault();
        var url = $(this).data("url");

        $.ajax({
            url: url,
            method: "DELETE",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                // Handle success response, such as updating the UI or showing a notification
                console.log("Item removed successfully");
                if (response?.message) {
                    location.reload();
                }
            },
            error: function (xhr, status, error) {
                // Handle error response
                console.log("Error removing item from cart");
            },
        });
    });
});
