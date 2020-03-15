<!-- Registration Page  -->

<head>
  <title>Warrior Housing</title>
  <link rel="stylesheet" href="styles/formFormat.css">
</head>

<body>
	<h1>Warrior Housing</h1>

    <!-- Directs to the registerSpecificCategory.php when the user presses the Continue button. 
    Uses post as it is more secure than get. -->
    <div>
        <h2>Registration</h2>
        <h4>Please create two accounts if you are both a buyer and a seller.<br>
        If you are a student, please sign up with your @uwaterloo email.</h4>
        <form action="registerSpecificCategory.php" method="post">
            <!-- Stores the user inputs into variables to be fetched in another file. -->
            <p> Name: </p>    
            <input type="text" name="name" placeholder="name" required/>
            <p>Email: </p>  
            <input type="email" name="email" required/>
            <p>Password: </p>   
            <input type="password" name="password" required/>
            <p>Category: </p>
            <select id="category" name="category" required>
                <option value="buyer">Buyer</option>
                <option value="seller">Seller</option>
            </select> 
            <br><br>
            <input type="submit" name="submit" class="pink" value="Register"/> <br>
        </form>
        Already have an account?
        <br><a href="login.php">Log in</a>
    </div>
</body>


