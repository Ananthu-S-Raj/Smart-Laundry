<?php
// Check if the user is logged in and carries the user id

session_start();
if (!isset($_SESSION['id'])) {
    header("Location: user_login.html");
    exit();
}
//

$host = "localhost";
$user = "root";
$pass = "";
$database = "smart_laundry";

$connection = mysqli_connect($host, $user, $pass, $database);
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

$user_id = $_SESSION['id'];
$user_name = $_SESSION['name'];
$user_address = $_SESSION['address'];
$company_id = $_POST['companyId'];
$company_name = $_POST['companyName'];
$booking_status = $_POST['bookingStatus'];
$booking_date_time = date('Y-m-d H:i:s'); // Current date and time in MySQL format

// Perform the database insertion
$query = "INSERT INTO booking_table (user_id,user_name,user_address, company_id,company_name,booking_date_time, booking_status) VALUES ('$user_id','$user_name','$user_address', '$company_id','$company_name','$booking_date_time', '$booking_status')";
$result = mysqli_query($connection, $query);

// Check if the insertion was successful
if ($result) {
    echo "<script>
            alert('Booking successful!');
            window.location.href='home.html';
          </script>";
} else {
    echo "Error: " . mysqli_error($connection);
}

// Close the database connection
mysqli_close($connection);
?>
