<!-- Page 2.1 -->
<!-- Login Page  -->

<head>
  <title>Warrior Housing</title>
  <link rel="stylesheet" href="styles/formFormat.css">
</head>

<body>
    
    <h1>Warrior Housing</h1>
    
    <div>
        <h2>Login</h2>
        <!-- Directs to the loginCheck.php to check if the user successfully log ins.
         Uses post as it is more secure than get -->
        <form action="loginCheck.php" method="post">
            <p>Enter email: </p>
            <!-- Stores the user input of email into a variable named email. -->
            <input type="text" name="email" required/>
            <p>Enter password: </p>
            <input type="password" name="password" required/> <br><br>
            <input type="submit" name="submit" class="teal" value="Log in"/> <br>
        </form>
        Need an Account? <br>
        <a href="index.php" class="button">Register</a>
    </div>

</body>