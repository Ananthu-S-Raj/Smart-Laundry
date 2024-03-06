<?php
$host="localhost";
$user="root";
$pass="";
$database="smart_laundry";
//varyfing essentials
$connection=mysqli_connect($host,$user,$pass,$database);
if(!$connection){
    die ("Connection Failed<br>");
} 
//checking request method
if($_SERVER["REQUEST_METHOD"]=="POST"){
    //assigning values to variables
    $name=$_POST['name'];
    $phone=$_POST['phone'];
    $email=$_POST['email'];
    $address=$_POST['address'];
    $password=$_POST['password'];

 // Check if the email already exists in the table
 $checkEmailQuery = "SELECT email FROM courier_registration_table WHERE email = '$email'";
 $result = mysqli_query($connection, $checkEmailQuery);

 if (mysqli_num_rows($result) > 0) {
    header("Location: c_signup.html?message=account_exists");

     //echo "Email already exists. Please use a different email.";
 } else {

    $sql="INSERT INTO courier_registration_table(name,phone,email,address,password) VALUES('$name','$phone','$email','$address','$password')";
    if(mysqli_query($connection,$sql)){
        // echo "Data inserted Successfully<br>";
        //Here we can add redirection
// echo "<script>alert(\"Account created.You can login\");window.location.href(\"c_login.html\");</script>";
        header("Location:c_signup.html?message=account_created");
    

    }else{
        header("Location:c_signup.html?message=account_creation_failed");

        //echo"<script>alert('Data insertion failed!');</script>";

    }
 }
}else{
    echo "Method mismatch!";
}

mysqli_close($connection);
?> 