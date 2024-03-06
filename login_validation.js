function validate_login(){
    var email=document.getElementById("email").value;
    var password=document.getElementById("password").value;
    if(email==""||password==""){
        alert("Email id and Password cannot be blank");
        location.reload();
        return false ;//to prevent from sumbitting
        
    }else{
        return true;
    }
}

window.onload = function() {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get("message") === "wrong_email") {
        alert("User not found.Please check your email address.");
    }

    else if(urlParams.get("message") === "wrong_password") {
            alert("Login failed. Please check your password.");
            //window.location.href="user_info.php";
       
    }


};
