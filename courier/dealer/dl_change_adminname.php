<?php
$host="localhost";
$user="root";
$password="";
$database="smart_laundry";
$connection=mysqli_connect($host,$user,$password,$database);
if(!$connection){
    echo"connection failed";
    
}
session_start(); // Start the session
if (isset($_SESSION['company_id'])) {
    $company_id = $_SESSION['company_id'];

} else {
    echo "Can't get company id.";
}


if($_SERVER['REQUEST_METHOD']=="POST"){
    if(isset($_POST['new_dlname'])){
        $new_dlname=$_POST['new_dlname'];
    }
if($_SERVER['REQUEST_METHOD']=="POST"){
    if(isset($_POST['form_password'])){
        $form_password=$_POST['form_password'];

    }
}
$query="SELECT * FROM dealer_registration_table WHERE id=$company_id";
$result = mysqli_query($connection, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $password = $row['password'];
    $old_name = $row['name'];

    if ($password === $form_password) {

        if ($old_name === $new_dlname) {
            header("Location: dl_change_companyname.html?message=same_dlname");
        } else {
            $new_cname = mysqli_real_escape_string($connection, $new_dlname);
            $update_query = "UPDATE dealer_registration_table SET name = '$new_dlname' WHERE id = $company_id";
            $update_result = mysqli_query($connection, $update_query);
            if ($update_result) {
                header("Location: dl_change_adminname.html?message=dlname_change_successfull");
            } else {
                echo "Company name update failed.";
            }
        }
    } else {
        header("Location: dl_change_companyname.html?message=wrong_password");
    }
} else {
    echo "Error fetching user data.";
}
}
?>
