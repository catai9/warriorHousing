<!-- Page 9.1 -->
<!-- Upload Listing Page  -->

<head>
  <title>Warrior Housing</title>
</head>

<body>
    <?php
        $userId = $_POST['user_id']; 
    echo '
    
    <h1>Warrior Housing</h1>
    <h2>Upload Listing Page</h2>
    
    <div>

        <!-- Directs to the uploadListingIntoDatabase.php if the form is completely filled out.
         Uses post as it is more secure than get -->
        <form action="uploadListingIntoDatabase.php" method="post">

            Country:
            <input type="text" name="country" required/><br>
            City:
            <input type="text" name="city" required/><br>
            Street Name:
            <input type="text" name="streetName" required/><br>
            House Number:
            <input type="number" name="houseNo" required/><br>
            Number of Vacancies:
            <input type="number" name="vacancies" required/><br>
            Rent Per Person:
            <input type="number" name="price" required/><br>
            Availability Length (in months):
            <input type="number" name="availabilityLength" required/><br>
            Parking Provided:
            <input type="checkbox" name="parking"/><br>
            A/C Provided:
            <input type="checkbox" name="ac"/><br>
            Washer/Dryer Provided:
            <input type="checkbox" name="washer"/><br>
            Furnished:
            <input type="checkbox" name="furnished"/><br>
            WiFi:
            <input type="checkbox" name="wifi"/><br>
            Electricity:
            <input type="checkbox" name="electricity"/><br>
            Water:
            <input type="checkbox" name="water"/><br>
            <input type="hidden" name="rentalType" value="Internal"/>';
            
            echo            
            '<input type="hidden" name="userId" value="'. $userId . '"/>

            <input type="submit" name="submit" class="teal" value="Upload"/>
        </form>
        <br><a href="login.php" class="button">Log Out</a></br>

    </div>';
    ?>

</body>