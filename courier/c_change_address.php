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
if (isset($_SESSION['id'])) {
    $courier_id = $_SESSION['id'];
 
} else {
    echo "Can't get agent id.";
}


if($_SERVER['REQUEST_METHOD']=="POST"){
    if(isset($_POST['new_address'])){
        $new_address=$_POST['new_address'];
    }
if($_SERVER['REQUEST_METHOD']=="POST"){
    if(isset($_POST['form_password'])){
        $form_password=$_POST['form_password'];

    }
}
$query="SELECT * FROM courier_registration_table WHERE id=$courier_id";
$result = mysqli_query($connection, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $password = $row['password'];
    $old_address = $row['address'];

    if ($password === $form_password) {

        if ($old_address === $new_address) {
            header("Location: c_change_address.html?message=same_address");
        } else {
            $new_address = mysqli_real_escape_string($connection, $new_address);
            $update_query = "UPDATE courier_registration_table SET address = '$new_address' WHERE id = $courier_id";
            $update_result = mysqli_query($connection, $update_query);
            if ($update_result) {
                header("Location: c_change_address.html?message=address_change_successfull");
            } else {
                echo "Company address update failed.";
            }
        }
    } else {
        header("Location: c_change_address.html?message=wrong_password");
    }
} else {
    echo "Error fetching company data.";
}
}
?>
