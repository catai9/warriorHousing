<!-- listing Details -->

<head>
  <title>Warrior Housing</title>
  <link rel="stylesheet" href="styles/listing.css">
</head>

<body>
	<?php

		// Enable error logging: 
		error_reporting(E_ALL ^ E_NOTICE);
		// mysqli connection via user-defined function

		include('./my_connect.php');
		$mysqli = get_mysqli_conn();
	
		// SQL statement to get listing info.
		$sql = "SELECT r.rental_listing_ID, r.Country, r.City, r.Street_name, r.House_number, 
		r.Vacancies, 
		r.Rent_per_person, r.Availability_length, r.Parking, r.A_C, r.Washer_Dryer, r.Furnished, 
		r.Electricity, r.Water
		FROM rental_listing r
		WHERE rental_listing_ID = ?";

		// SQL statement to get seller info (name and phone number).
		$sql2 = "SELECT Name, Phone_Number
		FROM rental_listing NATURAL JOIN site_user NATURAL JOIN seller
		WHERE rental_listing_ID = ?";
					
		$stmt = $mysqli->prepare($sql);	

		$user_id = $_POST["user_id"]; 
		$rental_listing_ID =  $_POST['rental_listing_ID']; // not actually sure what my parameters are 
					
		//$rental_listing_ID = 20001;
		
		// (3) "i" for integer, "d" for double, "s" for string, "b" for blob 
		$stmt-> bind_param('i', $rental_listing_ID);

		// Prepared statement, stage 2: execute
		$stmt->execute();

		// Bind result variables 
		$stmt->bind_result($rental_listing_ID, $Country, $City, $Street_name, $House_number, $Vacancies, $Rent_per_person, $Availability_length, $Parking, $A_C, $Washer_Dryer, $Furnished, $Electricity, $Water);

		// fix table to be right number of columns 
		//printing output in html table
		
		echo '<form action="buyerHome.php" method="post">
			<input type="hidden" name="user_id" value="' . $user_id . '"/>
			<input type="submit" class="link" value="Return to Home"/>
		</form>';

		echo '<h1>Warrior Housing</h1>';
		
		// It will only return one result as sql query searches by key.
		if ($stmt->fetch()) {
			echo '<div>';
			echo '<h2 align="left">'. $House_number . ' ' . $Street_name . ' (' . $rental_listing_ID .') </h2>';
			echo '<h3 align="left">' . $City . ', ' . $Country.'</h3>';
			echo '<h4 align="left">$' . $Rent_per_person . ' Per Person</h4>';
			echo '<p class="header">Additional Details</p><br/>';
			echo '<table style="width:20%">';
			echo '<tr><td>Number of Vacancies: </td><td>' . $Vacancies;
			echo '</td></tr><tr><td> Availability Length: </td><td>' . $Availability_length;
			echo '</td></tr><tr><td> Parking Available: </td><td>';
			echo $Parking == 'n' ? "No": "Yes";
			echo '</td></tr><tr><td> A/C Available: </td><td>';
			echo $A_C == 'n' ? "No" : "Yes";
			echo '</td></tr><tr><td> Washer/Dryer Available: </td><td>';
			echo $Washer_Dryer == 'n' ? "No" : "Yes";
			echo '</td></tr><tr><td> Furnished Available: </td><td>';
			echo $Furnished == 'n' ? "No" : "Yes";
			echo '</td></tr><tr><td> Electricity Available: </td><td>';
			echo $Electricity == 'n' ? "No" : "Yes";
			echo '</td></tr><tr><td> Water Available: </td><td>';
			echo $Water == 'n' ? "No" : "Yes";
			echo '</td></tr></table>';

			$stmt->close(); 
			$stmt2 = $mysqli->prepare($sql2);	
			$stmt2-> bind_param('i', $rental_listing_ID);
			$stmt2->execute();
			$stmt2->bind_result($Seller_Name, $Seller__PhoneNo);
			// Only shows the seller information if it exists.
			if ($stmt2->fetch()) {
				echo '<p class="header">Seller Information</p>';
				echo '<h3 align="left">' . $Seller_Name . ': ' . $Seller__PhoneNo . '</h3>';
			}
			echo '<form action="rateListing.php" method="post"';
			echo '<input type="hidden" name="user_id" value="' . $user_id . '"/>'; 
			echo '<input type="hidden" name="rental_listing_ID" value="' . $rental_listing_ID . '"/>';
					echo '<!-- The button for rate -->';
					echo '<input type="submit" class="purple" value="Rate this Listing"/>';
			echo '</form>';
			echo '</div>';
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
		$mysqli->close();
		?>
</body>
