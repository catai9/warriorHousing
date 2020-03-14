<!-- TO DO: CHANGE BELOW COMMENTS -->
<!-- Page X (Ex. Page 1) -->
<!-- Page Details (ex. Login Page) -->

<head>
  <title>Warrior Housing</title>
</head>

<body>
	<h1>Warrior Housing</h1>
	<!-- TO DO: CHANGE PAGE SUBTITLE -->
	<h2>Search Listings</h2>

<!-- TO DO: CHANGE REDIRECT PAGE-->
	<!-- Which page it will direct go upon submitting the form. -->
	<!-- In this example, if the form submission is successful, it will redirect to TEMPLATETWO.php -->
	<form action="searchResults.php" method="get">

		<?php
			// Enable error logging: 
			error_reporting(E_ALL ^ E_NOTICE);
			// mysqli connection via user-defined function
			include ('./my_connect.php');
			$mysqli = get_mysqli_conn();
		?>

		<?php
// TO DO: CHANGE SQL STATEMENT
			// SQL statement (change to reflect what you need).
			// Will probably be the main change (and hardest change) that you do.
			$sql = "SELECT a.aid, a.aname "
				. "FROM aircraft a";
				
			// Prepared statement, stage 1: prepare
			$stmt = $mysqli->prepare($sql);

			// Prepared statement, stage 2: execute
			$stmt->execute();

// TO DO: BIND NEEDED RESULT VARIABLES.
			// Bind result variables 
			// In this example, aircraft_id and aircraft_name will be returned from the SQL statement.
			// Thus, the returned values will be stored in variables named aircraft_id and aircraft_name.
			$stmt->bind_result($aircraft_id, $aircraft_name); 

// TO DO: CHANGE FORM OUTLINE.
			/* fetch values */ 
			echo '<label for="aid">Pick Aircraft: </label>'; 
			echo '<select name="aid">'; 
			while ($stmt->fetch()) 
			{
				printf ('<option value="%s">%s</option>', $aircraft_id, $aircraft_name); 
			}
			echo '</select><br>'; 

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
