function back_to_profile(){
    window.location.href = "dl_info.php";
}
window.onload = function() {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get("message") === "wrong_password") {
        alert("Wrong Password");
    }

    else if(urlParams.get("message") === "pricing_updated") {
            alert("Price updated successfully.");
                window.location.href = "dl_info.php";
       
    }
};

