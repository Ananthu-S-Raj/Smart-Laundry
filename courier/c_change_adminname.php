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
    $id = $_SESSION['id'];

} else {
    echo "Can't get courier id.";
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
$query="SELECT * FROM courier_registration_table WHERE id=$id";
$result = mysqli_query($connection, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $password = $row['password'];
    $old_name = $row['name'];

    if ($password === $form_password) {

        if ($old_name === $new_cname) {
            header("Location: c_change_adminname.html?message=same_cname");
        } else {
            $new_cname = mysqli_real_escape_string($connection, $new_cname);
            $update_query = "UPDATE courier_registration_table SET name = '$new_cname' WHERE id = $id";
            $update_result = mysqli_query($connection, $update_query);
            if ($update_result) {
                header("Location: c_change_adminname.html?message=cname_change_successfull");
            } else {
                echo "Company name update failed.";
            }
        }
    } else {
        header("Location: c_change_adminname.html?message=wrong_password");
    }
} else {
    echo "Error fetching user data.";
}
}
?>
