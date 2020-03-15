<!-- Page 13 -->
<!-- listing Details -->

<head>
  <title>Listing Details</title>
</head>
<?php
$user_id = $_POST["user_id"]; 
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
			$sql = "SELECT r.rental_listing_ID, r.city, r.street_name, r.house_number, r.vacancies, r.rent_per_person, r.availability_length
            FROM rental_listing r
			WHERE rentail_listing_ID = ?";
			
			
			$stmt = $mysqli->prepare($sql);	


			$Rental_Listing_ID =  $_POST['rental_listing_ID']; // not actually sure what my parameters are 
						
			//$Rental_Listing_ID = 20001;

			
			// (3) "i" for integer, "d" for double, "s" for string, "b" for blob 
			$stmt-> bind_param('i', $Rental_Listing_ID);//TODO Bind Php variables to MySQL parameters 
			Country	City	Street_Name	House_Number	Vacancies	Rent_Per_Person	Availability_Length	Parking	A/C	Washer/Dryer	Furnished	WiFi	Electricity	Water	Rental_Type

			// Prepared statement, stage 2: execute
			$stmt->execute();

			// Bind result variables 
			$stmt->bind_result($rental_listing_ID, $Country, $city, $street_name, $house_number, $vacancies, $rent_per_person, $availability_length); 
		
			//printing output in html table
			while ($stmt->fetch()) {
			echo '<table style="width:100%">';
            echo '<tr>';
                echo '<th>Rental Listing ID</th>';
                echo '<th>Adress</th>';
                echo '<th>Vacancies</th>';
                echo '<th>Rent Per Person</th>';
                echo '<th>Length of Availability</th>';
            echo '</tr>';
            echo '<tr><td>' . $rental_listing_ID . '</td><td>' . $city . ', ' . $street_name .', ' . $house_number . '</td><td>'. $vacancies . '</td><td>'. $rent_per_person . '</td><td>'. $availability_length. '</td><td>';
			echo '</table>';
			echo '<form action="rateListing.php" method="post"';
			echo '<input type="hidden" name="user_id" value="' . $user_id . '"/>'; 
			echo '<br>';
				echo '<!-- The button for rate -->';
				echo '<input type="submit" value="Further Details"/>';
			echo '</br>';
			echo '</form>';
			}
			/* close statement and connection*/ 
			$stmt->close(); 
			$mysqli->close();
		?>
</body>
