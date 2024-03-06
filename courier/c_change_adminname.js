function back(){
    window.location.href = "c_info.php";
}
function cname_error() {
    var new_cname = document.getElementById("new_cname").value;
    var confirm_cname = document.getElementById("confirm_cname").value;
    var form_password = document.getElementById("form_password").value;

    if (new_cname !== confirm_cname) {
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

    else if(urlParams.get("message") === "cname_change_successfull") {
            alert("Your name changed successfully.");
            window.location.href="c_info.php"    

       
    }

    else if(urlParams.get("message") === "same_cname") {
            alert("New  cannot be the same as that of old!");    
    }

};

