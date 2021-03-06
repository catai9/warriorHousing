<!-- Registration Confirmation Page  -->

<head>
  <title>Warrior Housing</title>
  <link rel="stylesheet" href="styles/formFormat.css">
</head>

<body>
    <h1>Warrior Housing</h1>

    <?php
        // Enable error logging: 
        error_reporting(E_ALL ^ E_NOTICE);

        // mysqli connection via user-defined function
        include('./my_connect.php');
        $mysqli = get_mysqli_conn();

        // SQL statement to insert the user inputted values into the guest table.
        $sql = "INSERT INTO site_user "
        . "VALUES (null, ?, ?, ?) ";

        // SQL statement 2: finds the guest ID for that guest.
        $sql2 = "SELECT user_id "
        . "FROM site_user "
        . "WHERE name = ? and email = ? and password = ? ";

        // SQL statement 3: inputs the information into the buyer table.
        $sqlBuyer = "INSERT INTO buyer "
        . "VALUES (?, ?) ";

        // SQL statement 4: inputs the information into the seller table.
        $sqlSeller = "INSERT INTO seller "
        . "VALUES (?, ?) ";

        // Prepared statement, stage 1: prepare
        $stmt = $mysqli->prepare($sql);

        // Fetches the needed values from the previous file. 
        $name = $_POST['name']; 
        $email = $_POST['email']; 
        $password = $_POST['password'];
        $category = $_POST['category'];

        // Prepared statement, stage 2: bind and execute
        $stmt->bind_param('sss', $password, $name, $email); 
        
        if($stmt->execute()){
            $stmt->close(); 
            //Prepare second sql statement to provide user with the ID of the newly inserted guest.
            $stmt2 = $mysqli->prepare($sql2);
            $stmt2->bind_param('sss', $name, $email, $password); 
            $stmt2->execute();
            $stmt2->bind_result($user_id); 
            // Checks to make sure that the ID can be fetched. 
            // If it can, then that means that the guest was successfully inserted. 
            if ($stmt2->fetch()) { 
                // Close statement and connection.
                $stmt2-> close();
                if ($category=="buyer"){
                    $studentID = $_POST['studentID'];
                    // Prepare the SQL statement to insert into the buyer table.
                    $buyerstmt = $mysqli->prepare($sqlBuyer);
                    $buyerstmt->bind_param('is', $user_id, $studentID); 
                    if($buyerstmt->execute()){
                        // If statement executes successfully, then prints a success message to the user.
                        echo '<div>' . $name . ' has been added successfully!<br><br>';
                        echo '<form action="login.php">';
                        echo '<input type="submit" name="submit" class="pink" value="Please Proceed to Login"/> </form></div>';
                        // Close statement and connection.
                        $buyerstmt-> close();
                    } else {
                        // Prints message to the user if the guest was not inserted into the table.
                        echo '<div>Unsuccessful Registration. Please try again.<br><br>';
                        echo '<form action="index.php">';
                        echo '<input type="submit" name="submit" class="pink" value="Try Again"/> </form></div>';
                    }
                } else {
                    $phone = $_POST['phone'];
                    // Prepare the SQL statement to insert into the seller table.
                    $sellerstmt = $mysqli->prepare($sqlSeller);
                    $sellerstmt->bind_param('is', $user_id, $phone);
                    if($sellerstmt->execute()) {
                        // If statement executes successfully, then prints a success message to the user.
                        echo '<div>' . $name . ' has been added successfully!<br><br>';
                        echo '<form action="login.php">';
                        echo '<input type="submit" name="submit" class="pink" value="Please Proceed to Login"/> </form></div>';
                        // Close statement and connection.
                        $sellerstmt-> close();
                    } else {
                        // Prints message to the user if the guest was not inserted into the table.
                        echo '<div>Unsuccessful Registration. Please try again.<br><br>';
                        echo '<form action="index.php">';
                        echo '<input type="submit" name="submit" class="pink" value="Try Again"/> </form></div>';
                    }
                }
             } 
            else {
                // Prints message to the user if the guest was not inserted into the table.
                echo '<div>Unsuccessful Registration. The email may already be taken. <br> Please try again with a different email.<br><br>';
                echo '<form action="index.php">';
                echo '<input type="submit" name="submit" class="pink" value="Try Again"/> </form></div>';
            }
        }
        // Prints message to the user if the guest was not inserted into the table.
        else {
            echo '<div>Unsuccessful Registration. The email may already be taken. <br> Please try again with a different email.<br><br>';
            echo '<form action="index.php">';
            echo '<input type="submit" name="submit" class="pink" value="Try Again"/> </form> </div>';
        }

        // Close statement and connection.
        $mysqli->close();

    ?>
</body>