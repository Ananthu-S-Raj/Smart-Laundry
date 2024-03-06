function back(){
    window.location.href = "c_info.php";
}

window.onload = function() {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get("message") === "c_wrong_user_id") {
        alert("Wrong agent id");
    }

    else if(urlParams.get("message") === "c_wrong_email_id") {
            alert("Wrong email!.");     
    }

    else if(urlParams.get("message") === "c_wrong_password") {
        alert("Wrong password!");    
}
    else if(urlParams.get("message") === "c_account_deleted") {
            
            setTimeout(function() {
                window.location.href = "/smart laundry";
            }, 100);
            alert("Bye bye.Account deleted!.");   
    }

    

};

