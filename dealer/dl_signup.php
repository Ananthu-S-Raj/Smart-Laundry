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
    $company_name=$_POST['company_name'];
    $phone=$_POST['phone'];
    $email=$_POST['email'];
    $machine_count=$_POST['machine_count'];
    $pricing=$_POST['pricing'];
    $address=$_POST['address'];
    $pwd=$_POST['pwd'];
    $password=$_POST['password'];

 // Check if the email already exists in the table
 $checkEmailQuery = "SELECT email FROM dealer_registration_table WHERE email = '$email'";
 $result = mysqli_query($connection, $checkEmailQuery);

 if (mysqli_num_rows($result) > 0) {
    header("Location: dealer_signup.html?message=account_exists");

     //echo "Email already exists. Please use a different email.";
 } else {

    $sql="INSERT INTO dealer_registration_table(name,company_name,phone,email,address,machine_count,pricing,password) VALUES('$name','$company_name','$phone','$email','$address','$machine_count','$pricing','$password')";
    if(mysqli_query($connection,$sql)){
        echo "Data inserted Successfully<br>";
        //Here we can add redirection
        header("Location:dealer_signup.html?message=account_created");
    

    }else{
        header("Location:dealer_signup.html?message=account_creation_failed");

        //echo"<script>alert('Data insertion failed!');</script>";

    }
 }
}else{
    echo "Method mismatch!";
}

mysqli_close($connection);
?> 