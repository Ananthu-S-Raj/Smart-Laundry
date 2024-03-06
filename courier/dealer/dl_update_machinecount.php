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

    if (isset($_SESSION['company_id'])) {
        $company_id = $_SESSION['company_id'];
    } else {
        echo "Can't get company id.";
    }


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['new_count'])) {
        $new_count = $_POST['new_count'];
    }
    if (isset($_POST['form_password'])) {
        $form_password = $_POST['form_password'];
    }

    $query = "SELECT * FROM dealer_registration_table WHERE id = $company_id";

    $result = mysqli_query($connection, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $password = $row['password'];
        // $old_email = $row['email'];

        if ($password === $form_password) {

                $new_count = mysqli_real_escape_string($connection, $new_count);
                $update_query = "UPDATE dealer_registration_table SET machine_count = '$new_count' WHERE id = $company_id";
                $update_result = mysqli_query($connection, $update_query);
                if ($update_result) {
                    header("Location: dl_update_machinecount.html?message=count_updated");
                } else {
                    echo "Machine count update failed.";
                }
        } else {
            header("Location:dl_update_machinecount.html?message=wrong_password");
        }
    } else {
        echo "Error fetching usercompany data.";
    }
}
?>
