<body>
<h1>Search Album Name</h1>
<?php
// Enable error logging: 
error_reporting(E_ALL ^ E_NOTICE);
// mysqli connection via user-defined function

include('./my_connect.php');
$mysqli = get_mysqli_conn();

// SQL statement
$sql = "SELECT Song.Song_ID, Song.Song_Name, Song.Song_Length, Song.Genre, Song.BPM, Album.Album_Name, Artist.Artist_Name, Album.Date_Released  
FROM Song, Album, Artist 
WHERE  Album.Artist_ID = Artist.Artist_ID and Song.Album_ID = Album.Album_ID and Album.Album_Name LIKE ? ";
//does this change 
// Prepared statement, stage 1: prepare
$stmt = $mysqli->prepare($sql);

// Prepared statement, stage 2: bind and execute 

$Client_ID = $_GET['Client_ID']; 
$Album_Name = '%' . $_GET['Album_Name']. '%'; 

// "i" for integer, "d" for double, "s" for string, "b" for blob 
$stmt->bind_param('s', $Album_Name); 
$stmt->execute();

/* fetch values */ 
$stmt->bind_result($v1, $v2, $v3, $v4, $v5, $v6, $v7, $v8); 

echo '<table>';
	echo '<tr>';
		echo '<th>Song ID</th>';
		echo '<th>Song Name</th>';
		echo '<th>Song Length</th>';
		echo '<th>Genre</th>';
		echo '<th>BPM</th>';
		echo '<th>Album Name </th>';
		echo '<th>Artist Name</th>';
		echo '<th>Date of Album Release</th>';
	echo '</tr>';
while ($stmt->fetch()) {
	echo '<tr><td>' . $v1 . '</td><td>' . $v2 . '</td><td>' . $v3 . '</td><td>'. $v4 . '</td><td>'. $v5 . '</td><td>'. $v6 . '</td><td>'. $v7 . '</td><td>'. $v8 . '</td><tr>';
}
echo '</table>';

/* close statement and connection*/ 
$stmt->close(); 
$mysqli->close();
?>

<form id="form3" action="index.php" method="get">
	<input type="submit" value="Home"/>
</form>

</body>