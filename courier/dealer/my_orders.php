<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Smart Laundry</title>
    <link rel="icon" type="image/x-icon" href="media/favicon.png">
    <!-- Linking header CSS file -->
    <link rel="stylesheet" type="text/css" href="dl_index.css" />
    <link rel="stylesheet" type="text/css" href="my_orders.css"/>
    <link rel="stylesheet" type="text/css" href="confirmation_window.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
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
                <a href="dl_home.html">Back</a>
            </div>
        </div>
        <!-- Navigation menu ends here -->
    </div>
    <!-- End of header div -->

    <div class="main-background">
        <div class="data-field">
            <div class="heading">
                <p class="heading-note">Your have bookings from:</p>
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
$company_id = $_SESSION['id'];

$query = "SELECT booking_id,user_name, user_address,booking_date_time, booking_status FROM booking_table WHERE company_id = $company_id";
$result = mysqli_query($connection, $query);
if (mysqli_num_rows($result) > 0) {
    echo "<table class=\"booking-table\">";
    echo "<tr class=\"booking-table-row\">";
    echo "<th class=\"booking-table-heading\">Booking Id.</th>";
    echo "<th class=\"booking-table-heading\">User name</th>";
    echo "<th class=\"booking-table-heading\">User location</th>";
    echo "<th class=\"booking-table-heading\">Booking time</th>";
    echo "<th class=\"booking-table-heading\">Booking status</th>";
    echo "<th class=\"booking-table-heading\">Manage booking</th>";
    echo "</tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        $booking_id = $row['booking_id'];
        $user_name = $row['user_name'];
        $user_address = $row['user_address'];
        $booking_date_time = $row['booking_date_time'];
        $booking_status = $row['booking_status'];

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

        echo "<tr class=\"$status_class\">";
        echo "<td class=\"booking-table-data\">$booking_id</td>";
        echo "<td class=\"booking-table-data\">$user_name</td>";
        echo "<td class=\"booking-table-data\">$user_address</td>";
        echo "<td class=\"booking-table-data\">$booking_date_time</td>";
        echo "<td class=\"booking-table-data\">$booking_status</td>";
        echo '<td class="booking-table-data"><button class="buttons" onclick="acceptOrder(' . $booking_id . ', ' . $company_id . ')">Manage</button></td>';


        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>No bookings found.</p>";
}
mysqli_close($connection);
?>

                
            </div>


            <div class="end">
            </div>
        </div>
    </div>

    <div class="footer">
        <p class="copyright">© Copyright</p>
    </div>

        <!-- Modal -->
        <div id="customModal" class="modal">
    <span id="closeIcon" style="color:#FE0000;cursor: pointer;" class="material-symbols-outlined" onclick="closeModal()">cancel</span>
    <p><b>Accept order ?</b><br>By accepting, you have to choose a courier agent.</p>
    <button class="yes-btn" onclick="acceptOrderConfirmed()">Accept</button>
    <button class="no-btn" onclick="rejectOrder()">Reject</button>
</div>

<!-- Modal overlay -->
<div id="modalOverlay" class="modal-overlay"></div>
    <script>

        // Custom modal functions
        function acceptOrder(bookingId, companyId) {
    openModal();

    // Pass bookingId and companyId to variables accessible within acceptOrderConfirmed function
    window.bookingId = bookingId;
    window.companyId = companyId;
}


        function acceptOrderConfirmed() {
    // Access bookingId and companyId from the window object
    var bookingId = window.bookingId;
    var companyId = window.companyId;

    // Redirect to handle_order.php with both parameters
    window.location.href = "handle_order.php?booking_id=" + bookingId + "&company_id=" + companyId;
    
    // Close the modal
    closeModal();
}
        function rejectOrder() {
    // Access bookingId and companyId from the window object
    var bookingId = window.bookingId;
    var companyId = window.companyId;

    // Redirect to handle_order.php with both parameters
    window.location.href = "reject_order.php?booking_id=" + bookingId + "&company_id=" + companyId;
    
    // Close the modal
    closeModal();
}

        function openModal() {
            document.getElementById('customModal').style.display = 'block';
            document.getElementById('modalOverlay').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('customModal').style.display = 'none';
            document.getElementById('modalOverlay').style.display = 'none';
        }
        function closeModal() {
        document.getElementById('customModal').style.display = 'none';
        document.getElementById('modalOverlay').style.display = 'none';
    }
    </script>

</body>

</html>