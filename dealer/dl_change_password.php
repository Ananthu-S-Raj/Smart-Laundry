<?php
$host="localhost";
$user="root";
$pass="";
$database="smart_laundry";
$connection=mysqli_connect($host,$user,$pass,$database);
if(!$connection){
    echo "Connection failed";
}
     session_start(); // Start the session

if (isset($_SESSION['id'])) {
    $company_id = $_SESSION['id'];
    
    //echo "user id is : ".$user_id;

} else {
    echo "Can't get company id.";
}

if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(isset($_POST['old_password'])){
        $old_password=$_POST['old_password'];
    }
    if(isset($_POST['pass'])){
        $pass=$_POST['pass'];
    }
    if(isset($_POST['new_password'])){
        $new_password=$_POST['new_password'];
    }

    
        $query="SELECT * FROM dealer_registration_table WHERE id=$company_id";

        $result=mysqli_query($connection,$query);

        if($result){
            $row=mysqli_fetch_assoc($result);//to retrive one row data retriveby the query

            $current_password=$row['password'];
            
            if($old_password==$current_password){
                if($new_password==$current_password){

                    header("Location: dl_change_password.html?message=dl_same_passwords");

                }else{
                $new_password = mysqli_real_escape_string($connection, $new_password);
                $update_query = "UPDATE dealer_registration_table  SET password = '$new_password' WHERE id = $company_id";
                $update_result = mysqli_query($connection, $update_query);
                if ($update_result) {
                    //echo "Password changed successfully.";
                    header("Location: dl_change_password.html?message=dl_password_change_successfull");

                 } else {
                    echo "Password update failed.";
                }
            }
            } else {
                header("Location: dl_change_password.html?message=dl_wrong_current_password");

            }
        
        } else {
            echo "Error fetching admin data.";
        }

}
?>