function back(){
    window.location.href = "c_info.php";
}
function password_error(){
    var pass=document.getElementById("pass").value;
    var new_password=document.getElementById("new_password").value;
 
if(pass !== new_password){
        alert("Passwords doesn't matches!")
        return false;
    } 
    return true;// Form submission will proceed if all checks pass
}

window.onload = function() {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get("message") === "c_wrong_current_password") {
        alert("Wrong current Password!");
    }

    else if(urlParams.get("message") === "c_password_change_successfull") {
            alert("Password changed successfully.!");
            window.location.href="c_info.php"    
    }

    else if(urlParams.get("message") === "c_same_passwords") {
            alert("Old password and new password cannot be the same!");    
    }

};

