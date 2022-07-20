<?php

include_once "helper_funcs.php";
session_start();

if(isset($_POST['Home'])){
    header("location: index.php");
}
?>

<html>
    <head>  
        <meta charset="UTF-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<link rel="stylesheet" href="addplaylist.css">
    </head>

    <body>
    <form  method="post" class="addplaylistform">
        <button class="profilebutton" name="Home" type="Submit" value="Edit">MeTube Home</button>
    </form>
        <?php displayplaylistcontent($_GET['playlist_id']); ?>
    </body>
</html>