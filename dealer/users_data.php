<?php
$host="localhost";
$user="root";
$pass="";
$database="smart_laundry";

    $connection=mysqli_connect($host,$user,$pass,$database);
if(!$connection){
    die("connection failed".mysqli_connect_error());
}

$query="SELECT * FROM user_registration_table";
$result=mysqli_query($connection,$query);

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Smart Laundary</title>
    <!-- Linking header CSS file -->
    <link rel="stylesheet" type="text/css" href="ad_index.css" />
    <link rel="stylesheet" type="text/css" href="users_data.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&display=swap" rel="stylesheet">  </head>

  <body>
      <div class="header">
        <div class="logo">
          <img class="logo" src="media/logo1.png" />
        </div>
        <div class="navigation">
          <div class="option">
            <a href="ad_home.html">Home</a>
          </div>
          <div class="option">
            <a href="ad_home.html">Back</a>
          </div>
        </div>
        <!--Navigation menu ends here-->
      </div>
      <!--End of header div-->
      <div class="main-background">
         <div class="data-field">
           <div class="heading">
             <p class="heading-note">Users Data</p>
           </div>
           <table>
            <tr>
            <th>User id</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Address</th>
            </tr>
            <?php
                  while($row=mysqli_fetch_assoc($result)){
                     echo"<tr>";
                     echo"<td>" .$row['id']. "</td>";
                     echo"<td>" .$row['name']. "</td>";
                     echo"<td>" .$row['phone']. "</td>";
                     echo"<td>" .$row['email']. "</td>";
                     echo"<td>" .$row['address']. "</td>";
                     echo"</tr>";
                  }
            ?>
           </table>
           <div class="end">
                  <p class="end_note">Smart Laundary</p>
           </div>
        
         </div>
       </div>
       




      <div>
        <div class="footer">
          <p class="copyright">© Copyright</p>
        </div>
      </div>

    <script src="caurosel.js"></script>
  </body>
</html>
