function back(){
    window.location.href = "ad_info.php";
}

window.onload = function() {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get("message") === "ad_wrong_user_id") {
        alert("Wrong Admin id");
    }

    else if(urlParams.get("message") === "ad_wrong_email_id") {
            alert("Wrong email!.");     
    }

    else if(urlParams.get("message") === "ad_wrong_password") {
        alert("Wrong password!");    
}
    else if(urlParams.get("message") === "ad_account_deleted") {
            
            setTimeout(function() {
                window.location.href = "/smart laundary";
            }, 100);
            alert("You have left from admin panel!.");   
    }

    

};

