<!-- Page 1.1 -->
<!-- Registration Page  -->

<head>
  <title>Warrior Housing</title>
</head>

<body>
	<h1>Warrior Housing</h1>
	<h2>Registration</h2>
    <h4>Please create two accounts if you are both a buyer and a seller.</h4>
    <p>If you are a student, please sign up with your @uwaterloo email.</p>

    <!-- Directs to the signUpComplete.php when the user presses the Continue button. 
    Uses post as it is more secure than get. -->
    <div>
        <form action="registerSpecificCategory.php" method="post">
            <!-- Stores the user inputs into variables to be fetched in another file. -->
            Name: <br>    
            <input type="text" name="name" placeholder="name" required/><br>
            Email: <br>   
            <input type="email" name="email" required/><br>
            Password: <br>   
            <input type="password" name="password" required/><br> <br>
            Category:
            <select id="category" name="category" required>
                <option value="buyer">Buyer</option>
                <option value="seller">Seller</option>
            </select> 
            <br>
            <input type="submit" name="submit" class="pink" value="Continue"/>
        </form>
        <div>Already have an account?</div>
        <br><a href="login.php" class="button">Login</a></br>
    </div>
</body>


