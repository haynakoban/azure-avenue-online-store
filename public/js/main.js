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
});
