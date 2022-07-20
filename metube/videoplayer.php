<link rel="stylesheet" href="sidebar.css">

<?php 
    include('homepageconnect.php');
    include_once "helper_funcs.php";
    session_start();

    // check GET request ID param
    if (isset($_GET['media_id'])){

        $id = mysqli_real_escape_string($db, $_GET['media_id']);

        // make sql
        $sql = "SELECT * FROM media WHERE media_id = $id";

        // get query result
        $result = mysqli_query($db, $sql);

        $video = mysqli_fetch_assoc($result);

        mysqli_free_result($result);

        if(isset($_POST['addfav'])){
            addfavorite($id);
        }

        if(isset($_POST['sub'])){
            subscribe($video['user_id']);
        }

        if(isset($_POST['unsub'])){
            unsubscribe($video['user_id']);
        }

        if(isset($_POST['addcom'])){
            $comment = $_POST['commentcontent'];
            addcomment($comment, $id);
        }

        if(isset($_POST['addtoplaylist'])){
            $_SESSION['mediaid'] = $id;
            header("location: addtoplaylist.php");

        }
    }


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="sidebar.css">
    <title><a href="metube/index.php">MeTube</a></title>
</head>



    <body class = "media_page"> 
        <!-- Navigation Bar -->
        <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
            <div class="container">
                <a href="index.php" class="navbar-brand">MeTube</a>

                <button class="navbar-toggler" 
                        type="button" 
                        data-bs-toggle="collapse" 
                        data-bs-target="#navmenu"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navmenu">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a href="profile.php" class="nav-link">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a href="profile.php" class="nav-link">Subscriptions</a>
                        </li>
                        <li class="nav-item">
                            <a href="profile.php" class="nav-link">Messages</a>
                        </li>
                        <li class="nav-item">
                            <a href="login.php" class="nav-link">Log in / Log out</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End of Navigation Bar -->

                <!-- Sidebar -->
                <div id="wrapper">
            
            <div id="sidebar-wrapper">
                <ul class="sidebar-nav">
                    <li><a href="#">Movies</a></li>
                    <li><a href="#">Music</a></li>
                    <li><a href="#">Sports</a></li>
                    <li><a href="#">News</a></li>
                    <li><a href="#">Gaming</a></li>
                    <li><a href="#">Fashion & Beauty</a></li>
                    <li><a href="#">Learning</a></li>
                </ul>
            </div>
    
        </div>
        <!-- End of Sidebar -->


        <script 
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/
            bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" 
            crossorigin="anonymous">
        </script>


    

    <div class="video_container">
        <div class="c_video">
            <video class="video_player" controls autoplay>
                <source src="uploads/<?=$video['filename']?>"></video> 
            </div>
     </div>
    

    <div class="comment_section">
        
            <form class="videobuttons" method="post">
                <button name="addfav" type="submit" value="" class="profilebutton">Add to Favorites</button>
                <button name="addtoplaylist" type="submit" value="" class="profilebutton">Add to a Playlist</button>
            </form>

        <h4 class="video_title"><?php echo $video['name']?></h4>
        <h6> Uploaded by: <?php echo $video['user_id']?></h6>
        <a href="uploads/<?=$video['filename']?>" download >Download Video</a>

        <form class="videobuttons" method="post">
            <button name="sub" type="submit" value="" class="profilebutton">Subscribe</button>
            <button name="unsub" type="submit" value="" class="profilebutton">Unsubscribe</button>
        </form>

        <h2 class="big-header">Comments</h2>

        <form method="post" class="addcomment">

                <div class="comments">
                    <p>Add a comment</p>
                    <textarea type="text" name="commentcontent" value="" class="comment" rows=2 cols=100></textarea>
                    <button name="addcom" type="submit" value="" class="profilebutton">Add Comment</button>
                </div>

                

            </form>
    


    <?php 

        // check GET request ID param
        if (isset($_GET['media_id'])){

            $id = mysqli_real_escape_string($db, $_GET['media_id']);

            // make sql
            $sql = "SELECT * FROM comments WHERE media_id = $id";

            // get query result
            $result = mysqli_query($db, $sql);


            while ($comments = mysqli_fetch_assoc($result)){
                ?><h6>
                <?php print ($comments['user_id'].":  ".$comments['comment']); ?></h6> &nbsp
                <?php
            }

            mysqli_free_result($result);
            mysqli_close($db);


        }

    ?>
    </div>


    </body>
</html>

