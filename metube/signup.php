<?php 
session_start();
include_once "helper_funcs.php";

if(isset($_POST['signup'])){

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    if($username == "" || $email == "" || $password == "" || $cpassword == "")
        echo "Error - Missing one or more fields";
    else if($password != $cpassword)
        echo "Error - Passwords do not match!";

    else{
        $add_account_check = add_account($username, $email, $password);

        if($add_account_check == 0)
            echo "Cant create account - User already exists";
        else{
            header('Location: login.php'); // placeholder redirect to know if signup succeeded
        }
    }



}


?>


<html>
    <head>
        <meta charset="UTF-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<link rel="stylesheet" href="logsignup.css">
    </head>

    <body>
        <p>Sign up below!</p>
        <form action="signup.php" method="post" class="logsignform">

            <h1>Username</h1>
            <input type="text" name="username" value="">

            <h1>Email</h1>
            <input type="text" name="email" value="">

            <h1>Password</h1>
            <input type="password" name="password" value="">

            <h1>Confirm Password</h1>
            <input type="password" name="cpassword" value="">

            <button name="signup" type="submit" value="Signup" class="subbutton">Sign Up</button>
        </form>

        <p>Already have an account?<a href="login.php">Log In</a></p>
    </body>
</html>