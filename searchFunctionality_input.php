<!-- Search Listing Page -->

<head>
  <title>Warrior Housing</title>
  <link rel="stylesheet" href="styles/formFormat.css">
</head>

<body>
	h1>Warrior Housing</h1>
	<?php
		$user_id = $_POST["user_id"];
		echo '
			

				<form id="form11" action="searchFunctionality_search.php" method="post">		
				<input type="hidden" name="user_id" value="' . $user_id . '"/>
				<br>
						Search by Street Name<br>
						<input type="text" name="search"/>	<br>
						<!-- The button for this form. -->
						<input type="submit" value="Submit Search"/>
					</br>
					<br>
						Search by City<br>
						<input type="text" name="city"/>	<br>
						<!-- The button for this form. -->
						<input type="submit" value="Submit Search"/>
					</br>
				</form>

				<form id="form3" action="buyerHome.php" method="post">
					<input type="hidden" name="user_id" value="' . $user_id . '"/>
					<input type="submit" value="Back To Home"/>
				</form>
		'
	?>
</body>
