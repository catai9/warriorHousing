<!-- Rate Listing Continued -->

<head>
  <title>Warrior Housing</title>
  <link rel="stylesheet" href="styles/formFormat.css">
</head>

<body>
	<h1>Warrior Housing</h1>
	<h2>Rate Listing Submission Page</h2>

	<form action="buyerHome.php" method="post">

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


			// $stmt->execute() function returns boolean indicating success 

			if ($stmt->execute()) { 
				echo '<h1>Success!</h1>'; 
				echo '<p>A new rating was created by User: ' . $user_id . ', for rental listing ' . $rental_listing_ID .  '. A score of ' .$Score .' and comments '. $Comments . 'were submitted. ' . '</p>';

				echo '<form id="form22" action="buyerHome.php" method="post">';
				echo '<input type="hidden" name="user_id" value="' . $user_id . '"/>'; 

				echo '<input type="submit" value="Return to buyer home page"/>'; 
				echo '</form>';	
			} 
			else {
				echo '<h1>You Failed</h1>'; 
				echo '<p>A new rating was not created by User: ' . $user_id . ', for rental listing ' . $rental_listing_ID .  '. A score of ' .$Score .' and comments '. $Comments . 'were submitted. ' . '</p>';
				echo 'Execute failed: (' . $stmt->errno . ') ' . $stmt->error; 
			} 
			$stmt->close(); 
			$mysqli->close();
		?>
	</form>
</body>

