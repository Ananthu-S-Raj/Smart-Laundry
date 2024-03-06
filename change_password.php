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

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    
    //echo "user id is : ".$user_id;

} else {
    echo "Can't get user id.";
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

    
        $query="SELECT * FROM user_registration_table WHERE id=$user_id";

        $result=mysqli_query($connection,$query);

        if($result){
            $row=mysqli_fetch_assoc($result);//to retrive one row data retriveby the query

            $current_password=$row['password'];
            
            if($old_password==$current_password){
                if($new_password==$current_password){
                    echo "<script>
            window.location.href = 'change_password.html?message=same_passwords';
            </script>";

                //  echo "<script>
                // alert('Old password and new password cannot be the same!');
                // setTimeout(function() { 
                //     window.location.href = 'change_password.html'
                // }, 1.000);</script>";

                }else{
                $new_password = mysqli_real_escape_string($connection, $new_password);
                $update_query = "UPDATE user_registration_table SET password = '$new_password' WHERE id = $user_id";
                $update_result = mysqli_query($connection, $update_query);
                if ($update_result) {
                    //echo "Password changed successfully.";
                    echo "<script>
            window.location.href = 'change_password.html?message=password_change_successfull';
            

            </script>";
                //     echo "<script>
                // setTimeout(function() { 
                // window.location.href = 'change_password.html'
                // },0000);
                // alert('Password changed successfully.');
                // </script>";
                 } else {
                    echo "Password update failed.";
                }
            }
            } else {
            echo "<script>
            window.location.href = 'change_password.html?message=wrong_current_password';
            </script>";

                // echo "<script>
                // alert('Wrong Current Password!');
                // window.location.href = 'change_password.html';
                // </script>";
            }
        
        } else {
            echo "Error fetching user data.";
        }

}
?>