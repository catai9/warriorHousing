<!-- Page 13 -->
<!-- listing Details -->

<head>
  <title>Listing Details</title>
</head>
<?php
$user_id = $_POST["user_id"]; 
$rental_listing_ID = $_POST["rental_listing_ID"]; 
?>
<body>
	<h1>Warrior Housing</h1>
	
<!-- TO DO: CHANGE REDIRECT PAGE-->
	<!-- Which page it will direct go upon submitting the form. -->
	<!-- If the form submission is successful, it will redirect to its respective php file -->
	
	<?php
	echo '<form action="sortListing.php" method="post" ';
		echo '<input type="hidden" name="user_id" value="' . $user_id . '"/>'; 
		echo '<br>
			<!-- The button for search -->
			<input type="submit" value="Sort"/>
		</br>
	</form>';
	?>

	<?PHP
			// Enable error logging: 
			error_reporting(E_ALL ^ E_NOTICE);
			// mysqli connection via user-defined function

			include('./my_connect.php');
			$mysqli = get_mysqli_conn();

		
			// SQL statement
			$sql = "SELECT r.rental_listing_ID, r.country, r.city, r.street_name, r.house_number, 
			r.vacancies, 
			r.rent_per_person, r.availability_length, r.parking, r.a_c, r.washer_dryer, r.furnished, 
			r.electricity, r.water
            FROM rental_listing r
			WHERE rental_listing_ID = ?";
						
			$stmt = $mysqli->prepare($sql);	

			$rental_listing_ID =  $_POST['rental_listing_ID']; // not actually sure what my parameters are 
						
			//$Rental_Listing_ID = 20001;
			
			// (3) "i" for integer, "d" for double, "s" for string, "b" for blob 
			$stmt-> bind_param('i', $rental_listing_ID);//TODO Bind Php variables to MySQL parameters 
			

			// Prepared statement, stage 2: execute
			$stmt->execute();

			// Bind result variables 
			$stmt->bind_result(
				$rental_listing_ID, $country, $city, $street_name, $house_number, 
			$vacancies, 
			$rent_per_person, $availability_length, $parking, $a_c, $washer_dryer, $furnished, 
			$electricity, $water) 

				// fix table to be right number of columns 
			//printing output in html table
			
			echo '<table style="width:100%">';
            echo '<tr>';
                echo '<th>Rental Listing ID</th>';
                echo '<th>Adress</th>';
                echo '<th>Vacancies</th>';
                echo '<th>Rent Per Person</th>';
				echo '<th>Length of Availability</th>';
				echo '<th>Length of Availability</th>';
				echo '<th>Length of Availability</th>';
				echo '<th>Length of Availability</th>';
				echo '<th>Length of Availability</th>';
				echo '<th>Length of Availability</th>';
				echo '<th>Length of Availability</th>';
				echo '<th>Length of Availability</th>';
				echo '<th>Length of Availability</th>';
				echo '<th>Length of Availability</th>';
			echo '</tr>';

			while ($stmt->fetch()) {
			echo '<tr><td>' . $rental_listing_ID . '</td><td>' . $city . ', ' . $street_name .', ' 
			. $house_number . ','.$country. '</td><td>'. $vacancies . '</td><td>'. $rent_per_person 
			. '</td><td>'. $availability_length. '</td><td>'. $parking . '</td><td>'. $a_c 
			. '</td><td>'. $washer_dryer . '</td><td>'. $furnished . '</td><td>'. $electricity 
			.'</td><td>'. $water . '</td><tr>';
			}
			echo '</table>';

			
			echo '<form action="rateListing.php" method="post"';
			echo '<input type="hidden" name="user_id" value="' . $user_id . '"/>'; 
			echo '<br>';
				echo '<!-- The button for rate -->';
				echo '<input type="submit" value="Further Details"/>';
			echo '</br>';
			echo '</form>';
			
			/* close statement and connection*/ 
			$stmt->close(); 
			$mysqli->close();
		?>
</body>
