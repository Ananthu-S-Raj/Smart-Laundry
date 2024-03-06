<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Smart Laundry</title>
    <link rel="icon" type="image/x-icon" href="media/favicon.png">
    <!-- Linking header CSS file -->
    <link rel="stylesheet" type="text/css" href="index.css" />
    <link rel="stylesheet" type="text/css" href="booking_list.css" />
    <link rel="stylesheet" type="text/css" href="book_slot.css" />
    <link rel="stylesheet" type="text/css" href="confirmation_box.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@100;600&family=Roboto:wght@500;700&family=Work+Sans&display=swap"
        rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nova+Square&display=swap" rel="stylesheet">


</head>

<body>
    <div class="header">
        <div class="logo">
            <img class="logo" src="media/logo1.png" alt="Logo" />
        </div>
        <div class="navigation">
            <div class="option">
                <a href="booking_list.php">Back</a>
            </div>
        </div>
        <!-- Navigation menu ends here -->
    </div>
    <!-- End of header div -->

    <div class="main-background">
        <div class="data-field">
            <div class="heading">
                <p class="heading-note">Available Laundry Centers</p>
            </div>
            <div class="sub-container">
    <div class="left">
        <div class="video">
            <video class="video-file" autoplay loop src="media/machine1vid.mp4"></video>
        </div>
        <div class="details">
                        <?php
                        $host = "localhost";
                        $user = "root";
                        $pass = "";
                        $database = "smart_laundry";
        
                        $connection = mysqli_connect($host, $user, $pass, $database);
                        if (!$connection) {
                            die("Connection failed: " . mysqli_connect_error());
                        }
                        $id = $_GET['id']; //to retrieve the 'id' parameter from the URL
                        $query = "SELECT * FROM dealer_registration_table WHERE id = '$id'";                        
        
                        $result = mysqli_query($connection, $query);
        
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<div class="card">';
                                echo '<div class="container">';
                                echo '<b class="c-name">' . $row['company_name'] . '</b>';
                                $company_name = $row['company_name'];                                
                                echo '<p>Address: ' . $row['address'] . '</p>';
                                echo '<p>Email: ' . $row['email'] .'</p>';
                                echo '<p>Pricing: ₹ ' . $row['pricing'] . '/kg</p>';
                                echo '<p>Machines available: ' . $row['available_machines'] . '</p>';
                                echo '<p>Rating: ' . $row['rating'] . '<span class="material-symbols-outlined">star</span></p>';
                                echo '</div>';
                                echo '</div>';
                                
                            }
                        } else {
                            echo '<script>alert("No dealer found with that ID.");</script>';
                             echo '<script>window.location.href = "dealers_data.php";</script>';
        
                        }
                        ?>

</div>
    </div>
    <div class="right">
        <p class="booking-heading">Book your slot here</p>
        <p class="information">Cloth weight and amount will be calculated and informed by the delivery agent</p>

        <form id="yourFormId" method="post" action="book_slot_handler.php" onsubmit="event.preventDefault(); openModal()">    <input type="hidden" name="userId" value=""> <!-- Replace with the actual user ID -->
    <input type="hidden" name="companyId" value="<?php echo $id; ?>">
    <input type="hidden" name="companyName" value="<?php echo $company_name;?>">
    <input type="hidden" name="bookingStatus" value="Pending"> <!-- Set the desired initial booking status -->
    <input id="confirm-order-btn" type="submit" value="Book my slot">
</form>


    </div>
</div>


            <div class="end">
            </div>
        </div>
    </div>

    <div class="footer">
        <p class="copyright">© Copyright</p>
    </div>

<!------------------------------------------------------------------------->
<!-- Confirmation window -->
<div id="customModal" class="modal">
    <div class="modal-content">
        <!-- <span class="close" onclick="closeModal()">&times;</span> -->
        <p>Are you sure you want to book this slot?</p>
        <button class="yes-btn" onclick="confirmBooking()">Yes</button>
        <button class="no-btn" onclick="closeModal()">No</button>
    </div>
</div>
<script>
 function openModal() {
     document.getElementById("customModal").style.display = "block";
 }

 function closeModal() {
     document.getElementById("customModal").style.display = "none";
 }

 function confirmBooking() {

     // If the user confirms, proceed with the form submission
     document.getElementById("yourFormId").submit();
 }
</script>

</body>

</html>