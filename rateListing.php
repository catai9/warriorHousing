<!-- Rate Listing Page -->

<head>
  <title>Warrior Housing</title>
  <link rel="stylesheet" href="styles/listing.css">
</head>

<body>

    <?php
        // Enable error logging: 
        error_reporting(E_ALL ^ E_NOTICE);
        // mysqli connection via user-defined function
        include ('./my_connect.php');
        $mysqli = get_mysqli_conn();

        // must grab variables coming in and use them in the below sql query 

        $sql = "SELECT rental_listing.House_Number, rental_listing.Street_Name, rental_listing.City, rental_listing.Rent_Per_Person 
        FROM rental_listing WHERE rental_listing_ID = ?";
            
        // Prepared statement, stage 1: prepare
        $stmt = $mysqli->prepare($sql);
        
        // (2) Updated tag is the name of the playlist that the song is being transferred to
        $user_id =  $_POST["user_id"]; 
        //User_ID = 10000;
        $rental_listing_ID =  $_POST['rental_listing_ID']; // not actually sure what my parameters are 

        // (3) "i" for integer, "d" for double, "s" for string, "b" for blob 
        $stmt-> bind_param('i', $rental_listing_ID);//TODO Bind Php variables to MySQL parameters 

        // Prepared statement, stage 2: execute
        $stmt->execute();

        // Bind result variables 
        // In this example, aircraft_id and aircraft_name will be returned from the SQL statement.
        // Thus, the returned values will be stored in variables named aircraft_id and aircraft_name.
        $stmt->bind_result($House_Number, $Street_Name, $City, $Rent_Per_Person); 

        echo '<form action="buyerHome.php" method="post">
        <input type="hidden" name="user_id" value="' . $user_id . '"/>
        <input type="submit" class="link" value="Return to Home"/>
		</form>';

		echo '<h1>Warrior Housing</h1>';

        /* fetch values */ 
        if ($stmt->fetch()) {
            echo '<div>';
            echo '<h2 align="left">Listing Info</h2>';
            echo '<p align="left">' . $House_Number . ' ' . $Street_Name . ' (' . $rental_listing_ID .') <br>';
            echo '$' . $Rent_Per_Person . ' Per Person</p>';
        }

        // If there is an issue while fetching, outputs message.
		else {
			echo '<div>An error occurred. The server may have disconnected. Please try again.</div>';
			echo '<form action="buyerHome.php" method="post">
				<input type="hidden" name="user_id" value="' . $user_id . '"/>
				<input type="submit" class="purple" value="Try Again"/>
			</form>';
		}

 
        /* close statement and connection*/ 
        $stmt->close(); 
        $mysqli->close();

        echo '<h2 align="left">Rating Form</h2>';
        echo'<form action="rateListing_submit.php" method="post">
            <!--add intake functionality for the ratingand comment -->
                Please Enter Rating: (1 is lowest, 5 is highest)<br>
                <input type="number" name="rating_score" min="1" max ="5" required/>	<br>
                Please Enter Comments:<br>
                <input type="text" name="rating_comment" required/>	<br>
                <!-- The button for this form. -->
                <input type="hidden" name="user_id" value="' . $user_id . '"/>
                <input type="hidden" name="rental_listing_ID" value="' . $rental_listing_ID . '"/>
                <br>
                <input type="submit" class="purple right" value="Submit Rating"/>
        </form> </div>';
    ?>
</body>

