<!-- Page 1 -->
<!-- Registration Page  -->

<head>
  <title>Warrior Housing</title>
</head>

<body>
	<h1>Warrior Housing</h1>
	<h2>Registration</h2>

    <!-- Directs to the signUpComplete.php when the user presses the Continue button. 
    Uses post as it is more secure than get. -->
    <div>
        <form action="signUpComplete.php" method="post">
            <!-- Stores the user inputs into variables to be fetched in another file. -->
            Name: <br>    
            <input type="text" name="name" required/><br>
            Email: <br>   
            <input type="email" name="email" required/><br>
            Password: <br>   
            <input type="password" name="password" required/><br>
            <input type="submit" name="submit" class="pink" value="Continue"/>
        </form>
    </div>
</body>
