$(document).ready(function () {
    $("#form").validate({
        rules: {
            mail: {
                required: true,
                email: true
            },
            pwd: {
                required: true
            }
        },
        messages: {
            mail: {
                required: "Enter your email"
            },
            pwd: {
                required:  "Enter your password"
            }
        }
    });
});