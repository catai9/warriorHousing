<!-- Search Listing Page -->

<head>
  <title>Warrior Housing</title>
  <link rel="stylesheet" href="styles/listing.css">
</head>

<body>
	<?php
		$user_id = $_POST["user_id"];
		echo '<form action="buyerHome.php" method="post">
        <input type="hidden" name="user_id" value="' . $user_id . '"/>
        <input type="submit" class="link" value="Return to Home"/>
		</form>';

		echo '<h1>Warrior Housing</h1>';
		echo '
			<div>
				<form id="form11" action="searchFunctionality_search.php" method="post">		
					<input type="hidden" name="user_id" value="' . $user_id . '"/>
					<br>
						<p>Keywords:</p>
						<input type="text" name="search" required/>
						<p>Search By:</p>
						<select id="category" name="category" required>
							<option value="street">Street Name</option>
							<option value="city">City</option>
						</select> <br><br>
						<!-- The button for this form. -->
						<input type="submit" class="orange" value="Submit Search"/>
				</form>
			</div>
		'
	?>
</body>
