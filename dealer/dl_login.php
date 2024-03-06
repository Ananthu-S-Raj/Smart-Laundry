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

    $sql = "SELECT id, password FROM dealer_registration_table WHERE email = '$email'";
    $result = mysqli_query($connection, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $id = $row['id'];
        $stored_password = $row['password'];

        if ($password === $stored_password) {
            session_start();
            $_SESSION['id'] = $id;
            $_SESSION['name'] = $name;
            header("Location:dealer_login.html?message=go_to_login");
            //header("Location: ad_home.html");
        } else {
            header("Location:dealer_login.html?message=wrong_pass");

        }
    } else {
        header("Location:dealer_login.html?message=incorrect_mail");
    }
} else {
    echo "Method mismatch";
}

mysqli_close($connection);
?>
