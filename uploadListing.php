<!-- Upload Listing Page  -->

<head>
  <title>Warrior Housing</title>
  <link rel="stylesheet" href="styles/formFormat.css">
</head>

<body>
    <h1>Warrior Housing</h1>
    <?php
        $userId = $_POST['user_id']; 
    echo '
    
    <h1>Warrior Housing</h1>
    <a href="login.php" class="button">Log Out</a>
    
    <div>
        <h2>Upload Listing</h2>
        <!-- Directs to the uploadListingIntoDatabase.php if the form is completely filled out.
         Uses post as it is more secure than get -->
        <form action="uploadListingIntoDatabase.php" method="post">

            <p>Country:</p>
            <input type="text" name="country" required/><br>
            <p>City:</p>
            <input type="text" name="city" required/><br>
            <p>Street Name:</p>
            <input type="text" name="streetName" required/><br>
            <p>House Number:</p>
            <input type="number" name="houseNo" required/><br>
            <p>Number of Vacancies:</p>
            <input type="number" name="vacancies" required/><br>
            <p>Rent Per Person:</p>
            <input type="number" name="price" required/><br>
            <p>Availability Length (in months):</p>
            <input type="number" name="availabilityLength" required/><br>
            <p>Parking Provided:</p>
            <input type="checkbox" name="parking"/>
            <p>A/C Provided:</p>
            <input type="checkbox" name="ac"/>
            <p>Washer/Dryer Provided:</p>
            <input type="checkbox" name="washer"/>
            <p>Furnished:</p>
            <input type="checkbox" name="furnished"/>
            <p>WiFi:</p>
            <input type="checkbox" name="wifi"/>
            <p>Electricity:</p>
            <input type="checkbox" name="electricity"/>
            <p>Water:</p>
            <input type="checkbox" name="water"/>
            <input type="hidden" name="rentalType" value="Internal"/>';
            
            echo            
            '<input type="hidden" name="userId" value="'. $userId . '"/> <br><br>

            <input type="submit" name="submit" class="teal" value="Upload"/>
        </form>
    </div>';
    ?>

</body>