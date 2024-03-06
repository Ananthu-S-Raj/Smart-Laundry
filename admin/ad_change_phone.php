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
        echo "Can't get admin id.";
        echo "Can't get admin password.";
    }


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['new_phone'])) {
        $new_phone = $_POST['new_phone'];
    }
    if (isset($_POST['form_password'])) {
        $form_password = $_POST['form_password'];
    }

    $query = "SELECT * FROM admin_table WHERE id = $admin_id";

    $result = mysqli_query($connection, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $password = $row['password'];
        // $old_email = $row['email'];

        if ($password === $form_password) {

                $new_address = mysqli_real_escape_string($connection, $new_address);
                $update_query = "UPDATE admin_table SET phone = '$new_phone' WHERE id = $admin_id";
                $update_result = mysqli_query($connection, $update_query);
                if ($update_result) {
                    header("Location: ad_change_phone.html?message=ad_address_change_successfull");
                } else {
                    echo "phone number update failed.";
                }
        } else {
            header("Location: ad_change_phone.html?message=wrong_password");
        }
    } else {
        echo "Error fetching user data.";
    }
}
?>
