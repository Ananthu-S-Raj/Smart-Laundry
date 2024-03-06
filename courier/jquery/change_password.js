$(document).ready(function () {
    $("#form").validate({
        rules: {
            curPwd: {
                required: true
            },
            newPwd: {
                required: true,
                minlength: 8,
                strongPassword: true
                
            },
            conPwd: {
                required: true,
                equalTo: "input[name='newPwd']"
            }
        },
        messages: {
            curPwd: {
                required: "Enter your current email"
            },
            newPwd: {
                required: "Enter your new email",
                minlength: "Password must be at least 8 characters",
                strongPassword: "Password must include at least one uppercase letter, one lowercase letter, one digit, and one special character"
            },
            conPwd: {
                required:  "Enter your password",
                equalTo : "passwords do not match"
            }
        }
    });
    $.validator.addMethod("strongPassword", function (value) {
       
        return /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/.test(value);
    }, "Invalid password format");
});