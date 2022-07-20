<?php 
include_once('connection.php');
//session_start();



//check if a login succeeded
function login_check($username, $password){
	$db = get_connection();
	
	
	$query = "SELECT * FROM user WHERE user_id='$username'";
	$result = mysqli_query($db,$query);

	if(!$result){
		die ("Login failed - Error querying the database");
	}

	else{
		$row = mysqli_fetch_row($result);

		if($row == 0)
			return 0; //user not found
		else if(strcmp($row[2],$password) == 0)
			return 1; // login success
		else
			return 2; //login failed

	}

	//mysqli_close($db);
	
}

//add a new account to the db
function add_account($username, $email, $password){
	$db = get_connection();

	$user_exist_query = "SELECT * FROM user WHERE user_id='$username'";
	$user_exist_result = mysqli_query($db, $user_exist_query);
	
	if(!$user_exist_result){
		die ("Sign up failed - Error querying the database");
	}

	else{
		$row = mysqli_fetch_row($user_exist_result);

		if($row != 0){
			echo "User already exists";
			return 0; //user already exists
		}
		else{
			$about = "No bio added";
			$add_user_query = "INSERT INTO user values('$username', '$about', '$password', 0, '$email')";
			$add_user_result = mysqli_query($db, $add_user_query);

			if(!$add_user_query)
				die("Could not add account");
			else
				return 1; //successfully created account
		}
	}

}

function updatepassword($password){
	$db = get_connection();
	$acc = $_SESSION['account'];

	$update_password_query = "UPDATE user SET password='$password' WHERE user_id = '$acc'";
	$result = mysqli_query($db, $update_password_query);

	if(!$result){
		die("Can't update password - Error querying the database");
	}

	return 0; //if result exists, password was changed


}

function displayplaylists(){
	$db = get_connection();
	$acc = $_SESSION['account'];

	$get_playlists_query = "SELECT playlist_name, description, playlist_id FROM playlist WHERE user_id='$acc'";
	$result = mysqli_query($db, $get_playlists_query);

	if(!$result){
		die("Can't get Playlists - Error querying the database");
	}
	else{

		while($line = mysqli_fetch_row($result)){
			$name = $line[0];
			$desc = $line[1];
			$id = $line[2];

			$redirect = "playlistcontent.php?playlist_id=$id";

			echo "<a href='$redirect'> Name: $name </a> <br>";
			echo "Description: $desc <br>";
			echo "<br>";
		}


	}


}

function displayinbox(){
	$db = get_connection();
	$acc = $_SESSION['account'];

	$get_messages_query = "SELECT sent_date, contact_id, message FROM messages WHERE user_id='$acc'";
	$result = mysqli_query($db, $get_messages_query);

	if(!$result){
		die("Can't get messages - Error querying the database");
	}
	else{
		while($line = mysqli_fetch_row($result)){
			$date = $line[0];
			$from = $line[1];
			$messagecontent = $line[2];

			echo "From: $from <br>";
			echo "Sent: $date <br>";
			echo "$messagecontent <br><br>";

		}
	}
}

function displaysent(){
	$db = get_connection();
	$acc = $_SESSION['account'];

	$get_messages_query = "SELECT sent_date, user_id, message FROM messages WHERE contact_id='$acc'";
	$result = mysqli_query($db, $get_messages_query);

	if(!$result){
		die("Can't get messages - Error querying the database");
	}
	else{
		while($line = mysqli_fetch_row($result)){
			$date = $line[0];
			$sent_to = $line[1];
			$messagecontent = $line[2];

			echo "To: $sent_to <br>";
			echo "Sent: $date <br>";
			echo "$messagecontent <br><br>";

		}
	}
}

function sendmessage($sendingto, $themessage){
	$db = get_connection();
	$acc = $_SESSION['account'];

	$user_exist_query = "SELECT * FROM user WHERE user_id='$sendingto'";
	$user_exist_result = mysqli_query($db, $user_exist_query);
	
	if(!$user_exist_result){
		die ("Can't send message - Error querying the database");
	}

	$row = mysqli_fetch_row($user_exist_result);
	if($row == 0){
		echo("Can't send message - That user does not exist");
	}
	else{



	$send_message_query = "INSERT INTO messages (sent_date, user_id, contact_id, message) VALUES(NOW(), '$sendingto', '$acc', '$themessage')";
	$result = mysqli_query($db,$send_message_query);

	if(!$result){
		die("Could not send message - Error querying database");
	}

	return 0; //sent message successfully
	}

}


function display_bio(){
	$db = get_connection();
	$acc = $_SESSION['account'];
	$query = "SELECT about FROM user WHERE user_id='$acc'";

	$result = mysqli_query($db,$query);

	if(!$result){
		die ("Bio failed - Could not query the database");
	}
	else{
		$row = mysqli_fetch_row($result);
		echo $row[0];
		return 0;
	}

}

function setbio($newbio){
	$db = get_connection();
	$acc = $_SESSION['account'];

	$add_bio_query = "UPDATE user SET about='$newbio' where user_id='$acc'";
	$result = mysqli_query($db, $add_bio_query);

	if(!$result){
		die("Can't change bio - Errory querying the database");
	}

	return 0; //if result exists, bio was changed


}

function displaycontacts(){
	$db = get_connection();
	$acc = $_SESSION['account'];

	$query = "SELECT contact_id FROM contacts WHERE user_id='$acc'";
	$result = mysqli_query($db, $query);

	if(!$result){
		die("Subscriptions failed - Could not query the database");
	}
	else{

		echo "<table>\n";
		while($line = mysqli_fetch_array($result, MYSQLI_ASSOC)){
			echo "\t<tr>\n";
	
			foreach($line as $col_value){
				echo "\t\t<td>$col_value</td>\n";
			}
		echo "\t</tr>\n";
	
		}
	echo "</table>\n";
	return 0;
	}
}

function display_subs(){
	$db = get_connection();
	$acc = $_SESSION['account'];

	$query = "SELECT subscription_id FROM subscriptions WHERE user_id='$acc'";
	$result = mysqli_query($db, $query);

	if(!$result){
		die("Subscriptions failed - Could not query the database");
	}
	else{

		echo "<table>\n";
		while($line = mysqli_fetch_array($result, MYSQLI_ASSOC)){
			echo "\t<tr>\n";
	
			foreach($line as $col_value){
				echo "\t\t<td>$col_value</td>\n";
			}
		echo "\t</tr>\n";
	
		}
	echo "</table>\n";
	return 0;
	}

}

function displayvideos($videoname, $videofile){
	$numvids = sizeof($videofile);

	for($i = 0; $i < $numvids; $i++){
		$fullfile = "uploads/" . $videofile[$i];
		echo "$i.) <video source src='$fullfile' controls height='400' width='400'></video>";
	}

}

function displaykeywordvideos($word){
	$db = get_connection();
	$acc = $_SESSION['account'];
	

    $query = "SELECT * FROM media WHERE category='$word'";
    $result = mysqli_query($db, $query);

	if(!$result){
        die("Could not display videos - Errory querying the database");
    }
    else{
		$videofile = array();
		$videoname = array();
		$videoid = array();
        while ($row = mysqli_fetch_row($result)){
            $videofile[] = $row[6];
			$videoname[] = $row[1];
			$videoid[] = $row[0];
        }

		$numvids = sizeof($videofile);

		for($i = 0; $i < $numvids ; $i++){
			$fullfile = "uploads/" . $videofile[$i];
			$redirect = "videoplayer.php?media_id=$videoid[$i]";
			echo "   <video source src='$fullfile' height='400' width='400'></video>
			 <a href=$redirect> $videoname[$i] </a>";

		}
    }
}


function addacontact($contact){

	$db = get_connection();
	$acc = $_SESSION['account'];

	$addcontactquery = "INSERT INTO contacts values('$contact','$acc')";
	$addcontactquery2 = "INSERT INTO contacts values('$acc','$contact')";
	$contactexistsquery = "SELECT * FROM user WHERE user_id='$contact'";
	$duplicatecontactquery = "SELECT * FROM contacts WHERE contact_id='$contact' AND user_id='$acc'";

	
	$res1 = mysqli_query($db, $contactexistsquery);
	$res2 = mysqli_query($db, $duplicatecontactquery);

	if(!$res1 || !$res2){
		die("Error - Could not query the database");
	}
	else{

		$row1 = mysqli_fetch_row($res1);
		$row2 = mysqli_fetch_row($res2);

		if($row1 == 0){
			echo("Could not add contact - User does not exist");
		}
		else if($row2 != 0){
			die("Could not add contact - Contact already exists");
		}

		else{


		$res3 = mysqli_query($db, $addcontactquery);
		mysqli_query($db, $addcontactquery2);

		if(!$res3){
			die("Error - Could not query the database");
		}
	}
	}

}

function deletecontact($contact){
	$db = get_connection();
	$acc = $_SESSION['account'];

	$removecontactquery = "DELETE FROM contacts WHERE contact_id='$contact' AND user_id='$acc'";
	$removecontactquery2 = "DELETE FROM contacts WHERE contact_id='$acc' AND user_id='$contact'";

	$res = mysqli_query($db,$removecontactquery);
	mysqli_query($db, $removecontactquery2);

	if(!$res){
		die("Error - Could not query the database");
	}

}

function addfavorite($mediaid){

	$db = get_connection();
	$acc = $_SESSION['account'];

	if($acc == ""){
		echo("Cant add favorite - You are not logged in");
	}

	else{

	$favexistsquery = "SELECT * from favorited WHERE user_id='$acc' AND media_id='$mediaid'";
	$result = mysqli_query($db, $favexistsquery);
	$row = mysqli_fetch_row($result);

	if($row != 0){
		echo "This video is already favorited!";
	}

	else{
	$addtofavsquery = "INSERT INTO favorited values ('$acc','$mediaid')";
	$res2 = mysqli_query($db, $addtofavsquery);

	if(!$res2){
		die ("Could not add to favorites - Error querying database");
	}
	else
		echo "Video added to favorites!";

}
	}

}

function displayfavorites(){

	$db = get_connection();
	$acc = $_SESSION['account'];

	$favquery = "SELECT * FROM favorited WHERE user_id='$acc'";
	$result = mysqli_query($db, $favquery);

	while($line = mysqli_fetch_row($result)){
		$name = $line[1];
		$query2 = "SELECT name FROM media WHERE media_id='$name'";

		$result2 = mysqli_query($db, $query2);
		$line2 = mysqli_fetch_row($result2);

		$redirect = "videoplayer.php?media_id=$name";

		echo " <a href=$redirect> $line2[0] </a> <br>";
	}
}

function subscribe($subto){

	$db = get_connection();
	$acc = $_SESSION['account'];

	if($acc == ""){
		echo("Cant Subscribe - You are not logged in");
	}
	else{

	$subexistsquery = "SELECT * FROM subscriptions WHERE subscription_id='$subto' AND user_id='$acc'";
	$result = mysqli_query($db, $subexistsquery);

	$row = mysqli_fetch_row($result);

	if($row != 0){
		echo "Subscription already exists!";
	}

	else{
		$addsubquery = "INSERT INTO subscriptions (subscription_id, user_id) values ('$subto','$acc')";
		$res2 = mysqli_query($db, $addsubquery);

		echo "Subscribed successfully!";
	}

	}
}

function unsubscribe($unsub){
	$db = get_connection();
	$acc = $_SESSION['account'];

	if($acc == ""){
		echo("Cant Unsubscribe - You are not logged in");
	}


	else{

		$subbedquery = "SELECT * FROM subscriptions WHERE user_id='$acc' AND subscription_id='$unsub'";
		$result = mysqli_query($db, $subbedquery);

		$row = mysqli_fetch_row($result);

		if($row == 0){
			echo "Cant unsubscribe - You were never subscribed to this user!";
		}
		else{
			$unsubquery = "DELETE FROM subscriptions WHERE user_id='$acc' AND subscription_id='$unsub'";
			$res2 = mysqli_query($db, $unsubquery);

			echo "Unsubscribed Successfully";
		}

	}

}

function addcomment($comment, $mediaid){
	$db = get_connection();
	$acc = $_SESSION['account'];

	if($acc == ""){
		echo("Cant add comment - You are not logged in");
	}
	else if($comment == ""){
		echo ("Cant add comment - no comment written");
	}
	else{
		$addcommentquery = "INSERT INTO comments (user_id, media_id, tstamp, comment) values ('$acc','$mediaid',NOW(), '$comment')";
		$result = mysqli_query($db, $addcommentquery);
	}


}

function addaplaylist($name, $desc){
	$db = get_connection();
	$acc = $_SESSION['account'];

	if($name == "" || $desc == ""){
		echo "Could not add playlist - Either no name or no description entered";
	}
	else{
		$addplaylistquery = "INSERT INTO playlist (user_id, tstamp, description, playlist_name) values ('$acc', NOW(), '$desc', '$name')";
		$result = mysqli_query($db,$addplaylistquery);

		if(!$result){
			die("Cant add playlist - Error querying the database");
		}

		header("location: profile.php");
		echo "Playlist added successfully";
	}
}

function addvideotoplaylist($playlistname){
	$db = get_connection();
	$acc = $_SESSION['account'];
	$videoid = $_SESSION['mediaid'];

	if($playlistname == ""){
		echo "Cant add to playlist - No name entered";
	}

	else{
		$playlistexists = "SELECT playlist_id FROM playlist WHERE playlist_name='$playlistname' AND user_id='$acc'";
		$result = mysqli_query($db, $playlistexists);

		if(!$result){
			die("Error querying database");
		}

		$row = mysqli_fetch_row($result);

		if($row == 0){
			echo "Cant add to playlist - That playlist doesn't exist";
		}

		else{

			$duplicatequery = "SELECT * FROM playlist_content WHERE playlist_id='$row[0]' AND media_id='$videoid'";
			$duperes = mysqli_query($db,$duplicatequery);
			$row2 = mysqli_fetch_row($duperes);

				if(!$duperes){
					die("Error querying the database");
				}

				if($row2 != 0){
					echo "That video is already in that playlist!";
				}
				else{

				$addtoplaylistquery = "INSERT INTO playlist_content values ('$row[0]','$videoid')";
				$res2 = mysqli_query($db, $addtoplaylistquery);

				if(!$res2){
					die ("Error adding to playlist");
				}
			
				header("location: profile.php");
			}
		}
	}

}

function displayplaylistcontent($pid){
	$db = get_connection();
	$acc = $_SESSION['account'];
	

    $query = "SELECT media_id FROM playlist_content WHERE playlist_id='$pid'";
    $result = mysqli_query($db, $query);

	if(!$result){
        die("Could not display videos - Errory querying the database");
    }
    else{
		$videofile = array();
		$videoname = array();
		$videoid = array();
        while ($row = mysqli_fetch_row($result)){

			$getitems = "SELECT filename, name FROM media WHERE media_id='$row[0]'";
			$itemsresult = mysqli_query($db,$getitems);
			$itemsrow = mysqli_fetch_row($itemsresult);

            $videofile[] = $itemsrow[0];
			$videoname[] = $itemsrow[1];
			$videoid[] = $row[0];
        }

		$numvids = sizeof($videofile);

		for($i = 0; $i < $numvids ; $i++){
			$fullfile = "uploads/" . $videofile[$i];
			$redirect = "videoplayer.php?media_id=$videoid[$i]";
			echo "   <video source src='$fullfile' height='400' width='400'></video>
			 <a href=$redirect> $videoname[$i] </a>";

		}
    }
}

function uploadvideo($vidname, $vidfile){

	$acc = $_SESSION['account'];

	if($vidname == "" || $vidfile == ""){
		echo "Cant upload video - one or more fields missing";
	}
	else{
		if($acc == "")
			echo "Can't upload video - You are not logged in";
	}
}


?>