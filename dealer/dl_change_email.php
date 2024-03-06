<?php
$host = "localhost";
$user = "root";
$pass= "";
$database = "smart_laundry";
$connection = mysqli_connect($host, $user, $pass, $database);
if (!$connection) {
    echo "Connection failed";
    exit;
}
    session_start();

    if (isset($_SESSION['id'])) {
        $company_id = $_SESSION['id'];
    } else {
        echo "Can't get company id.";
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

    
    $query = "SELECT * FROM dealer_registration_table WHERE id = $company_id";

    $result = mysqli_query($connection, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $password = $row['password'];
        $old_email = $row['email'];
        $company_id = $row['id'];

        if ($password === $form_password) {

            if ($old_email === $new_email) {
                header("Location: dl_change_email.html?message=dl_same_email");
            } else {
                $new_email = mysqli_real_escape_string($connection, $new_email);
                $update_query = "UPDATE dealer_registration_table SET email = '$new_email' WHERE id = $company_id";
                $update_result = mysqli_query($connection, $update_query);
                if ($update_result) {
                    header("Location: dl_change_email.html?message=dl_email_change_successfull");
                } else {
                    echo "Email update failed.";
                }
            }
        } else {
            header("Location: dl_change_email.html?message=wrong_password");
        }
    } else {
        echo "Error fetching admin data.";
    }
}
?>
