<?php
$host="localhost";
$user="root";
$password="";
$database="smart_laundry";
$connection=mysqli_connect($host,$user,$password,$database);
if(!$connection){
    echo"connected";
}
session_start(); // Start the session
if (isset($_SESSION['company_id'])) {
    $company_id = $_SESSION['company_id'];

} else {
    echo "Can't get admin id.";
}


if($_SERVER['REQUEST_METHOD']=="POST"){
    if(isset($_POST['new_cname'])){
        $new_cname=$_POST['new_cname'];
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
    $old_name = $row['company_name'];

    if ($password === $form_password) {

        if ($old_name === $new_cname) {
            header("Location: dl_change_companyname.html?message=same_cname");
        } else {
            $new_cname = mysqli_real_escape_string($connection, $new_cname);
            $update_query = "UPDATE dealer_registration_table SET company_name = '$new_cname' WHERE id = $company_id";
            $update_result = mysqli_query($connection, $update_query);
            if ($update_result) {
                header("Location: dl_change_companyname.html?message=cname_change_successfull");
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
