$(document).ready(function () {
    $("#form").validate({
        rules: {
            userid: {
                required: true,
            },
            email: {
                required: true,
                email:true
            },
            pwd: {
                required: true
            }
        },
        messages: {
            userid: {
                required: "Enter your userid"
            },
            email: {
                required: "enter your email",
                email: "Enter a valid email address"
            },
            pwd: {
                required:  "Enter your password"
            }
        }
    });
});