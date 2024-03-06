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
    // $session_password = $_SESSION['password'];
} else {
    echo "Can't get admin id.";
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

    
    $query = "SELECT * FROM admin_table WHERE id = $admin_id";

    $result = mysqli_query($connection, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $password = $row['password'];
        $old_name = $row['name'];

        if ($password === $form_password) {

            if ($old_name === $new_name) {
                header("Location: ad_change_username.html?message=same_adminname");
            } else {
                $new_name = mysqli_real_escape_string($connection, $new_name);
                $update_query = "UPDATE admin_table SET name = '$new_name' WHERE id = $admin_id";
                $update_result = mysqli_query($connection, $update_query);
                if ($update_result) {
                    header("Location: ad_change_username.html?message=adminname_change_successfull");
                } else {
                    echo "Username update failed.";
                }
            }
        } else {
            header("Location: ad_change_username.html?message=wrong_password");
        }
    } else {
        echo "Error fetching user data.";
    }
}
?>
