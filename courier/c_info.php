<?php
$host = "localhost";
$user = "root";
$pass = "";
$database = "smart_laundry";

$connection = mysqli_connect($host, $user, $pass, $database);

if (!$connection) {
    echo "Connection Failed<br>";
    die();
}
 
// Check if a user is logged in and has a valid session
session_start();
if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];

    // Retrieve user data based on the user's ID
    $query = "SELECT * FROM courier_registration_table WHERE id = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        $courier_data = mysqli_fetch_assoc($result);

        $_SESSION['id'] = $id;//to store id in &_sesssion,so we can use it in another pages by starting session
        include('c_account_page.html');//transferring data to account_page
        
    } else {
        echo "User not found";
    }

    mysqli_stmt_close($stmt);
} else {
    echo "You are not logged in. Please log in to view your account information.";
}

mysqli_close($connection);
?>