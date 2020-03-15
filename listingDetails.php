<!-- listing Details -->

<head>
  <title>Warrior Housing</title>
  <link rel="stylesheet" href="styles/formFormat.css">
</head>

<body>
	<h1>Warrior Housing</h1>	
	<h2>Listing Details</h2>

	<?php
		// Enable error logging: 
		error_reporting(E_ALL ^ E_NOTICE);
		// mysqli connection via user-defined function

		include('./my_connect.php');
		$mysqli = get_mysqli_conn();

	
		// SQL statement
		$sql = "SELECT r.rental_listing_ID, r.Country, r.City, r.Street_name, r.House_number, 
		r.Vacancies, 
		r.Rent_per_person, r.Availability_length, r.Parking, r.A_C, r.Washer_Dryer, r.Furnished, 
		r.Electricity, r.Water
		FROM rental_listing r
		WHERE rental_listing_ID = ?";
					
		$stmt = $mysqli->prepare($sql);	

		$user_id = $_POST["user_id"]; 
		$rental_listing_ID =  $_POST['rental_listing_ID']; // not actually sure what my parameters are 
					
		//$rental_listing_ID = 20001;
		
		// (3) "i" for integer, "d" for double, "s" for string, "b" for blob 
		$stmt-> bind_param('i', $rental_listing_ID);//TODO Bind Php variables to MySQL parameters 
		

		// Prepared statement, stage 2: execute
		$stmt->execute();

		// Bind result variables 
		$stmt->bind_result($rental_listing_ID, $Country, $City, $Street_name, $House_number, $Vacancies, $Rent_per_person, $Availability_length, $Parking, $A_C, $Washer_Dryer, $Furnished, $Electricity, $Water);

			// fix table to be right number of columns 
		//printing output in html table
		
		echo '<table>';
			echo '<tr>';
				echo '<th>Rental Listing ID</th>';
				echo '<th>Adress</th>';
				echo '<th>Vacancies</th>';
				echo '<th>Rent Per Person</th>';
				echo '<th>1</th>';
				echo '<th>2</th>';
				echo '<th>3</th>';
				echo '<th>4</th>';
				echo '<th>5</th>';
				echo '<th>6</th>';
				echo '<th>7</th>';
				echo '<th>8</th>';
				echo '<th>9</th>';
				echo '<th>10</th>';
			echo '</tr>';

			while ($stmt->fetch()) {
			echo '<tr><td>' . $rental_listing_ID . '</td><td>' . $City . '</td><td>' . $Street_name .'</td><td>' . $House_number . '</td><td>'.$Country. '</td><td>'. $Vacancies . '</td><td>'. $Rent_per_person . '</td><td>'. $Availability_length. '</td><td>'. $Parking . '</td><td>'. $A_C . '</td><td>'. $Washer_Dryer . '</td><td>'. $Furnished . '</td><td>'. $Electricity .'</td><td>'. $Water . '</td><tr>';
			}
		echo '</table>';

				
		echo '<form action="rateListing.php" method="post"';
		echo '<input type="hidden" name="user_id" value="' . $user_id . '"/>'; 
		echo '<input type="hidden" name="rental_listing_ID" value="' . $rental_listing_ID . '"/>';
			echo '<br>';
				echo '<!-- The button for rate -->';
				echo '<input type="submit" value="Rate this Listing"/>';
			echo '</br>';
		echo '</form>';
		

		/* close statement and connection*/ 
		$stmt->close(); 
		$mysqli->close();
		?>
</body>
