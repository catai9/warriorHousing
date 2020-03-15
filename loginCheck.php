<!-- Page 2.2 -->
<!-- Login Page Continued  -->

<head>
  <title>Warrior Housing</title>
</head>

<body>
    
    <?php
        // Enable error logging: 
        error_reporting(E_ALL ^ E_NOTICE);

        // mysqli connection via user-defined function
        include('./my_connect.php');
        $mysqli = get_mysqli_conn();

        // SQL statement
        $sql = "SELECT user_id, password "
        . "FROM site_user "
        . "WHERE email = ?";

        // SQL buyer statement
        $sqlBuyer = "SELECT user_id "
        . "FROM buyer "
        . "WHERE user_id = ?";

        // Prepared statement, stage 1: prepare
        $stmt = $mysqli->prepare($sql);

        // Fetches the needed values from the previous file. 
        $email = $_POST['email']; 
        $password = $_POST['password']; 

        // Bind and execute sql statement.
        $stmt->bind_param('s', $email); 
        $stmt->execute();

        // Bind result.
        $stmt->bind_result($user_id, $act_password); 

        if ($stmt->fetch()) { 
            /* close statement and connection*/ 
            $stmt->close(); 
            // Check if corect password.
            if(strcmp($password, $act_password) == 0) {
                // Prepared statement, stage 1: prepare
                $stmt2 = $mysqli->prepare($sqlBuyer);
                // Bind and execute sql statement.
                $stmt2->bind_param('i', $user_id); 
                $stmt2->execute();
                // If the user is in buyer table. 
                if ($stmt2->fetch()) {
                    echo '<form action="buyerHome.php" method="post">';
                    echo '<input type="hidden" name="user_id" value="' . $user_id . '"/>'; 
                    echo '<p>Successful Login</p>';
                    echo '<input type="submit" name="submit" class="teal" value="Proceed"/>';
                    echo '</form>';
                }
                // Else, user is a seller. Redirect to seller page.
                else {
                    echo '<form action="uploadListing.php" method="post">';
                    echo '<input type="hidden" name="user_id" value="' . $user_id . '"/>'; 
                    echo '<p>Successful Login</p>';
                    echo '<input type="submit" name="submit" class="teal" value="Proceed"/>';
                    echo '</form>';
                }
                $stmt2->close();
            } else {
                echo '<p>Wrong password entered</p>';
                echo '<br><a href="login.php" class="button">Try again</a></br>';
            }
        } 
        else {
            echo 'Invalid user. Please make sure you are registered.'; 
            echo '<br><a href="login.php" class="button">Go back to Login</a></br>';
        }

        /* close statement and connection*/   
        $mysqli->close();
    ?>

</body>