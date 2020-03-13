<body>
<h1>Cruising Range Information</h1>

<?php
// Enable error logging: 
error_reporting(E_ALL ^ E_NOTICE);
// mysqli connection via user-defined function

include('./my_connect.php');
$mysqli = get_mysqli_conn();

// SQL statement
$sql = "SELECT a.crusingrange, a.aname "
. "FROM aircraft a "
. "WHERE a.aid = ?";

// Prepared statement, stage 1: prepare
$stmt = $mysqli->prepare($sql);

// Prepared statement, stage 2: bind and execute 
$aid = $_GET['aid']; 
// "i" for integer, "d" for double, "s" for string, "b" for blob 
$stmt->bind_param('i', $aid); 
$stmt->execute();

// Bind result variables 
$stmt->bind_result($aircraft_cruisingrange, $aircraft_name); 

/* fetch values */ 
if ($stmt->fetch()) 
{ 
printf ('Cruising Range for Aircraft %s is %s', $aircraft_name, $aircraft_cruisingrange);
//echo 'Cruising Range for Aircraft ' .$aircraft_name.' is: ' . $aircraft_cruisingrange; 
} 
//else
//{
//echo 'Record not found'; 
//}

/* close statement and connection*/ 
$stmt->close(); 
$mysqli->close();
?>
</body>

