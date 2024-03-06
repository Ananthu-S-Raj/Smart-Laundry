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
    if (isset($_POST['new_address'])) {
        $new_address = $_POST['new_address'];
    }
    if (isset($_POST['form_password'])) {
        $form_password = $_POST['form_password'];
    }

    $query = "SELECT * FROM user_registration_table WHERE id = $user_id";

    $result = mysqli_query($connection, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $password = $row['password'];
        // $old_email = $row['email'];

        if ($password === $form_password) {

                $new_address = mysqli_real_escape_string($connection, $new_address);
                $update_query = "UPDATE user_registration_table SET address = '$new_address' WHERE id = $user_id";
                $update_result = mysqli_query($connection, $update_query);
                if ($update_result) {
                    header("Location: change_address.html?message=address_change_successfull");
                } else {
                    echo "Username update failed.";
                }
        } else {
            header("Location: change_address.html?message=wrong_password");
        }
    } else {
        echo "Error fetching user data.";
    }
}
?>
