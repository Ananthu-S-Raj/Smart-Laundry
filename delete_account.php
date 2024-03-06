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

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

} else {
    echo "Can't get user id.";
    echo "Can't get password.";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['form_user_id'])) {
        $form_user_id = $_POST['form_user_id'];
    }
    if (isset($_POST['form_email_id'])) {
        $form_email_id = $_POST['form_email_id'];
    }
    if (isset($_POST['form_password'])) {
        $form_password = $_POST['form_password'];
    }

    
    $query = "SELECT * FROM user_registration_table WHERE id = $user_id";

    $result = mysqli_query($connection, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $password = $row['password'];
        $email_id = $row['email'];
        $user_id = $row['id'];
        
        if($user_id === $form_user_id){
            if ($email_id  === $form_email_id) {
                if ($password === $form_password){

                $delete_query = "DELETE FROM user_registration_table WHERE id = $user_id";
                $delete_result = mysqli_query($connection, $delete_query);
                
        if ($delete_result) {
            header("Location: delete_account.html?message=account_deleted");
    } else {
            echo "Account deletion failed.";
            }
    }else{
            header("Location: delete_account.html?message=wrong_password");
            }
            
        } else {
            header("Location: delete_account.html?message=wrong_email_id");
        }
    }else{
        header("Location: delete_account.html?message=wrong_user_id");
   }
    } else {
        echo "Error fetching user data.";
    }
}
?>
