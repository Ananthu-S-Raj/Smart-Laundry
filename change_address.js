function back_to_profile(){
    window.location.href = "user_info.php";
}
window.onload = function() {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get("message") === "wrong_password") {
        alert("Wrong Password");
    }

    else if(urlParams.get("message") === "address_change_successfull") {
            alert("Address changed successfully.");
                window.location.href = "user_info.php";
       
    }
};

