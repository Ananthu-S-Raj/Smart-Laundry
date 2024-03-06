
window.onload = function() {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get("message") === "wrong_pass") {
        alert("Login failed!.Incorrect password.");
        window.location.href="c_login.html";
    }
    else if (urlParams.get("message") === "incorrect_mail") {
        alert("Login failed!.Incorrect email.");
        window.location.href="c_login.html";

    }
    else if (urlParams.get("message") === "go_to_login") {
        window.location.href="c_home.html";
    }


}; 