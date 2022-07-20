
<?php 
    
    session_start();
    include_once "helper_funcs.php";

    if(isset($_POST['addplaylistbutton'])){
        addvideotoplaylist($_POST['pname']);
    }
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

        <form action="addtoplaylist.php" method="post" class="addplaylistform">

            <div class="playlistname">
                <button class="profilebutton" name="Home" type="Submit" value="Edit">MeTube Home</button>
                <p>Which playlist would you like to add to?</p>
                <input type="text" name="pname" value=""></input>
                <button name="addplaylistbutton" type="submit" value="" class="profilebutton">Add Video to Playlist</button>
            </div>

         </form>

         <?php displayplaylists(); ?>
    </body>
</html>