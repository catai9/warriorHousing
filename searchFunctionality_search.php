<!-- Search Listing Continued Page -->

<head>
  <title>Warrior Housing</title>
  <link rel="stylesheet" href="styles/buyerHome.css">
</head>

<body>
	
	<?php
		$user_id = $_POST["user_id"];
		$category = $_POST["category"];
		$search = $_POST["search"];

		// Enable error logging: 
		error_reporting(E_ALL ^ E_NOTICE);
		// mysqli connection via user-defined function

		include('./my_connect.php');
		$mysqli1 = get_mysqli_conn();

		// SQL statement
		$sql = "SELECT r.Rental_Listing_ID, r.City, r.Street_Name, r.House_Number, r.Vacancies, r.Rent_Per_Person, r.Availability_Length
					FROM Rental_Listing r
					WHERE r.Street_Name =?";
		$sql2 = "SELECT r.Rental_Listing_ID, r.City, r.Street_Name, r.House_Number, r.Vacancies, r.Rent_Per_Person, r.Availability_Length
					FROM Rental_Listing r
					WHERE r.City =?";

		echo '<form action="buyerHome.php" method="post">
		<input type="hidden" name="user_id" value="' . $user_id . '"/>
		<input type="submit" class="orange" value="Clear Search Parameters"/>
		</form>';

		echo '<h1>Warrior Housing</h1>';

		echo '<div><table style="width:100%">';
		echo '<tr>';
			echo '<th class="address">Address</th>';
			echo '<th>Vacancies</th>';
			echo '<th>Rent Per Person</th>';
			echo '<th>Availability Length (months)</th>';
			echo '<th>More Details</th>';
		echo '</tr>';

		if($category == "street"){
			$stmt1 = $mysqli1->prepare($sql);
			$stmt1->bind_param('s', $search); 
			$stmt1->execute();
			// Bind result variables 
			$stmt1->bind_result($rental_listing_ID, $city, $street_name, $house_number, $vacancies, $rent_per_person, $availability_length); 
		
			//printing output in html table
			while ($stmt1->fetch()) {
				$matching = true;
				echo '<tr><td class="address">' . $house_number . ' ' . $street_name .', ' . $city . '</td><td>'. $vacancies . '</td><td>'. $rent_per_person . '</td><td>'. $availability_length. '</td>';
				
				echo '<td>';
				echo '<form action="listingDetails.php" method="post">';
				echo '<input type="hidden" name="user_id" value="' . $user_id . '"/>'; 
				echo '<input type="hidden" name="rental_listing_ID" value="' . $rental_listing_ID . '"/>'; 
				echo '<br>';
				echo '<!-- The button for rate -->';
				echo '<input type="submit" class="green" value="See More"/>';
				echo '</br>';
				echo '</form></td>';
			}
			$stmt1->close(); 
		
		} else {
			$stmt2 = $mysqli1->prepare($sql2);
			$stmt2->bind_param('s', $search); 
			$stmt2->execute();
			// Bind result variables 
			$stmt2->bind_result($rental_listing_ID, $city, $street_name, $house_number, $vacancies, $rent_per_person, $availability_length); 
			
			//printing output in html table
			while ($stmt2->fetch()) {
				$matching = true;
				echo '<tr><td class="address">' . $house_number . ' ' . $street_name .', ' . $city . '</td><td>'. $vacancies . '</td><td>'. $rent_per_person . '</td><td>'. $availability_length. '</td>';
				
				echo '<td>';
				echo '<form action="listingDetails.php" method="post">';
				echo '<input type="hidden" name="user_id" value="' . $user_id . '"/>'; 
				echo '<input type="hidden" name="rental_listing_ID" value="' . $rental_listing_ID . '"/>'; 
				echo '<br>';
				echo '<!-- The button for rate -->';
				echo '<input type="submit" class="green" value="See More"/>';
				echo '</br>';
				echo '</form></td>';
			}
			$stmt2->close(); 
		
		}
		if(!$matching){
			echo '<p>No matches found.</p>';
			echo '<tr><td class="address">N/A</td><td>N/A</td><td>N/A</td><td>N/A</td>';
		}
		echo '</table>';
		echo '</div>';
		
		/* close statement and connection*/ 
		$mysqli1->close();
	?>

</body>