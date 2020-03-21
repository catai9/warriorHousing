<!-- Sort Listing Continued -->

<head>
  <title>Warrior Housing</title>
  <link rel="stylesheet" href="styles/formFormat.css">
</head>

<body>
	<h1>Search Street Name</h1>
	<?php
		// Enable error logging: 
		error_reporting(E_ALL ^ E_NOTICE);
		// mysqli connection via user-defined function

		include('./my_connect.php');
		$mysqli = get_mysqli_conn();

		// SQL statement
		$sql2 = "SELECT r.Rental_Listing_ID, r.City, r.Street_Name, r.House_Number, r.Vacancies, r.Rent_Per_Person, r.Availability_Length
					FROM Rental_Listing r
					WHERE r.City =?";
		
		//does this change 
		// Prepared statement, stage 1: prepare
		$stmt = $mysqli->prepare($sql);
		$stmt = $mysqli->prepare($sql2);

		// Prepared statement, stage 2: bind and execute 
		$query = $_GET['city']; 

		// "i" for integer, "d" for double, "s" for string, "b" for blob 
		$stmt->bind_param('s', $query); 
		$stmt->execute();

		/* fetch values */ 
		$stmt->bind_result($v1, $v2, $v3, $v4, $v5, $v6, $v7); 

		echo '<table>';
			echo '<table style="width:100%">';
			echo '<tr>';
			echo '<th>Rental Listing ID</th>';
			echo '<th>City</th>';
			echo '<th>Street Name</th>';
			echo '<th>House Number</th>';
			echo '<th>Vacancies</th>';
			echo '<th>Rent Per Person</th>';
			echo '<th>Length of Availability</th>';
			echo '</tr>';
		while ($stmt->fetch()) {
			echo '<tr><td>' . $v1 . '</td><td>' . $v2 . '</td><td>' . $v3 . '</td><td>'. $v4 . '</td><td>'. $v5 . '</td><td>'. $v6 . '</td><td>'. $v7 . '</td><td>';
		}
		echo '</table>';

		/* close statement and connection*/ 
		$stmt->close(); 
		$mysqli->close();
	?>

	<form id="form3" action="searchFunctionality_input.php" method="get">
		<input type="submit" value="Back"/>
	</form>
</body>