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

    $sql = "SELECT id, name,address,password FROM user_registration_table WHERE email = '$email'";
    $result = mysqli_query($connection, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $id = $row['id'];
        $name = $row['name'];
        $address = $row['address'];
        $stored_password = $row['password'];

        if ($password === $stored_password) {
            session_start();
            $_SESSION['id'] = $id;
            $_SESSION['name'] = $name;
            $_SESSION['address'] = $address;



                        header("Location: home.html");
                        exit();
        } else {
            header("Location:user_login.html?message=wrong_password");
            //echo "Login failed. Please check your password.";
        }
    } else {
        header("Location:user_login.html?message=wrong_email");
        //echo "User not found.<br>Please check your email address.";

    }
} else {
    echo "Method mismatch";
}

mysqli_close($connection);
?>
 