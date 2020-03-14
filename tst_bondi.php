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
	<form action="buyerHome.php" method="get">

		<?php
			// Enable error logging: 
			error_reporting(E_ALL ^ E_NOTICE);
			// mysqli connection via user-defined function
			include ('./my_connect.php');
			$mysqli = get_mysqli_conn();
		?>

		<?php
        // must grab variables coming in and use them in the below sql query 

// TO DO: CHANGE SQL STATEMENT
			// SQL statement (change to reflect what you need).
			// Will probably be the main change (and hardest change) that you do.
			$sql = "SELECT rental_listing.House_Number, rental_listing.Street_Name, rental_listing.City, rental_listing.Rent_Per_Person 
			FROM rental_listing WHERE Rental_Listing_ID = 20001";
				
			// Prepared statement, stage 1: prepare
            $stmt = $mysqli->prepare($sql);
            
            // (2) Updated tag is the name of the playlist that the song is being transferred to
            //$User_ID =  $_GET["User_ID"]; 
            //$Rental_Listing_ID =  $_GET['Rental_Listing_ID']; // not actually sure what my parameters are 
            //$Tag =  $_GET['Tag'];
            //$Updated_Tag =  $_GET['Updated_Tag'];
            //$Rental_Listing_ID = 20001;

            // (3) "i" for integer, "d" for double, "s" for string, "b" for blob 
            //$stmt-> bind_param('i', $Rental_Listing_ID);//TODO Bind Php variables to MySQL parameters 
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
                echo '<th>House_Number</th>';
                echo '<th>Street_Name</th>';
                echo '<th>City</th>';
                echo '<th>Rent_Per_Person</th>';
            echo '</tr>';
        while ($stmt->fetch()) {
            echo '<tr><td>' . $House_Number . '</td><td>' . $Street_Name . '</td><td>' . $City . '</td><td>'. $Rent_Per_Person . '</td><tr>';
        }
        echo '</table>';

            // add intake functionality for the ratingand comment 

			/* close statement and connection*/ 
			$stmt->close(); 
			$mysqli->close();
		?>

		<br>
			<!-- The button for this form. -->
			<input type="submit" value="Continue"/>
		</br>
	</form>
</body>

