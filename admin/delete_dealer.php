<?php
    $host="localhost";
    $user="root";
    $pass="";
    $database="smart_laundry";
    $connection=mysqli_connect($host,$user,$pass,$database);

    if(!$connection){
        die("Connection failed!");
    }
    if(isset($_GET['id'])){
    $dealer_id=mysqli_real_escape_string($connection,$_GET['id']);
      // Delete user from the database
      $delete_query = "DELETE FROM dealer_registration_table WHERE id = '$dealer_id'";
      $delete_result = mysqli_query($connection, $delete_query);
  
      if ($delete_result) {
          echo '<script>alert($dealer_id);</script>';
      } else {
          echo '<script>alert("Error deleting dealer.");</script>';
      }
  } else {
      echo '<script>alert("Invalid dealer ID.");</script>';
  }
  
  // Redirect back to the users_data.php page
  echo '<script>window.location.href="dealers_data.php";</script>';
  ?>
?>