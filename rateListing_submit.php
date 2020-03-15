<!-- Rate Listing Continued -->

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

		$sql = "INSERT INTO rating
		VALUES (?, ?, ?, ?)"; 

		// Prepared statement, stage 1: prepare
		$stmt = $mysqli->prepare($sql);

		//these values are inputted by the user
		$rental_listing_ID =  $_POST["rental_listing_ID"]; //TODO Handle POST parameters
		$user_id =  $_POST['user_id'];
		$Score =  $_POST['rating_score'];
		$Comments =  $_POST['rating_comment'];//TODO Handle POST parameters

		// (3) "i" for integer, "d" for double, "s" for string, "b" for blob 
		$stmt-> bind_param('iiis', $rental_listing_ID, $user_id, $Score, $Comments);//TODO Bind Php variables to MySQL parameters 

		echo '<form action="buyerHome.php" method="post">
        <input type="hidden" name="user_id" value="' . $user_id . '"/>
        <input type="submit" class="link" value="Return to Home"/>
		</form>';

		echo '<h1>Warrior Housing</h1>';

		// $stmt->execute() function returns boolean indicating success 
		echo '<div>';
		if ($stmt->execute()) { 
			echo '<h2>Successful Submission</h2>';
			echo 'Your rating has been successfully submitted. We appreciate hearing your opinion.'; 
			echo '<form action="buyerHome.php" method="post">
				<input type="hidden" name="user_id" value="' . $user_id . '"/> <br>
				<input type="submit" class="purple center" value="Return to Home"/>
				</form>';
		} 
		else {
			echo '<h2>An error occurred</h2>'; 
			echo '<p>Please try again. Note that only one rating may be submitted per user for a specific listing.</p>';
			echo '<form action="rateListing.php" method="post">
				<input type="hidden" name="user_id" value="' . $user_id . '"/>
				<input type="hidden" name="rental_listing_ID" value="' . $rental_listing_ID . '"/> <br> <br>
				<input type="submit" class="purple center" value="Try Again"/>
				</form>';
		} 
		echo '</div>';
		$stmt->close(); 
		$mysqli->close();
	?>
</body>

