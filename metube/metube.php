<?php

echo("Testing the WAMP server");

//I found these values on our buffet page
//I am VPN connected - I thinkkk u prob need to be but idk
$servername = "mysql1.cs.clemson.edu";
$user = "metube4620_k213";
$pass = "holymoly99";
$dbname = "metube4620_zd9o";

//copied rest of this from his slides just using our database
//I manually entered myself as a user in our user table thru the command line so that I could test if I could retrieve values
$db = mysqli_connect($servername, $user, $pass, $dbname) or die ('Could not connect to the server' .mysqli_error($db));
$query = 'SELECT * FROM user';
$result = mysqli_query($db, $query) or die("Query error: " . mysqli_error($db). "\n");

//print results in html

echo "<table>\n";
while($line = mysqli_fetch_array($result, MYSQLI_ASSOC)){
	echo "\t<tr>\n";
	
	foreach($line as $col_value){
		echo "\t\t<td>$col_value</td>\n";
	}
	echo "\t</tr>\n";
	
}
echo "</table>\n";
mysqli_free_result($result);
mysqli_close($db);



?>