<!-- Buyer Home Page -->

<head>
  <title>Warrior Housing</title>
  <link rel="stylesheet" href="styles/buyerHome.css">
</head>
<body>
	<a href="login.php" class="button">Log Out</a>
    <h1>Warrior Housing</h1>
	
	<!-- Which page it will direct go upon submitting the form. -->
	<!-- If the form submission is successful, it will redirect to its respective php file -->
	<?php
		
		$user_id = $_POST["user_id"];
		echo '<form action="searchFunctionality_input.php" method="post"> ';
			echo '<input type="hidden" name="user_id" value="' . $user_id . '"/>'; 
			echo '
				<input type="submit" class="orange" value="Search"/>
		</form>';
		echo '<div>';
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
		
			echo '<table style="width:100%">';
            echo '<tr>';
                echo '<th class="address">Address</th>';
                echo '<th>Vacancies</th>';
                echo '<th>Rent Per Person</th>';
				echo '<th>Availability Length (months)</th>';
				echo '<th>More Details</th>';
			echo '</tr>';

			//printing output in html table
			while ($stmt->fetch()) {
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
			echo '</table>';
			echo '</div>';
			/* close statement and connection*/ 
			$stmt->close(); 
			$mysqli->close();
		?>
</body>
