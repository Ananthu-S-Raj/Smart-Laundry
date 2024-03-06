function validate_signup() {
    var pwd = document.getElementById("pwd").value;
    var confirm_password = document.getElementById("confirm_password").value;
    // console.log(pwd);
    // console.log(confirm_password);
    
    if (pwd !== confirm_password) {
        alert("Password mismatch");
        location.reload();
        return false; // to prevent from submitting
    } else {
        return true;
    }
}
window.onload = function() {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get("message") === "account_exists") {
        alert("Already have an account with this mail.Please login or try a different mail id.");
        window.location.href="/smart laundry/";
    }
    else if (urlParams.get("message") === "account_created") {
        alert("Account created!.You can login.");
        window.location.href="dealer_login.html";
    }
    
    else if (urlParams.get("message") === "account_creation_failed") {
        alert("Account creation failed!.");
    }


}; 