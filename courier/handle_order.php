<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Smart Laundry</title>
    <link rel="icon" type="image/x-icon" href="media/favicon.png">
    <!-- Linking header CSS file -->
    <link rel="stylesheet" type="text/css" href="ad_index.css" />
    <link rel="stylesheet" type="text/css" href="users_card.css" />
    <link rel="stylesheet" type="text/css" href="users_data_field.css" />
    <link rel="stylesheet" type="text/css" href="confirmation_window.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@100;600&family=Roboto:wght@500;700&family=Work+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nova+Square&display=swap" rel="stylesheet">

    <style>
        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        .card {
            width: 20%;
            margin: 10px;
            height: fit-content;
        }

        .search-box {
            margin-bottom: 28px;
            margin-top: -37px;
        }

        .delete-btn {
            color: Red;
            cursor: pointer;
            background-color: white;
            font-weight: bold;
            border-radius: 4px;
            height: 30px;
            line-height: 30px;
            margin-bottom: 0;
        }

        .delete-btn:hover {
            color: white;
            cursor: pointer;
            background-color: #ED7D31;
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
                <a href="ad_home.html">Back</a>
            </div>
        </div>
        <!-- Navigation menu ends here -->
    </div>
    <!-- End of header div -->

    <div class="main-background">
        <div class="data-field">
            <div class="heading">
                <p class="heading-note">Courier's List</p>
            </div>

            <!-- Search Box -->
            <form class="search-box" method="GET">
                <label class="search-txt" for="search-id">Search by ID: </label>
                <input class="search-input" type="text" id="search-id" name="id" />
                <button class="search-btn" type="submit">
                    <span id="search-icon" class="material-symbols-outlined">person_search</span>
                </button>
            </form>

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
                if (isset($_GET['booking_id'])) {
                    $bookingId = $_GET['booking_id'];
                
                    // Now you can use $bookingId in your logic
                
                    // echo "Processing order with Booking ID: " . $bookingId;
                } else {
                    echo "Booking ID not provided in the URL.";
                }

                // Handle ID search
                if (isset($_GET['id'])) {
                    $search_id = mysqli_real_escape_string($connection, $_GET['id']);
                    $query = "SELECT * FROM courier_registration_table WHERE id = '$search_id'";
                } else {
                    $query = "SELECT * FROM courier_registration_table";
                }

                $result = mysqli_query($connection, $query);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="card">';
                        echo '<img class="card-img" src="media/courier_card.jpeg" alt="Avatar">';
                        echo '<div class="container">';
                        echo '<b>' . $row['name'] . '</b>';
                        echo '<p>ID: ' . $row['id'] . '</p>';
                        // echo '<p>Pending pickup: ' . $row['pending_pickup'] . '</p>';
                        // echo '<p>Pending delivery: ' . $row['pending_delivery'] . '</p>';
                        echo '<p>Address: ' . $row['address'] . '</p>';
                        echo '</div>';
                        echo '<p class="delete-btn" onclick="selectCourierConfirmed(' . $row['id'] . ', ' . $bookingId . ')">Choose</p>';
                        ;
                        echo '</div>';
                    }
                } else {
                    echo '<script>alert("No agents found. Query: ' . $query . '");</script>';
                    echo '<script>window.location.href="my_orders.php";</script>';
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

    <!-- Modal -->
    <div id="customModal" class="modal">
        <span id="deletion" class="material-symbols-outlined">how_to_reg</span>
        <p><b>Choose this courier agent ?</b><br></p>
        <button class="yes-btn" onclick="selectCourierConfirmed()">Yes</button>
        <button class="no-btn" onclick="closeModal()">No</button>
    </div>

    <!-- Modal overlay -->
    <div id="modalOverlay" class="modal-overlay"></div>

    <script>
    // Your existing script

    // Custom modal functions
    function selectCourierConfirmed(courierId, bookingId) {
    // Access courierId and bookingId from the function parameters
    window.location.href = "fix_courier.php?courier_id=" + courierId + "&booking_id=" + bookingId;
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
</script>

</body>

</html>
