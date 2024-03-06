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

    // Fetch the user's location from the user_reg table
    $user_location_sql = "SELECT location FROM user_reg WHERE user_id = '$user_id'";
    $user_location_result = mysqli_query($conn, $user_location_sql);

    if ($user_location_result && mysqli_num_rows($user_location_result) > 0) {
        $user_location_row = mysqli_fetch_assoc($user_location_result);
        $user_chosen_location = $user_location_row['location'];

        // Validate the chosen location against allowed values
        $allowed_locations = ['aluva', 'kalamassery', 'kaloor', 'south', 'vyttila'];
        if (!in_array($user_chosen_location, $allowed_locations)) {
            die("Invalid user location.");
        }

        // Fetch distances from the chosen location to all laundry shops from the distance table
        $distances_sql = "SELECT lan_reg.shop_id,lan_reg.shop_name, lan_reg.m_no, lan_reg.price, lan_reg.location, distance." . $user_chosen_location . " AS distance
                          FROM lan_reg
                          INNER JOIN distance ON lan_reg.location = distance.place
                          WHERE lan_reg.m_no > 0 AND distance." . $user_chosen_location . " <= 15
                          ORDER BY distance." . $user_chosen_location . " ASC";

        $distances_result = mysqli_query($conn, $distances_sql);

        if ($distances_result) {
            if (mysqli_num_rows($distances_result) > 0) {
                while ($row = mysqli_fetch_assoc($distances_result)) {
                    echo "Shop Id: " . $row['shop_id'] . "<br>";
                    echo "Shop Name: " . $row['shop_name'] . "<br>";
                    echo "Machine Count: " . $row['m_no'] . "<br>";
                    echo "Price: " . $row['price'] . "<br>";
                    echo "Location: " . $row['location'] . "<br>";
                    echo "Distance: " . $row['distance'] . " km<br>";
                    echo '<a href="user_laundry_reg.php?shop_id=' . $row['shop_id'] . '">Order Placement</a><br>';

                    // Set the shop_id in the session only if it's not already set
                    if (!isset($_SESSION['shop_id'])) {
                        $_SESSION['shop_id'] = $row['shop_id'];
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
        echo "User location not found in user_reg.";
    }
} else {
    echo "User ID not found in session.";
}

// Close the database connection
mysqli_close($conn);
?>

