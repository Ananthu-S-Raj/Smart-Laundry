function validate_login(){
    var email=document.getElementById("email").value;
    var password=document.getElementById("password").value;
    if(email==""||password==""){
        alert("Email id and Password cannot be blank");
        location.reload();
        return false ;//to prevent from sumbitting
        
    }else{
        return true;
    }
}