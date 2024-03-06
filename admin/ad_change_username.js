function back(){
    window.location.href = "ad_info.php";
}
function username_error() {
    var new_name = document.getElementById("new_name").value;
    var confirm_new_name = document.getElementById("confirm_new_name").value;
    var form_password = document.getElementById("form_password").value;

    if (new_name !== confirm_new_name) {
        alert("Names don't match!");
        return false;
    }
    
    return true; // Form submission will proceed if all checks pass

}



window.onload = function() {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get("message") === "wrong_password") {
        alert("Wrong Password");
    }

    else if(urlParams.get("message") === "adminname_change_successfull") {
            alert("Admin name changed successfully.");
            window.location.href="ad_info.php"    

       
    }

    else if(urlParams.get("message") === "same_adminname") {
            alert("new admin name cannot be the same as that of old!");    
    }

};

