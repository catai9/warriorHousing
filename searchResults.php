<!-- TO DO: CHANGE BELOW COMMENTS -->
<!-- Page X (Ex. Page 1) -->
<!-- Page Details (ex. Login Page) -->

<head>
  <title>Warrior Housing</title>
</head>

<body>
    <h1>Warrior Housing</h1>
	<!-- TO DO: CHANGE PAGE SUBTITLE -->
	<h2>Login Page Information</h2>

    <?php
        // Enable error logging: 
        error_reporting(E_ALL ^ E_NOTICE);
        // mysqli connection via user-defined function

        include('./my_connect.php');
        $mysqli = get_mysqli_conn();

// TO DO: CHANGE SQL STATEMENT
        // SQL statement
        $sql = "SELECT a.crusingrange, a.aname "
        . "FROM aircraft a "
        . "WHERE a.aid = ?";

        // Prepared statement, stage 1: prepare
        $stmt = $mysqli->prepare($sql);

// TO DO: CHANGE THE NAME OF THE VARIABLE PASSED IN.
        // Prepared statement, stage 2: bind and execute 
        // In this example, aid was passed in from TEMPLATEONE.php using get.
        $aid = $_GET['aid']; 
        // "i" for integer, "d" for double, "s" for string, "b" for blob 
        $stmt->bind_param('i', $aid); 
        $stmt->execute();

// TO DO: BIND NEEDED RESULT VARIABLES.
        // Bind result variables 
        // In this example, aircraft_cruisingrange and aircraft_name will be returned from the SQL statement.
        // Thus, the returned values will be stored in variables named aircraft_cruisingrange and aircraft_name.
        $stmt->bind_result($aircraft_cruisingrange, $aircraft_name); 

// TO DO: CHANGE PAGE OUTLINE.
        /* fetch values */ 
        if ($stmt->fetch()) { 
            printf ('Cruising Range for Aircraft %s is %s', $aircraft_name, $aircraft_cruisingrange);
        } 
        else {
            echo 'Record not found'; 
        }

        /* close statement and connection*/ 
        $stmt->close(); 
        $mysqli->close();
    ?>
</body>

