function back_to_profile(){
    window.location.href = "user_info.php";
}

window.onload = function() {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get("message") === "wrong_user_id") {
        alert("Wrong User id");
    }

    else if(urlParams.get("message") === "wrong_email_id") {
            alert("Wrong email!.");    
    }

    else if(urlParams.get("message") === "wrong_password") {
        alert("Wrong password!");    
}
    else if(urlParams.get("message") === "account_deleted") {
            
            setTimeout(function() {
                window.location.href = "index.html";
            }, 100);
            alert("Account deleted!.");   
    }

    

};

