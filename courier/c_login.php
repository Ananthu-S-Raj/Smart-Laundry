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

    $sql = "SELECT id, name, password FROM courier_registration_table WHERE email = '$email'";
    $result = mysqli_query($connection, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $id = $row['id'];
        $name = $row['name']; // Use the 'name' column
        $stored_password = $row['password'];
    
        if ($password === $stored_password) {
            session_start();
            $_SESSION['id'] = $id;
            $_SESSION['name'] = $name;
            header("Location:c_login.html?message=go_to_login");
        } else {
            header("Location:c_login.html?message=wrong_pass");
        }
    } else {
        header("Location:c_login.html?message=incorrect_mail");
    }
}    
