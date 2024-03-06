<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Smart Laundry</title>
    <link rel="icon" type="image/x-icon" href="media/favicon.png">
    <!-- Linking header CSS file -->
    <link rel="stylesheet" type="text/css" href="index.css" />
    <link rel="stylesheet" type="text/css" href="booking_card.css" />
    <link rel="stylesheet" type="text/css" href="booking_list.css" />
    <link rel="stylesheet" type="text/css" href="confirmation_window.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@100;600&family=Roboto:wght@500;700&family=Work+Sans&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Nova+Square&display=swap" rel="stylesheet">
 
    <style>


   
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
                <p class="heading-note">Available Laundry Centers</p>
                <div class="sort-form">
                    <form method="post">
                        <select name="sorting_option">
                            <option value="default">Default</option>
                            <option value="price-low-to-high">Price low to high</option>
                            <option value="price-high-low">Price high to low</option>
                            <option value="distance">Distance</option>
                            <option value="Rating">Rating</option>
                        </select>
                        <input type="submit" value="Sort">
                </form>

                </div>
            </div>
    

            <div class="card-container">
            <?php
$host = "localhost";
$user = "root";
$pass = "";
$database = "smart_laundry";

$connection = mysqli_connect($host, $user, $pass, $database);
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle sorting
$sortingOption = isset($_POST['sorting_option']) ? $_POST['sorting_option'] : 'default';

// Handle ID search
if (isset($_GET['id'])) {
    $search_id = mysqli_real_escape_string($connection, $_GET['id']);
    $query = "SELECT * FROM dealer_registration_table WHERE id = '$search_id'";
} else {
    // Modify the query based on the selected sorting option
    switch ($sortingOption) {
        case 'price-low-to-high':
            $query = "SELECT * FROM dealer_registration_table ORDER BY pricing ASC";
            break;
        case 'price-high-low':
            $query = "SELECT * FROM dealer_registration_table ORDER BY pricing DESC";
            break;
        case 'Rating':
            $query = "SELECT * FROM dealer_registration_table ORDER BY rating DESC";
            break;
        case 'distance':
            // Assuming you have a column named 'distance' in your distance table
            $query = "SELECT dealer_registration_table.*, distance.place AS distance 
                      FROM dealer_registration_table
                      INNER JOIN distance ON dealer_registration_table.address = distance.place
                      ORDER BY distance ASC";
            break;
        default:
            $query = "SELECT * FROM dealer_registration_table";
            break;
    }
}

$result = mysqli_query($connection, $query);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="card">';
        echo '<a class="card-link"  href="book_slot.php?id=' . $row['id'] . '">';
        echo '<img class="card-img" src="media/dealer_card.jpeg" alt="Avatar">';
        echo '<div class="container">';
        echo '<b class="c-name">' . $row['company_name'] . '</b>';
        echo '<p>Address: ' . $row['address'] . '</p>';
        echo '<p>Pricing: ₹ ' . $row['pricing'] . '/kg</p>';
        echo '<p>Machines available: ' . $row['available_machines'] . '</p>';
        echo '<p>Rating: ' . $row['rating'] . '<span style="color:#F4CE14" class="material-symbols-outlined">star</span></p>';
        echo '</div>';
        echo '</div>';
        echo '</a>';
    }
} else {
    echo '<script>alert("No dealers found.");</script>';
    echo '<script>window.location.href="dealers_data.php";</script>';
}
?>


            </div>

            <div class="end">
                <p class="end_note">Smart Laundry</p>
            </div>
        </div>
    </div>

    <div class="footer">
        <p class="copyright">© Copyright</p>
    </div>


    </script>

</body>

</html>
