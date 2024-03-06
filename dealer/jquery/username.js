$(document).ready(function () {
    $("#form").validate({
        rules: {
            newUser: {
                required: true,
                minlength: 5,
                maxlength: 25
                
            },
            confirmUser: {
                required: true,
                equalTo: "input[name='newUser']"
            },
            pwd: {
                required: true
            }
        },
        messages: {
            newUser: {
                required: "Enter new username",
                minlength:"username must  be between 5 and 25 characters"
            },
            confirmUser: {
                required: "Confirm your username",
                equalTo: "Username do not match"
            },
            pwd: {
                required:  "Enter your password"
            }
        }
    });
});