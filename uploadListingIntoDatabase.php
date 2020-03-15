<!-- Upload Listing into Database Page  -->

<head>
  <title>Warrior Housing</title>
  <link rel="stylesheet" href="styles/formFormat.css">
</head>

<body>
    <h1>Warrior Housing</h1>
	<h2>Upload Listing Confirmation</h2>

    <?php
        // Enable error logging: 
        error_reporting(E_ALL ^ E_NOTICE);

        // mysqli connection via user-defined function
        include('./my_connect.php');
        $mysqli = get_mysqli_conn();

        // SQL statement to insert the user inputted values into the guest table.
        $sql = "INSERT INTO rental_listing "
        . "VALUES (null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ";

        // Prepared statement, stage 1: prepare
        $stmt = $mysqli->prepare($sql);

        // Fetches the needed values from the previous file. 
        $country = $_POST['country']; 
        $city = $_POST['city']; 
        $streetName = $_POST['streetName'];
        $houseNo = $_POST['houseNo'];
        $vacancies = $_POST['vacancies']; 
        $price = $_POST['price']; 
        $availabilityLength = $_POST['availabilityLength'];
        $parking = $_POST['parking'] === null ? "n": "y";
        $ac = $_POST['ac'] === null ? "n": "y"; 
        $washer = $_POST['washer'] === null ? "n": "y"; 
        $furnished = $_POST['furnished'] === null ? "n": "y";
        $wifi = $_POST['wifi'] === null ? "n": "y";
        $electricity = $_POST['electricity'] === null ? "n": "y"; 
        $water = $_POST['water'] === null ? "n": "y"; 
        $rentalType = $_POST['rentalType'];
        $userId = $_POST['userId'];

        // Prepared statement, stage 2: bind and execute
        $stmt->bind_param('ssssssssssssssss', $country, $city, $streetName, $houseNo, $vacancies, $price, $availabilityLength, $parking, $ac, $washer, $furnished, $wifi, $electricity, $water, $rentalType, $userId); 
        
        if($stmt->execute()){
            echo '<p>Listing successfully inserted.</p>';
            echo '<form action="uploadListing.php" method="post">';
            echo '<input type="hidden" name="user_id" value="' . $userId . '"/>'; 
            echo '<input type="submit" name="submit" class="teal" value="Upload Another Listing"/>';
            echo '</form>';
            echo '<br><a href="login.php" class="button">Log Out</a></br>';
        }
        // Prints message to the user if the guest was not inserted into the table.
        else {
            echo '<p>Listing not inserted. Please try again.</p>';
            echo '<form action="uploadListing.php" method="post">';
            echo '<input type="hidden" name="user_id" value="' . $userId . '"/>'; 
            echo '<input type="submit" name="submit" class="teal" value="Try Again"/>';
            echo '</form>';
            echo '<br><a href="login.php" class="button">Log Out</a></br>';
        }

        // Close statement and connection.
        $stmt->close();  
        $mysqli->close();

    ?>
</body>