<?php
session_start();

$host = "localhost";
$user = "root";
$password = "";
$dbname = "mini_project";
$conn = mysqli_connect($host, $user, $password, $dbname);

if (!$conn) {
    die("Could not connect to the database");
}

// Assuming the user_id is stored in a session variable

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Fetch the user's location from the user_registration_table
    $user_location_sql = "SELECT address FROM user_registration_table WHERE id = ?";
    $stmt = mysqli_prepare($conn, $user_location_sql);
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    $user_location_result = mysqli_stmt_get_result($stmt);

    if ($user_location_result && mysqli_num_rows($user_location_result) > 0) {
        $user_location_row = mysqli_fetch_assoc($user_location_result);
        $user_chosen_location = $user_location_row['address']; // Corrected column name

        // Validate the chosen location against allowed values
        $allowed_locations = ['Aluva', 'kalamassery', 'kaloor', 'south', 'vyttila'];
        if (!in_array($user_chosen_location, $allowed_locations)) {
            die("Invalid user location.");
        }

        // Fetch distances from the chosen location to all laundry shops from the distance table
        $distances_sql = "SELECT dealer_registration_table.id, dealer_registration_table.name, dealer_registration_table.machine_count, dealer_registration_table.price, dealer_registration_table.location, distance." . $user_chosen_location . " AS distance
                          FROM dealer_registration_table
                          INNER JOIN distance ON dealer_registration_table.address = distance.place
                          WHERE dealer_registration_table.machine_count > 0 AND distance." . $user_chosen_location . " <= 15
                          ORDER BY distance." . $user_chosen_location . " ASC";

        $distances_result = mysqli_query($conn, $distances_sql);

        if ($distances_result) {
            if (mysqli_num_rows($distances_result) > 0) {
                while ($row = mysqli_fetch_assoc($distances_result)) {
                    echo "Shop Id: " . $row['id'] . "<br>"; // Corrected column name
                    echo "Shop Name: " . $row['name'] . "<br>";
                    echo "Machine Count: " . $row['machine_count'] . "<br>";
                    echo "Price: " . $row['price'] . "<br>";
                    echo "Location: " . $row['location'] . "<br>";
                    echo "Distance: " . $row['distance'] . " km<br>";
                    echo '<a href="user_laundry_reg.php?shop_id=' . $row['id'] . '">Order Placement</a><br>'; // Corrected column name

                    // Set the shop_id in the session only if it's not already set
                    if (!isset($_SESSION['shop_id'])) {
                        $_SESSION['shop_id'] = $row['id']; // Corrected column name
                    }

                    // Link to booking page
                    echo "<br>";
                }
            } else {
                echo "No matching laundry shops found within 15 km.";
            }
        } else {
            echo "Error in the database query.";
        }
    } else {
        echo "User location not found in user_registration_table.";
    }
} else {
    echo "User ID not found in session.";
}

// Close the database connection
mysqli_close($conn);
?>
