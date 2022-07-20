<?php 
    session_start();
    include_once "helper_funcs.php";

    if(isset($_POST['addplaylistbutton'])){
        addaplaylist($_POST['pname'], $_POST['playlistdesc']);
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
        <h1>Make a new playlist!</h1>
        <form action="messages.php" method="post">
            <button class="profilebutton" name="Home" type="Submit" value="">MeTube Home</button>
        </form>


        <form action="addplaylist.php" method="post" class="addplaylistform">

                <div class="playlistname">
                    <p>Name your playlist!</p>
                    <input type="text" name="pname" value=""></input>
                </div>

                <div class="messagediv">
                    <p>Description</p>
                    <textarea type="text" name="playlistdesc" value="" class="playlistdesccontent" rows=10 cols=50></textarea>
                    <button name="addplaylistbutton" type="submit" value="" class="profilebutton">Add Playlist</button>
                </div>

                

            </form>
    </body>
</html>