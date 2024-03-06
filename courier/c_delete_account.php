<?php
$host = "localhost";
$user = "root";
$pass = "";
$database = "smart_laundry";
$connection = mysqli_connect($host, $user, $pass, $database);
if (!$connection) {
    echo "Connection failed";
} 

session_start(); // Start the session

if (isset($_SESSION['id'])) {
    $courier_id = $_SESSION['id'];

} else {
    echo "Can't get agent id.";
    echo "Can't get password.";
}
 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['courier_id'])) {
        $courier_id = $_POST['courier_id'];
    }
    if (isset($_POST['email_id'])) {
        $email_id = $_POST['email_id'];
    }
    if (isset($_POST['form_password'])) {
        $form_password = $_POST['form_password'];
    }

    
    $query = "SELECT * FROM courier_registration_table WHERE id = $courier_id";

    $result = mysqli_query($connection, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $password = $row['password'];
        $email_id = $row['email'];
        $courier_id = $row['id'];
        
        if($courier_id === $courier_id){
            if ($email_id  === $email_id) {
                if ($password === $form_password){

                $delete_query = "DELETE FROM courier_registration_table WHERE id = $courier_id";
                $delete_result = mysqli_query($connection, $delete_query);
                
        if ($delete_result) {
            header("Location: c_delete_account.html?message=c_account_deleted");
    } else {
            echo "Agent account deletion failed.";
            }
    }else{
            header("Location: c_delete_account.html?message=c_wrong_password");
            }
            
        } else {
            header("Location: c_delete_account.html?message=c_wrong_email_id");
        }
    }else{
        header("Location: c_delete_account.html?message=c_wrong_user_id");
   }
    } else {
        echo "Error fetching user data.";
    }
}
?>
