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
    if (isset($_POST['new_name'])) {
        $new_name = $_POST['new_name'];
    }
    if (isset($_POST['confirm_new_name'])) {
        $confirm_new_name = $_POST['confirm_new_name'];
    }
    if (isset($_POST['form_password'])) {
        $form_password = $_POST['form_password'];
    }

    
    $query = "SELECT * FROM user_registration_table WHERE id = $user_id";

    $result = mysqli_query($connection, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $password = $row['password'];
        $old_name = $row['name'];

        if ($password === $form_password) {

            if ($old_name === $new_name) {
                header("Location: change_username.html?message=same_username");
            } else {
                $new_name = mysqli_real_escape_string($connection, $new_name);
                $update_query = "UPDATE user_registration_table SET name = '$new_name' WHERE id = $user_id";
                $update_result = mysqli_query($connection, $update_query);
                if ($update_result) {
                    header("Location: change_username.html?message=username_change_successfull");
                } else {
                    echo "Username update failed.";
                }
            }
        } else {
            header("Location: change_username.html?message=wrong_password");
        }
    } else {
        echo "Error fetching user data.";
    }
}
?>
