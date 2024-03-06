function back() {
    window.location.href = "c_info.php";
}

function email_error() {
    var new_email = document.getElementById("new_email").value;
    var confirm_new_email = document.getElementById("confirm_new_email").value;

    if (new_email !== confirm_new_email) {
        alert("Email address didn't match");
        return false;
    }

    return true; // Form submission will proceed if all checks pass
} 

window.onload = function() {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get("message") === "wrong_password") {
        alert("Wrong Password");
    } else if (urlParams.get("message") === "c_email_change_successfull") {
        alert("Email changed successfully!.");
        window.location.href = "c_info.php";
    } else if (urlParams.get("message") === "c_same_email") {
        alert("New email cannot be the same as the old one!.");
    }
};