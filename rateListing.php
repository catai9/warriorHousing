<!-- Page 9 -->
<!-- Rate Listing Page -->

<head>
  <title>Warrior Housing</title>
</head>

<body>
	<h1>Warrior Housing</h1>
	<!-- TO DO: CHANGE PAGE SUBTITLE -->
	<h2>Rate Listing Page</h2>

<!-- TO DO: CHANGE REDIRECT PAGE-->
	<!-- Which page it will direct go upon submitting the form. -->
	<!-- In this example, if the form submission is successful, it will redirect to TEMPLATETWO.php -->
	


		<?php
			// Enable error logging: 
			error_reporting(E_ALL ^ E_NOTICE);
			// mysqli connection via user-defined function
			include ('./my_connect.php');
			$mysqli = get_mysqli_conn();

        // must grab variables coming in and use them in the below sql query 

// TO DO: CHANGE SQL STATEMENT
			// SQL statement (change to reflect what you need).
			// Will probably be the main change (and hardest change) that you do.
			$sql = "SELECT rental_listing.House_Number, rental_listing.Street_Name, rental_listing.City, rental_listing.Rent_Per_Person 
            FROM rental_listing WHERE rental_listing_ID = ?";
				
			// Prepared statement, stage 1: prepare
            $stmt = $mysqli->prepare($sql);
            
            // (2) Updated tag is the name of the playlist that the song is being transferred to
            $user_id =  $_POST["user_id"]; 
            //User_ID = 10000;
            $rental_listing_ID =  $_POST['rental_listing_ID']; // not actually sure what my parameters are 

            //$rental_listing_ID = 20001;
            // how does user id get to the right place? 

            // (3) "i" for integer, "d" for double, "s" for string, "b" for blob 
            $stmt-> bind_param('i', $rental_listing_ID);//TODO Bind Php variables to MySQL parameters 
            //what does this do? it binds the php to SQL vars
                // Prepared statement, stage 2: execute
                $stmt->execute();

// TO DO: BIND NEEDED RESULT VARIABLES.
			// Bind result variables 
			// In this example, aircraft_id and aircraft_name will be returned from the SQL statement.
			// Thus, the returned values will be stored in variables named aircraft_id and aircraft_name.
			$stmt->bind_result($House_Number, $Street_Name, $City, $Rent_Per_Person); 

        // TO DO: CHANGE FORM OUTLINE.
                    /* fetch values */ 
        echo '<table>';
            echo '<tr>';
                echo '<th>Address</th>';
                echo '<th>_</th>';
                echo '<th>_</th>';
                echo '<th>Rent</th>';
            echo '</tr>';
        while ($stmt->fetch()) {
            echo '<tr><td>' . $House_Number . '</td><td>' . $Street_Name . '</td><td>' . $City . '</td><td>'. $Rent_Per_Person . '</td><tr>';
        }
        echo '</table>';

 
			/* close statement and connection*/ 
			$stmt->close(); 
            $mysqli->close();
	
           echo'<form action="rateListing_submit.php" method="post">
           <!--add intake functionality for the ratingand comment -->
		<br>
            Please Enter Rating: (1 is lowest, 5 is highest)<br>
            <input type="text" name="rating_score"/>	<br>
            Please Enter Comments:<br>
            <input type="text" name="rating_comment"/>	<br>
			<!-- The button for this form. -->
            <input type="hidden" name="user_id" value="' . $user_id . '"/>
            <input type="hidden" name="rental_listing_ID" value="' . $rental_listing_ID . '"/>
			<input type="submit" value="Submit Rating"/>
		</br>
    </form>';
    ?>
</body>

