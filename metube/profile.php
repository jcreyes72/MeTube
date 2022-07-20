<?php
    session_start();
    include_once "helper_funcs.php";

    if($_SESSION['account'] == ""){
        header('location: login.php');
    }

    if(isset($_POST['Edit'])){
        header('location: editprofile.php');
    }

    if(isset($_POST['Messages'])){
        header('location: messages.php');
    }

    if(isset($_POST['Home'])){
        header('location: index.php');
    }

    if(isset($_POST['addplaylist'])){
        header('location: addplaylist.php');
    }

    if(isset($_POST['addcontactbutton'])){
        addacontact($_POST['addcontact']);
    }

    if(isset($_POST['delcontactbutton'])){
        deletecontact($_POST['delcontact']);
    }

    if(isset($_POST['upload'])){
        header("location: upload.php");
    }
?>


<html>
    <head>
        <meta charset="UTF-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<link rel="stylesheet" href="profile.css">
    </head>
    <body>
        <div class="profilesidebar">
            <h3><?php echo $_SESSION['account'] ?>'s Profile</h3>

            <form action="profile.php" method="post">
                <button class="profilebutton" name="Edit" type="Submit" value="Edit">Edit Profile</button>
                <button class="profilebutton" name="Messages" type="Submit" value="Messages">Messages</button>
                <button class="profilebutton" name="Home" type="Submit" value="Edit">MeTube Home</button>
            </form>

            <div class="bio">
                <h3>Bio</h4>
                <p id="userbio" class="profiletext"><?php display_bio(); ?><p>
            </div>

            <div class="subs">
                <h3>Subscribed To:</h3>
                <p id="usersubs" class="profiletext"><?php display_subs(); ?><p>
            </div>

            <div class="contacts">
                <h3>Contacts</h4>

                <form action="profile.php" method="post" class="addremovecontact">
                    <p>Add Contact:</p>
                    <input type="text" name="addcontact" value=""></input>
                    <button name="addcontactbutton" type="submit" value="" class="profilebutton">Add Contact</button>

                    <br>

                    <p>Remove Contact:</p>
                    <input type="text" name="delcontact" value=""></input>
                    <button name="delcontactbutton" type="submit" value="" class="profilebutton">Remove Contact</button>
                </form>

                <p id="usersubs" class="profiletext"> <?php displaycontacts(); ?> </p>
            </div>  

        </div>

        <div class="maincontent">
            <div class="uploads">
                <h3 class="maintitles">Uploads</h3>
                <form action="profile.php" method="post">
                    <button class="profilebutton" name="upload" type="Submit" value="upload">Upload Video</button>
                </form>

            </div>

            <div class="playlists">
                <h3 class="maintitles">Playlists</h3>
                <form action="profile.php" method="post">
                    <button class="profilebutton" name="addplaylist" type="Submit" value="addplaylist">Add Playlist</button>
                </form>

                <?php displayplaylists(); ?>
                
            </div>

            <div class="favorites">
                <h3 class="maintitles">Favorites</h3>
                <?php displayfavorites(); ?>
                
            </div>
        </div>



    </body>


</html>