function back(){
    window.location.href = "dl_info.php";
}
window.onload = function() {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get("message") === "wrong_password") {
        alert("Wrong Password");
    }

    else if(urlParams.get("message") === "dl_phone_number_change_successfull") {
            alert("Phone number changed successfully.");
                window.location.href = "dl_info.php";
       
    }
}; 

