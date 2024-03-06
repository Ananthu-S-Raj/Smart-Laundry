function back() {
    window.location.href = "ad_info.php";
}

function email_error() {
    var new_email = document.getElementById("new_email").value;
    var confirm_new_email = document.getElementById("confirm_new_email").value;
    var form_password = document.getElementById("form_password").value;

    if (new_email !== confirm_new_email) {
        alert("Email address didn't match (admin mail js)");
        return false;
    }

    return true; // Form submission will proceed if all checks pass
}

window.onload = function() {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get("message") === "wrong_password") {
        alert("Wrong Password (admin mail js)");
    } else if (urlParams.get("message") === "ad_email_change_successfull") {
        alert("Email changed successfully!.(admin mail js)");
        window.location.href = "ad_info.php";
    } else if (urlParams.get("message") === "ad_same_email") {
        alert("New email cannot be the same as the old one!.(admin mail js)");
    }
};
