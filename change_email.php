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
        $session_password = $_SESSION['password'];
    } else {
        echo "Can't get user id.";
        echo "Can't get password.";
    }


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['new_email'])) {
        $new_email = $_POST['new_email'];
    }
    if (isset($_POST['confirm_new_email'])) {
        $confirm_new_email = $_POST['confirm_new_email'];
    }
    if (isset($_POST['form_password'])) {
        $form_password = $_POST['form_password'];
    }

    
    $query = "SELECT * FROM user_registration_table WHERE id = $user_id";

    $result = mysqli_query($connection, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $password = $row['password'];
        $old_email = $row['email'];

        if ($password === $form_password) {

            if ($old_email === $new_email) {
                header("Location: change_email.html?message=same_email");
            } else {
                $new_email = mysqli_real_escape_string($connection, $new_email);
                $update_query = "UPDATE user_registration_table SET email = '$new_email' WHERE id = $user_id";
                $update_result = mysqli_query($connection, $update_query);
                if ($update_result) {
                    header("Location: change_email.html?message=email_change_successfull");
                } else {
                    echo "Username update failed.";
                }
            }
        } else {
            header("Location: change_email.html?message=wrong_password");
        }
    } else {
        echo "Error fetching user data.";
    }
}
?>
