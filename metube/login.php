<?php 

session_start();
$_SESSION['account'] = "";
include_once "helper_funcs.php";


//check if the Login button was pressed
if(isset($_POST['Login'])){

	//retrieve email and password from form
	$username = $_POST['username'];
	$password = $_POST['password'];

	if($username == "" || $password == ""){
		echo "Error - username or password missing\r\n";
	}

	else{
		$log_check = login_check($username, $password);

		if($log_check == 0)
			echo "Error - user: ".$username." was not found";
		else if($log_check == 2)
			echo "Login Failed - Password incorrect";
		else{
			$_SESSION['account'] = $username;
			header('Location: index.php'); //placeholder redirect to know if login succeeded
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
		<title>Login</title>
	
	</head>
	<body>
	
	<form action="login.php" class="logsignform" method="post">
		<div class="username">
			<h1>Username</h1>
			<input type="text" name="username" value="">
		</div>
	
		<div class="password">
			<h1>Password</h1>
			<input type="password" name="password" value="">
		</div>

		<button name="Login" type="submit" value="Login" class="subbutton">Login</button>
	
	</form>

	<p>Don't have an account? <a href="signup.php">Sign Up</a></p>
	<p>Browse videos without logging in? <a href="index.php">Click Here</a></p>
	
	</body>

</html>