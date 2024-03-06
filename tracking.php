<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Smart Laundry</title>
    <link rel="icon" type="image/x-icon" href="media/favicon.png">
    <!-- Linking header CSS file -->
    <link rel="stylesheet" type="text/css" href="index.css" />
    <link rel="stylesheet" type="text/css" href="tracking.css"/>
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
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.raty/2.9.0/jquery.raty.min.js"></script>


    <style>
@import url(https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css);

*{
	margin: 0;
	padding: 0;
	box-sizing: border-box;
}

html,body{
	width: 100%;
	height: 100%;
}

body{
	font-family: Arial, sans-serif;
}

.container{
	display: flex;
	align-items: center;
	justify-content: center;
	height: 100%;
}

.rating-wrap{
	max-width: 480px;
	margin: auto;
	padding: 15px;
	box-shadow: 0 0 3px 0 rgba(0,0,0,.2);
	text-align: center;
}

.center{
	width: 162px; 
	margin: auto;
}


#rating-value{	
	width: 110px;
	margin: 40px auto 0;
	padding: 10px 5px;
	text-align: center;
	box-shadow: inset 0 0 2px 1px rgba(46,204,113,.2);
}

/*styling star rating*/
.rating{
	border: none;
	float: left;
}

.rating > input{
	display: none;
}

.rating > label:before{
	content: '\f005';
	font-family: FontAwesome;
	margin: 5px;
	font-size: 1.5rem;
	display: inline-block;
	cursor: pointer;
}

.rating > .half:before{
	content: '\f089';
	position: absolute;
	cursor: pointer;
}


.rating > label{
	color: #ddd;
	float: right;
	cursor: pointer;
}

.rating > input:checked ~ label,
.rating:not(:checked) > label:hover, 
.rating:not(:checked) > label:hover ~ label{
	color: #2ce679;
}

.rating > input:checked + label:hover,
.rating > input:checked ~ label:hover,
.rating > label:hover ~ input:checked ~ label,
.rating > input:checked ~ label:hover ~ label{
	color: #2ddc76;
}

    </style>

</head>

<body>
    <div class="header">
        <div class="logo">
            <img class="logo" src="media/logo1.png" alt="Logo" />
        </div>
        <div class="navigation">
            <div class="option">
                <a href="home.html">Back</a>
            </div>
        </div>
        <!-- Navigation menu ends here -->
    </div>
    <!-- End of header div -->

    <div class="main-background">
        <div class="data-field">
            <div class="heading">
                <p class="heading-note">Your slot bookings</p>
            </div>
            <div class="sub-container">
            <?php
session_start();
$host = "localhost";
$user = "root";
$password = "";
$database = "smart_laundry";

$connection = mysqli_connect($host, $user, $password, $database);
if (!$connection) {
    echo "Connection failed.";
    exit();
}
$user_id = $_SESSION['id'];
$query = "SELECT booking_id, company_name, booking_date_time, booking_status,cost FROM booking_table WHERE user_id = $user_id";
$result = mysqli_query($connection, $query);
if (mysqli_num_rows($result) > 0) {
    echo "<table class=\"booking-table\">";
    echo "<tr class=\"booking-table-row\">";
    echo "<th class=\"booking-table-heading\">Booking Id.</th>";
    echo "<th class=\"booking-table-heading\">Company name</th>";
    echo "<th class=\"booking-table-heading\">Booking time</th>";
    echo "<th class=\"booking-table-heading\">Booking status</th>";
    echo "<th class=\"booking-table-heading\">Affected cost</th>";
    echo "<th class=\"booking-table-heading\">Your Rating</th>";
    echo "</tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        $booking_id = $row['booking_id'];
        $company_name = $row['company_name'];
        $booking_date_time = $row['booking_date_time'];
        $booking_status = $row['booking_status'];
        $cost=$row['cost'];
        if($cost==0){
            $cost="Not declared";
        }else{
            $cost=$row['cost'];

        }
        // Define a class based on booking status
        $status_class = '';
        switch ($booking_status) {
            case 'Pending':
                $status_class = 'pending';
                break;
            case 'Pickup Initiated':
                $status_class = 'pickup-initiated';
                break;
            case 'Picked Up':
                $status_class = 'picked-up';
                break;
            case 'On Washing':
                $status_class = 'on-washing';
                break;
            case 'Ready for Delivery':
                $status_class = 'ready-for-delivery';
                break;
            case 'Delivered':
                $status_class = 'delivered';
                break;
            case 'Cancelled by Dealer':
                $status_class = 'cancelled';
                break;
            default:
                $status_class = ''; // Set a default class if status is not recognized
        }

 // Unique IDs for each row
 $uniqueId = "star-rating-$booking_id";

 echo "<tr class=\"$status_class\">";
 echo "<td class=\"booking-table-data\">$booking_id</td>";
 echo "<td class=\"booking-table-data\">$company_name</td>";
 echo "<td class=\"booking-table-data\">$booking_date_time</td>";
 echo "<td class=\"booking-table-data\">$booking_status</td>";
 echo "<td class=\"booking-table-data\">$cost</td>";
 ?>
 <td class="booking-table-data">
 <div class="center">
     <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
         <fieldset class="rating">
             <input type="radio" id="star5" name="rating" value="5" /><label for="star5" class="full"
                 title="Awesome"></label>
             <input type="radio" id="star4.5" name="rating" value="4.5" /><label for="star4.5"
                 class="half"></label>
             <input type="radio" id="star4" name="rating" value="4" /><label for="star4" class="full"></label>
             <input type="radio" id="star3.5" name="rating" value="3.5" /><label for="star3.5"
                 class="half"></label>
             <input type="radio" id="star3" name="rating" value="3" /><label for="star3" class="full"></label>
             <input type="radio" id="star2.5" name="rating" value="2.5" /><label for="star2.5"
                 class="half"></label>
             <input type="radio" id="star2" name="rating" value="2" /><label for="star2" class="full"></label>
             <input type="radio" id="star1.5" name="rating" value="1.5" /><label for="star1.5"
                 class="half"></label>
             <input type="radio" id="star1" name="rating" value="1" /><label for="star1" class="full"></label>
             <input type="radio" id="star0.5" name="rating" value="0.5" />
             <label for="star0.5"
                 class="half"></label>
                 </fieldset>
            <input type="submit" name="submit_rating" value="Submit Rating">
            <input type="hidden" name="booking_id" value="<?php echo $booking_id; ?>">
        </form>
    </div>
</td>
<?php




}
    
    echo "</table>";
} else {
    echo "<p>No bookings found.</p>";
}
// mysqli_close($connection);
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_rating'])) {
    if (isset($_POST['rating'])) {
        // Connect to the database using prepared statements
        $connection = mysqli_connect($host, $user, $password, $database);
        if (!$connection) {
            echo "Connection failed.";
            exit();
        }

        $user_id = $_SESSION['id'];
        $rating = $_POST['rating'];
        $booking_id = $_POST['booking_id'];

        // Use prepared statements to prevent SQL injection
        $updateQuery = "UPDATE dealer_registration_table SET rating = ? WHERE company_name = ?";
        $stmt = mysqli_prepare($connection, $updateQuery);
        
        // Bind parameters
        mysqli_stmt_bind_param($stmt, "is", $rating, $company_name);
        
        // Execute the update query
        $updateResult = mysqli_stmt_execute($stmt);
        if (!$updateResult) {
            echo "Error updating rating: " . mysqli_error($connection);
        } else {
            echo "<script>alert(\"Rating updated successfully!\");</script>";
        }

        // Close the prepared statement and the database connection
        mysqli_stmt_close($stmt);
        mysqli_close($connection);
    }
}
?>

                
            </div>


            <div class="end">
            </div>
        </div>
    </div>

    <div class="footer">
        <p class="copyright">© Copyright</p>
    </div>



</body>

</html>