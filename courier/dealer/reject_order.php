<?php
$host = "localhost";
$user = "root";
$pass = "";
$database = "smart_laundry";

$connection = mysqli_connect($host, $user, $pass, $database);
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['booking_id'])) {
    $bookingId = $_GET['booking_id'];

    $query = "UPDATE booking_table SET booking_status='Rejected!' WHERE booking_id=$bookingId";

    $result = mysqli_query($connection, $query);
    
    if ($result) {
        echo '<script>alert("Order rejected");</script>';
        echo '<script>window.location.href="my_orders.php";</script>';
    } else {
        echo '<script>alert("Rejection failed");</script>';
        echo '<script>window.location.href="my_orders.php";</script>';
    }
} else {
    echo "Booking ID not provided in the URL.";
    exit;
}
?>
