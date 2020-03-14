<!-- Page 2 -->
<!-- Login Page  -->

<head>
  <title>Warrior Housing</title>
</head>

<body>
    
    <h1>Warrior Housing</h1>
    <h2>Login Page</h2>
    
    <div>
        <!-- Directs to the welcome.php if the user successfully log ins.
         Uses post as it is more secure than get -->
        <form action="welcome.php" method="post">

        <?php
            // Enable error logging: 
            error_reporting(E_ALL ^ E_NOTICE);

            // mysqli connection via user-defined function
            include('./my_connect.php');
            $mysqli = get_mysqli_conn();

            // SQL statement to get the current number of adults and children for this booking.
            $sql = "SELECT password "
            . "FROM site_user "
            . "WHERE user_id = ?";

            // Prepared statement, stage 1: prepare
            $stmt = $mysqli->prepare($sql);
            // Prepared statement, stage 2: bind and execute 
            $user_id = $_POST['user_id']; 
            $stmt->bind_param('s', $user_id);
            $stmt->execute();

            // Binds the results to the $password variable.
            $stmt->bind_result($password);

            // If there are values to fetch, i.e. the user exists, then checks if the password is the one in the database.
            if ($stmt->fetch()) { 
                // Hidden input type to pass the booking ID to the next file without allowing users to edit it.
                echo '<input type="hidden" name="bid" value="' . $bID . '"/>'; 
                echo '<label for="nadult">Number of Adult(s): </label>';  
                echo '<input type="number" name="nadult" value="'.$nadult.'"/><br>'; 
                echo '<label for="nchild">Number of Child(ren): </label>';  
                echo '<input type="number" name="nchild" value="'.$nchild.'"/><br>'; 
                // Continue button only appears if the booking exists in the system.
                echo '<input type="submit" name="submit" class="teal" value="Continue"/>';
            } 
            // Message to display for the user if the booking does not exist in the system.
            else {
                echo '<center>Booking not found in the database. Please try again.</center>'; 
            }

            // Close statement and connection. 
            $stmt->close(); 
            $mysqli->close();
        ?>

        </form>
    </div>

</body>