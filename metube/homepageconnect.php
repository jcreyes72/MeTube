<?php 

$servername = "mysql1.cs.clemson.edu";
$user = "metube4620_k213";
$pass = "holymoly99";
$dbname = "metube4620_zd9o";

//copied rest of this from his slides just using our database
//I manually entered myself as a user in our user table thru the command line so that I could test if I could retrieve values
$db = mysqli_connect($servername, $user, $pass, $dbname) or die ('Could not connect to the server' .mysqli_error($db));

?>
