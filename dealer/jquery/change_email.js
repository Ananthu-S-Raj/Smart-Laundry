$(document).ready(function () {
    $("#form").validate({
        rules: {
            newEmail: {
                required: true,
                email: true
            },
            confEmail: {
                required: true,
                email: true,
                equalTo: "input[name='newEmail']"
            },
            pwd: {
                required: true
            }
        },
        messages: {
            newEmail: {
                required: "Enter your email"
            },
            confEmail: {
                required: "Confirm your email",
                equalTo: "Emails do not match"
            },
            pwd: {
                required:  "Enter your password"
            }
        }
    });
});

