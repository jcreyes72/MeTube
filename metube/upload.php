<?php
    session_start();
    include_once "helper_funcs.php";

    if(isset($_POST['uploadbutton'])){
        uploadvideo($_POST['vname'], $_POST['vfile']);
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

    <h1>Upload a video!</h1>
        <form method="post">
            <button class="profilebutton" name="Home" type="Submit" value="">MeTube Home</button>
        </form>


        <form method="post" class="addplaylistform">

                <div class="playlistname">
                    <p>Name of your video</p>
                    <input type="text" name="vname" value=""></input>

                    <p>File</p>
                    <input type="text" name="vfile" value=""></input>

                    <button name="uploadbutton" type="submit" value="" class="profilebutton">Upload Video</button>
                </div>
            </form>

    <body>

    </body>
</html>