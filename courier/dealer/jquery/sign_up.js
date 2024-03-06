$(document).ready(function () {
    $("#form").validate({
        rules: {
            name: {
                required: true,
                minlength:5,
                maxlength:25
            },
            phone: {
                required: true,
                digits: true,
                maxlength:10,
                minlength:10

            },
            mail: {
                required: true,
                email: true

            },
            address:{
                required: true,
            },
            pass: {
                required: true,
                minlength: 8,
                strongPassword: true
            },
            pass1: {
                required: true,
                equalTo: "input[name='pass']"
            },
        },
        messages: {
            name: {
                required: "Enter your name",
                minlength:"username must  be between 5 and 25 characters"
            },
            phone: {
                required: "enter your phone number",
                digits: "Please enter a valid phone number",
                maxlength: "please enter a valid 10 digit phone number",
                minlength: "please enter a valid 10 digit phone number",
            },
            mail: {
                required:  "Enter your email",
                email:"Please enter a valid email address"
            },
            address:{
                required:"This field is required"
            },
            pass: {
                required: "Enter your password",
                minlength: "Password must be at least 8 characters",
                strongPassword: "Password must include at least one uppercase letter, one lowercase letter, one digit, and one special character"
            },
            pass1: {
                required: "Confirm your password",
                equalTo: "Passwords do not match"
            }
        }
    });
    $.validator.addMethod("strongPassword", function (value) {
       
        return /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/.test(value);
    }, "Invalid password format");
});