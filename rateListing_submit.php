<!-- Page 9 -->
<!-- Rate Listing Page -->

<head>
  <title>Warrior Housing</title>
</head>

<body>
	<h1>Warrior Housing</h1>
	<!-- TO DO: CHANGE PAGE SUBTITLE -->
	<h2>Rate Listing Submission Page</h2>

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


            $sql = "INSERT INTO rating
            VALUES (?, ?, ?, ?)"; 


            // Prepared statement, stage 1: prepare
            $stmt = $mysqli->prepare($sql);

            //these values are inputted by the user
            $Rental_Listing_ID =  $_GET["Client_ID"]; //TODO Handle GET parameters
            $User_ID =  $_GET['First_Name'];
            $Score =  $_GET['rating_score'];
            $Comments =  $_GET['rating_comment'];//TODO Handle GET parameters

// TO DO: BIND NEEDED RESULT VARIABLES.
			// Bind result variables 
			// In this example, aircraft_id and aircraft_name will be returned from the SQL statement.
			// Thus, the returned values will be stored in variables named aircraft_id and aircraft_name.

// (3) "i" for integer, "d" for double, "s" for string, "b" for blob 
$stmt-> bind_param('ssss', $Client_ID, $First_Name, $Last_Name, $Email);//TODO Bind Php variables to MySQL parameters 


// $stmt->execute() function returns boolean indicating success 

if ($stmt->execute()) 
{ 
echo '<h1>Success!</h1>'; 
echo '<p>A new user was created with Username: ' . $Client_ID . ', name ' . $First_Name . ' '. $Last_Name . ' and email '. $Email. '</p>';
echo '<p>Please return to the home page and login using your username : '. $Client_ID .'</p>'; 

echo '<form id="form22" action="index.php" method="get">';
echo '<input type="submit" value="Home page"/>'; 
echo '</form>';	
} 
else 
{
echo '<h1>You Failed</h1>'; 
echo '<p>A new user was not created with Username: ' . $Client_ID . ', name ' . $First_Name . ' '. $Last_Name . ' and email '. $Email. '</p>';
echo 'Execute failed: (' . $stmt->errno . ') ' . $stmt->error; 
} 
$stmt->close(); 
$mysqli->close();
?>

		<br>
			<!-- The button for this form. -->
			<input type="submit" value="Continue"/>
		</br>
	</form>
</body>

