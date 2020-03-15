<!-- Search Listing Continued Page -->

<head>
  <title>Warrior Housing</title>
  <link rel="stylesheet" href="styles/formFormat.css">
</head>

<body>
	<h1>Warrior Housing</h1>
	<h2>Search Street Name</h2>
	
	<?php
		$user_id = $_POST["user_id"];

		// Enable error logging: 
		error_reporting(E_ALL ^ E_NOTICE);
		// mysqli connection via user-defined function

		include('./my_connect.php');
		$mysqli1 = get_mysqli_conn();
		$mysqli2 = get_mysqli_conn();

		// SQL statement
		$sql = "SELECT r.Rental_Listing_ID, r.City, r.Street_Name, r.House_Number, r.Vacancies, r.Rent_Per_Person, r.Availability_Length
					FROM Rental_Listing r
					WHERE r.Street_Name =?";
		$sql2 = "SELECT r.Rental_Listing_ID, r.City, r.Street_Name, r.House_Number, r.Vacancies, r.Rent_Per_Person, r.Availability_Length
					FROM Rental_Listing r
					WHERE r.City =?";

		// Prepared statement, stage 1: prepare
		$stmt1 = $mysqli1->prepare($sql);
		$stmt2 = $mysqli2->prepare($sql2);

		// Prepared statement, stage 2: bind and execute 
		$query1 = $_GET['search']; 
		$query2 = $_GET['city']; 

		// "i" for integer, "d" for double, "s" for string, "b" for blob 
		$stmt1->bind_param('s', $query1); 
		$stmt1->execute();
		$stmt2->bind_param('s', $query2); 
		$stmt2->execute();

		/* fetch values */ 
		$stmt1->bind_result($v1, $v2, $v3, $v4, $v5, $v6, $v7); 
		$stmt2->bind_result($v1, $v2, $v3, $v4, $v5, $v6, $v7); 

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
		while ($stmt1->fetch()) {
			echo '<tr><td>' . $v1 . '</td><td>' . $v2 . '</td><td>' . $v3 . '</td><td>'. $v4 . '</td><td>'. $v5 . '</td><td>'. $v6 . '</td><td>'. $v7 . '</td><td>';
		}
		while ($stmt2->fetch()) {
			echo '<tr><td>' . $v1 . '</td><td>' . $v2 . '</td><td>' . $v3 . '</td><td>'. $v4 . '</td><td>'. $v5 . '</td><td>'. $v6 . '</td><td>'. $v7 . '</td><td>';
		}
		echo '</table>';

		/* close statement and connection*/ 
		$stmt1->close(); 
		$stmt2->close(); 
		$mysqli1->close();
		$mysqli2->close();

		echo '
			<form id="form3" action="searchFunctionality_input.php" method="post">
			<input type="hidden" name="user_id" value="' . $user_id . '"/>
			<input type="submit" value="Back"/>
			</form>'
	?>

</body>