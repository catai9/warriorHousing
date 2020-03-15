<!-- Page 2.1 -->
<!-- Login Page  -->

<head>
  <title>Warrior Housing</title>
</head>

<body>
    
    <h1>Warrior Housing</h1>
    <h2>Login Page</h2>
    
    <div>
        <!-- Directs to the loginCheck.php to check if the user successfully log ins.
         Uses post as it is more secure than get -->
        <form action="loginCheck.php" method="post">

            <p>Enter email: </p>
            <!-- Stores the user input of email into a variable named email. -->
            <input type="text" name="email" required/><br>
            <input type="password" name="password" required/><br>
            <input type="submit" name="submit" class="teal" value="Continue"/>
        </form>
        <div>Need an account?</div>
        <br><a href="index.php" class="button">Register</a></br>
    </div>

</body>