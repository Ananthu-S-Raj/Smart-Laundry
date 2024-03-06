function back_to_profile(){
    window.location.href = "user_info.php";
}
function password_error(){
    var old_password=document.getElementById("old_password").value;
    var pass=document.getElementById("pass").value;
    var new_password=document.getElementById("new_password").value;
 
        if(old_password=== "" ||pass==="" || new_password === "" ){
            alert("All fields must be filled");
            return false;
        }
        
    else if(pass !== new_password){
        alert("Passwords doesn't matches (user password js)!")
        return false;
    }
    return true;// Form submission will proceed if all checks pass
}

window.onload = function() {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get("message") === "wrong_current_password") {
        alert("Wrong current Password");
    }

    else if(urlParams.get("message") === "password_change_successfull") {
            alert("Password changed successfully.");
            window.location.href="user_info.php"    
    }

    else if(urlParams.get("message") === "same_passwords") {
            alert("Old password and new password cannot be the same!");    
    }

};

