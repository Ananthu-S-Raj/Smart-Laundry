function validate_signup() {
    var suggested_password = document.getElementById("suggested_password").innerText;
    var confirm_password = document.getElementById("confirm_password").value;
    console.log(suggested_password);
    console.log(confirm_password);
    
    if (suggested_password !== confirm_password) {
        alert("Password mismatch");
        return false; // Prevent form submission
    } else {
        return true; // Allow form submission
    }
}
window.onload = function() {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get("message") === "account_exists") {
        alert("Already have an account with this email id.can't create new account!.");
    }
    else if (urlParams.get("message") === "account_created") {
        alert("Account created.You can login now!.");

        window.location.href = "c_login.html";
    }
    else if (urlParams.get("message") === "data_insertion_failed") {
        alert("Data insertion failed!.");
    }


}; 