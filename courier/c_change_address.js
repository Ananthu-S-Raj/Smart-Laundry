function back() {
    window.location.href = "c_info.php";
}

function address_error() {
    var new_address = document.getElementById("new_address").value;
    var confirm_new_address = document.getElementById("confirm_new_address").value;
    var form_password = document.getElementById("form_password").value;

    if (new_address !== confirm_new_address) {
        alert("Address  didn't match");
        return false;
     }

    return true; // Form submission will proceed if all checks pass
}

window.onload = function() {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get("message") === "wrong_password") {
        alert("Wrong Password");
    } else if (urlParams.get("message") === "address_change_successfull") {
        alert("Address changed successfully!.");
        window.location.href = "c_info.php";
    } else if (urlParams.get("message") === "c_same_address") {
        alert("New email cannot be the same as the old one!.");
    }
};
