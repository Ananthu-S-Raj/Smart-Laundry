<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Smart Laundry</title>
    <link rel="icon" type="image/x-icon" href="media/favicon.png">
    <!-- Linking header CSS file -->
    <link rel="stylesheet" type="text/css" href="dl_index.css" />
    <link rel="stylesheet" type="text/css" href="c_orders.css"/>
    <link rel="stylesheet" type="text/css" href="confirmation_window.css" />
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
                <a href="c_home.html">Back</a>
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
        $courier_name = $_SESSION['name'];

        $query = "SELECT booking_id, user_name, user_address, booking_date_time, booking_status, company_id FROM booking_table WHERE courier_name = '$courier_name'";
        $result = mysqli_query($connection, $query);
        

        if (mysqli_num_rows($result) > 0) {
            echo "<table class=\"booking-table\">";
            echo "<tr class=\"booking-table-row\">";
            echo "<th class=\"booking-table-heading\">Booking Id.</th>";
            echo "<th class=\"booking-table-heading\">User name</th>";
            echo "<th class=\"booking-table-heading\">User location</th>";
            echo "<th class=\"booking-table-heading\">Booking time</th>";
            echo "<th class=\"booking-table-heading\">Booking status</th>";
            echo "<th class=\"booking-table-heading\">Update status</th>";
            echo "</tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                $booking_id = $row['booking_id'];
                $user_name = $row['user_name'];
                $user_address = $row['user_address'];
                $booking_date_time = $row['booking_date_time'];
                $booking_status = $row['booking_status'];
                $company_id = $row['company_id'];
                $status_class = getStatusClass($booking_status);

                echo "<tr class=\"$status_class\">";
                echo "<td class=\"booking-table-data\">$booking_id</td>";
                echo "<td class=\"booking-table-data\">$user_name</td>";
                echo "<td class=\"booking-table-data\">$user_address</td>";
                echo "<td class=\"booking-table-data\">$booking_date_time</td>";
                echo "<td class=\"booking-table-data\">$booking_status</td>";
                echo "<td class=\"status-menu\">";
                echo "<form action=\"update_status.php\" method=\"post\">";
                echo "<select name=\"update\" id=\"status\">";
                echo "<option value=\"Waiting\">Select status</option>";
                echo "<option value=\"Pickup initiated\">Pickup initiated</option>";
                echo "<option value=\"Picked up\">Picked up</option>";
                echo "<option value=\"Washing\">On washing</option>";
                echo "<option value=\"Ready for delivery\">Ready for delivery</option>";
                echo "<option value=\"Delivered\">Delivered</option>";
                echo "</select>";
                echo "<input type=\"text\" name=\"weight\" placeholder=\"Enter weight\">";
                echo "<input type=\"text\" hidden name=\"booking_id\" value=\"$booking_id\">";
                echo "<input type=\"text\" hidden name=\"company_id\" value=\"$company_id\">";
                echo "<input type=\"submit\" class=\"submit-btn\" value=\"Update\">";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No bookings found.</p>";
        }
        mysqli_close($connection);

        function getStatusClass($booking_status) {
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
                    $status_class = '';
            }
            return $status_class;
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