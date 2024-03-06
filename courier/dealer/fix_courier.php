<?php
// fix_courier.php

$host = "localhost";
$user = "root";
$pass = "";
$database = "smart_laundry";

$connection = mysqli_connect($host, $user, $pass, $database);
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['booking_id']) && isset($_GET['courier_id'])) {
    $bookingId = $_GET['booking_id'];
    $courierId = $_GET['courier_id'];

    // Retrieve courier details
    $queryCourier = "SELECT * FROM courier_registration_table WHERE id = $courierId";
    $resultCourier = mysqli_query($connection, $queryCourier);
    $rowCourier = mysqli_fetch_assoc($resultCourier);

    // Update booking status and store courier name
    $courierName = $rowCourier['name'];
    $queryUpdate = "UPDATE booking_table SET booking_status = 'confirmed', courier_name = '$courierName' WHERE booking_id = $bookingId";

    if (mysqli_query($connection, $queryUpdate)) {
        echo "<script>alert(\"Order accepted and alloted a agent.\");</script>";
        echo "<script>window.location.href=\"my_orders.php\"</script>";
        // echo "Booking updated successfully.";
    } else {
        echo "Error updating booking: " . mysqli_error($connection);
    }
} else {
    echo "Missing parameters: ";
    echo isset($_GET['booking_id']) ? '' : 'booking_id ';
    echo isset($_GET['courier_id']) ? '' : 'courier_id';
}

mysqli_close($connection);
?>
