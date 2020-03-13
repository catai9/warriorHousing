<body>
<h1>Check Cruising Range</h1>

<form action="cruisingrange.php" method="get">

<?php
// Enable error logging: 
error_reporting(E_ALL ^ E_NOTICE);
// mysqli connection via user-defined function
include ('./my_connect.php');
$mysqli = get_mysqli_conn();
//comment 
?>

<?php
// SQL statement
$sql = "SELECT a.aid, a.aname "
	. "FROM aircraft a";
	
// Prepared statement, stage 1: prepare
$stmt = $mysqli->prepare($sql);

// Prepared statement, stage 2: execute
$stmt->execute();

// Bind result variables 
$stmt->bind_result($aircraft_id, $aircraft_name); 

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
<input type="submit" value="Continue"/>
</br>
</form>
</body>
