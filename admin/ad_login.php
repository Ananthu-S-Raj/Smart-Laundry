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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT id, password FROM admin_table WHERE email = '$email'";
    $result = mysqli_query($connection, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $id = $row['id'];
        $stored_password = $row['password'];

        if ($password === $stored_password) {
            session_start();
            $_SESSION['id'] = $id;
            header("Location: ad_home.html");
        } else {
            echo "Login failed. Please check your credentials.";
        }
    } else {
        echo "Admin not found. Please check your email address.";
    }
} else {
    echo "Method mismatch";
}

mysqli_close($connection);
?>
