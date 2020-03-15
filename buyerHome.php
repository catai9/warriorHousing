<!-- Buyer Home Page -->

<head>
  <title>buyerHome</title>
</head>
<body>
	<h1>Warrior Housing</h1>
	
	<!-- Which page it will direct go upon submitting the form. -->
	<!-- If the form submission is successful, it will redirect to its respective php file -->
	<?php
		$user_id = $_POST["user_id"];
		echo '<form action="searchFunctionality_input.php" method="post"> ';
			echo '<input type="hidden" name="user_id" value="' . $user_id . '"/>'; 
			echo '<br>
					<!-- The button for search -->
					<input type="submit" value="Search"/>
				</br>
		</form>';

		echo '<form action="sortFunctionality_input.php" method="post"> ';
			echo '<input type="hidden" name="user_id" value="' . $user_id . '"/>'; 
			echo '<br>
					<!-- The button for sort -->
					<input type="submit" value="Sort"/>
				</br>
		</form>';

			// Enable error logging: 
			error_reporting(E_ALL ^ E_NOTICE);
			// mysqli connection via user-defined function

			include('./my_connect.php');
			$mysqli = get_mysqli_conn();

		
			// SQL statement
			$sql = "SELECT r.rental_listing_ID, r.city, r.street_name, r.house_number, r.vacancies, r.rent_per_person, r.availability_length
            FROM rental_listing r
            ORDER BY r.rent_per_person ASC
            LIMIT 5";

			// Prepared statement, stage 1: prepare
			$stmt = $mysqli->prepare($sql);

			// Prepared statement, stage 2: execute
			$stmt->execute();

			// Bind result variables 
			$stmt->bind_result($rental_listing_ID, $city, $street_name, $house_number, $vacancies, $rent_per_person, $availability_length); 
		
			//printing output in html table
			while ($stmt->fetch()) {
			echo '<table style="width:100%">';
            echo '<tr>';
                echo '<th>Rental Listing ID</th>';
                echo '<th>Address</th>';
                echo '<th>Vacancies</th>';
                echo '<th>Rent Per Person</th>';
                echo '<th>Length of Availability</th>';
            echo '</tr>';
            echo '<tr><td>' . $rental_listing_ID . '</td><td>' . $city . ', ' . $street_name .', ' . $house_number . '</td><td>'. $vacancies . '</td><td>'. $rent_per_person . '</td><td>'. $availability_length. '</td><td>';
			echo '</table>';
			echo '<form action="listingDetails.php" method="post">';
			echo '<input type="hidden" name="user_id" value="' . $user_id . '"/>'; 
			echo '<input type="hidden" name="rental_listing_ID" value="' . $rental_listing_ID . '"/>'; 
			echo '<br>';
				echo '<!-- The button for rate -->';
				echo '<input type="submit" value="Further Details"/>';
			echo '</br>';
			echo '</form>';
			}
			echo '<br><a href="login.php" class="button">Log Out</a></br>';
			/* close statement and connection*/ 
			$stmt->close(); 
			$mysqli->close();
		?>
</body>
