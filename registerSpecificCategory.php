<!-- Page 1.2 -->
<!-- Registration Confirmation Page  -->

<head>
  <title>Warrior Housing</title>
</head>


<body>
    <h1>Warrior Housing</h1>
	<h2>Registration Continued</h2>

    <?php
        // Enable error logging: 
        error_reporting(E_ALL ^ E_NOTICE);

        // Fetches the needed values from the previous file. 
        $name = $_POST['name']; 
        $email = $_POST['email']; 
        $password = $_POST['password']; 
        $category = $_POST['category'];
        
        echo '<div>
            <form action="registrationCheck.php" method="post">';
        
        // If statement executes successfully, then prints a success message to the user.
        echo '<input type="hidden" name="name" value="' . $name . '"/>'; 
        echo '<input type="hidden" name="email" value="' . $email . '"/>'; 
        echo '<input type="hidden" name="password" value="' . $password . '"/>'; 
        echo '<input type="hidden" name="category" value="' . $category . '"/>'; 

        if($category == 'buyer') {
            if(strpos($email,"@uwaterloo.ca") !== false) {
                echo '<input type="hidden" name="studentID" value="Y"/>'; 
                echo '<p>You are a student. Please continue if this is correct.</p>';
                echo '<input type="submit" name="submit" class="pink" value="Continue"/>';
            }
            else {
                echo '<input type="hidden" name="studentID" value="N"/>'; 
                echo '<p>You are not a student. Please continue if this is correct.</p>';
                echo '<input type="submit" name="submit" class="pink" value="Continue"/>';
            }
        } else {
            echo 
            'Phone Number: 
                    <input placeholder="0000000000" type="tel" id="phone" name="phone" required> <br> <br>
                    <input type="submit" name="submit" class="pink" value="Continue"/>';
        }

        echo '</form>
            <br><a href="index.php" class="button">Go Back</a></br>
        </div>';

    ?>
</body>