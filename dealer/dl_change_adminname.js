function back(){
    window.location.href = "dl_info.php";
}
function dlname_error() {
    var new_dlname = document.getElementById("new_dlname").value;
    var confirm_dlname = document.getElementById("confirm_dlname").value;
    var form_password = document.getElementById("form_password").value;

    if (new_dlname !== confirm_dlname) {
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

    else if(urlParams.get("message") === "dlname_change_successfull") {
            alert("Company admin name changed successfully.");
            window.location.href="dl_info.php"    

       
    }

    else if(urlParams.get("message") === "same_dlname") {
            alert("New company admin name cannot be the same as that of old!");    
    }

};

