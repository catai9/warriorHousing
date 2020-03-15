<!-- Page 9 -->
<!-- Rate Listing Page -->

<head>
  <title>Warrior Housing</title>
</head>


<?php
$user_id = $_POST["user_id"];
?>

<body>
	<h1>Warrior Housing</h1>
	<!-- TO DO: CHANGE PAGE SUBTITLE -->
	<!-- <h2>Search Functionality </h2> -->

<!-- TO DO: CHANGE REDIRECT PAGE-->
	<!-- Which page it will direct go upon submitting the form. -->
	<!-- In this example, if the form submission is successful, it will redirect to TEMPLATETWO.php -->
	<form id="form11" action="searchFunctionality_search.php" method="post">		
	<input type="hidden" name="user_id" value="' . $user_id . '"/>
	<br>
            Search by Street Name<br>
            <input type="text" name="search"/>	<br>
			<!-- The button for this form. -->
			<input type="submit" value="Submit search"/>
		</br>
		<br>
            Search by City<br>
            <input type="text" name="city"/>	<br>
			<!-- The button for this form. -->
			<input type="submit" value="Enter city"/>
		</br>
	</form>

<form id="form3" action="buyerHome.php" method="post">
 <input type="hidden" name="user_id" value="' . $user_id . '"/>
	<input type="submit" value="Back"/>
</form>
</body>

