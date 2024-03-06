function back(){
    window.location.href = "ad_info.php";
}
function password_error(){
    var old_password=document.getElementById("old_password").value;
    var pass=document.getElementById("pass").value;
    var new_password=document.getElementById("new_password").value;
 
if(pass !== new_password){
        alert("Passwords doesn't matches!(admin pass js)")
        return false;
    }
    return true;// Form submission will proceed if all checks pass
}

window.onload = function() {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get("message") === "ad_wrong_current_password") {
        alert("Wrong current Password (admin pass js)");
    }

    else if(urlParams.get("message") === "ad_password_change_successfull") {
            alert("Password changed successfully.(admin pass js)");
            window.location.href="ad_info.php"    
    }

    else if(urlParams.get("message") === "ad_same_passwords") {
            alert("Old password and new password cannot be the same!(admin pass js)");    
    }

};

