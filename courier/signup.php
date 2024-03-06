<?php
$host="localhost";
$user="root";
$pass="";
$database="smart_laundry";
//varyfing essentials
$connection=mysqli_connect($host,$user,$pass,$database);
if($connection){
    echo "Connection Successfull<br>";
}else{
    die ("Connection Failed<br>");
} 
//checking request method
if($_SERVER["REQUEST_METHOD"]=="POST"){
    //assigning values to variables
    $name=$_POST['name'];
    $phone=$_POST['phone'];
    $email=$_POST['email'];
    $address=$_POST['address'];
    $pwd=$_POST['pwd'];
    $password=$_POST['password'];

    //validation
    if(empty($name)||empty($phone)||empty($email)||empty($address)||empty($password)){
        die("All fields must be filled<br>");
    }
     // Check if the email already exists in the table
     $checkEmailQuery = "SELECT email FROM user_registration_table WHERE email = '$email'";
     $result = mysqli_query($connection, $checkEmailQuery);
 
     if (mysqli_num_rows($result) > 0) {
        header("Location: user_signup.html?message=email_exists");

         //echo "Email already exists. Please use a different email.";
     } else {
         // Insert data if email doesn't exist
    $sql="INSERT INTO user_registration_table(name,phone,email,address,password) VALUES('$name','$phone','$email','$address','$password')";
    if(mysqli_query($connection,$sql)){
        echo "Data inserted Successfully<br>";
        //Here we can add redirection
         header("Location: user_login.html");

    }else{
        header("Location: user_login.html?message=data_insertion_failed");

        //echo"<script>alert('Data insertion failed!');</script>";
    }
    }

}else{
    echo "Method mismatch!";
}

mysqli_close($connection);
?> 