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

if (isset($_SESSION['admin_id'])) {
    $admin_id = $_SESSION['admin_id'];

} else {
    echo "Can't get user id.";
    echo "Can't get password.";
}
 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['form_admin_id'])) {
        $form_admin_id = $_POST['form_admin_id'];
    }
    if (isset($_POST['form_email_id'])) {
        $form_email_id = $_POST['form_email_id'];
    }
    if (isset($_POST['form_password'])) {
        $form_password = $_POST['form_password'];
    }

    
    $query = "SELECT * FROM admin_table WHERE id = $admin_id";

    $result = mysqli_query($connection, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $password = $row['password'];
        $email_id = $row['email'];
        $admin_id = $row['id'];
        
        if($admin_id === $form_admin_id){
            if ($email_id  === $form_email_id) {
                if ($password === $form_password){

                $delete_query = "DELETE FROM admin_table WHERE id = $admin_id";
                $delete_result = mysqli_query($connection, $delete_query);
                
        if ($delete_result) {
            header("Location: ad_delete_account.html?message=ad_account_deleted");
    } else {
            echo "Admin account deletion failed.";
            }
    }else{
            header("Location: ad_delete_account.html?message=ad_wrong_password");
            }
            
        } else {
            header("Location: ad_delete_account.html?message=ad_wrong_email_id");
        }
    }else{
        header("Location: ad_delete_account.html?message=ad_wrong_user_id");
   }
    } else {
        echo "Error fetching user data.";
    }
}
?>
