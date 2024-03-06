<?php
session_start();

$host = "localhost";
$user = "root";
$password = "";
$database = "smart_laundry";

$connection = mysqli_connect($host, $user, $password, $database);

if (!$connection) {
    echo "Connection failed.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $booking_id = $_POST["booking_id"];
    $new_status = $_POST["update"];
    $weight = $_POST["weight"];
    $company_id = $_POST["company_id"];

    if ($new_status == "Delivered") {
        $update_query = "UPDATE dealer_registration_table SET available_machines = available_machines + 1 WHERE id = '$company_id'";
        $count_execute = mysqli_query($connection, $update_query);
    }
    

    $update_query = "UPDATE booking_table SET booking_status = '$new_status' WHERE booking_id = '$booking_id'";
    mysqli_query($connection, $update_query);

    // Check if weight is not empty before proceeding with weight-related updates
    if (!empty($weight)) {
        $company_query = "SELECT company_id FROM booking_table WHERE booking_id = '$booking_id'";
        $company_result = mysqli_query($connection, $company_query);
        $company_row = mysqli_fetch_assoc($company_result);

        // Check if $company_row is not empty before using it
        if ($company_row) {
            $company_id = $company_row['company_id'];

            $pricing_query = "SELECT pricing FROM dealer_registration_table WHERE id = '$company_id'";
            $pricing_result = mysqli_query($connection, $pricing_query);
            $pricing_row = mysqli_fetch_assoc($pricing_result);

            // Check if $pricing_row is not empty before using it
            if ($pricing_row) {
                $pricing = $pricing_row['pricing'];

                $cost = $weight * $pricing;

                $cost_update_query = "UPDATE booking_table SET cost = '$cost' WHERE booking_id = '$booking_id'";
                mysqli_query($connection, $cost_update_query);

                echo "<script>alert(\"Weight and price updated\");</script>";
                echo "<script>window.location.href=\"c_orders.php\"</script>";
                


            } else {
                echo "Pricing information not found for dealer ID: $company_id";
            }
        } else {
            echo "Dealer information not found for booking ID: $booking_id";
        }
    } else {
        // If weight is empty, do nothing
        // echo "<script>alert(\"Weight is empty. No updates performed.\");</script>";
        echo "<script>alert(\"Status updated.\");</script>";
        echo "<script>window.location.href=\"c_orders.php\"</script>";
    }
}

mysqli_close($connection);
?>
