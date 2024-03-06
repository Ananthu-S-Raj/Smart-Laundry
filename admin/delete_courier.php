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
    $courier_id=mysqli_real_escape_string($connection,$_GET['id']);
      // Delete user from the database
      $delete_query = "DELETE FROM courier_registration_table WHERE id = '$courier_id'";
      $delete_result = mysqli_query($connection, $delete_query);
  
      if ($delete_result) {
          echo '<script>alert($courier_id);</script>';
      } else {
          echo '<script>alert("Error deleting  agent.");</script>';
      }
  } else {
      echo '<script>alert("Invalid agent ID.");</script>';
  }
  
  // Redirect back to the users_data.php page
  echo '<script>window.location.href="courier_data.php";</script>';
  ?>
?>