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
        echo "Can't get company id.";
    }

 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['new_phone'])) {
        $new_phone = $_POST['new_phone'];
    }
    if (isset($_POST['form_password'])) {
        $form_password = $_POST['form_password'];
    }

    $query = "SELECT * FROM courier_registration_table WHERE id = $courier_id";

    $result = mysqli_query($connection, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $password = $row['password'];
        // $old_email = $row['email'];

        if ($password === $form_password) {

                $new_phone = mysqli_real_escape_string($connection, $new_phone);
                $update_query = "UPDATE courier_registration_table SET phone = '$new_phone' WHERE id = $courier_id";
                $update_result = mysqli_query($connection, $update_query);
                if ($update_result) {
                    header("Location: c_change_phone.html?message=c_phone_number_change_successfull");
                } else {
                    echo "phone number update failed.";
                }
        } else {
            header("Location: c_change_phone.html?message=wrong_password");
        }
    } else {
        echo "Error fetching company data.";
    }
}
?>
