$(document).ready(function () {
    $("#form").validate({
        rules: {
            address: {
                required: true
            },
            pwd: {
                required: true
            }
        },
        messages: {
            address: {
                required: "Enter your address"
            },
            pwd: {
                required:  "Enter your password"
            }
        }
    });
});