<meta http-equiv="Cache-control" content="no-cache">


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="sidebar.css">
    <title>MeTube</title>
</head>

<?php

session_start();
include_once "helper_funcs.php";
if(isset($_POST['keywordsearch'])){
$word = $_POST['keywords'];
if($word == ""){
    die ("No keyword entered");
}
else{
    $_SESSION['keyword'] = $word;
    header("location: keyworddisplay.php");
}
}


include('homepageconnect.php');
$query = "SELECT * FROM media;";
$result = mysqli_query($db, $query) or die("Query error: " . mysqli_error($db). "\n");

//variables for categories
$sportsVideo;$sportsTitle; $sportsID;
$musicVideo; $musicTitle; $musicID;
$moviesVideo; $moviesTitle; $moviesID;
$newsVideo; $newsTitle; $newsID;
$gamingVideo; $gamingTitle; $gamingID;
$fashionVideo; $fashionTitle; $fashionID;
$learningVideo; $learningTitle; $learningID;



    while ($row = mysqli_fetch_assoc($result)){
        switch ($row['category']) {
            case "Sports":
                $sportsVideo[] = $row['filename'];
                $sportsTitle[] = $row['name'];
                $sportsID[] = $row['media_id'];
                break;
            case "Learning":
                $learningVideo[] = $row['filename'];
                $learningTitle[] = $row['name'];
                $learningID[] = $row['media_id'];
                break;
            case "Music":
                $musicVideo[] = $row['filename'];
                $musicTitle[] = $row['name'];
                $musicID[] = $row['media_id'];
                break;
            case "Movies":
                $moviesVideo[] = $row['filename'];
                $moviesTitle[] = $row['name'];
                $moviesID[] = $row['media_id'];
                break;
            case "Gaming":
                $gamingVideo[] = $row['filename'];
                $gamingTitle[] = $row['name'];
                $gamingID[] = $row['media_id'];
                break;
            case "News":
                $newsVideo[] = $row['filename'];
                $newsTitle[] = $row['name'];
                $newsID[] = $row['media_id'];
                break;
            case "Fashion":
                $fashionVideo[] = $row['filename'];
                $fashionTitle[] = $row['name'];
                $fashionID[] = $row['media_id'];
                break;
        }
    }







mysqli_free_result($result);
mysqli_close($db);


?>


    <body> 
        <!-- Navigation Bar -->
        <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
            <div class="container">
                <a href="#" class="navbar-brand">MeTube</a>

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
                    <li><a href="#movies">Movies</a></li>
                    <li><a href="#music">Music</a></li>
                    <li><a href="#sports">Sports</a></li>
                    <li><a href="#news">News</a></li>
                    <li><a href="#gaming">Gaming</a></li>
                    <li><a href="#fandb">Fashion & Beauty</a></li>
                    <li><a href="#learning">Learning</a></li>
                </ul>
            </div>
    
        </div>
        <!-- End of Sidebar -->

        <script 
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/
            bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" 
            crossorigin="anonymous">
        </script>


        <!-- Displayed Videos -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                     <!-- Search function  -->
                    <form action="index.php" method="post">
                        <h2>Keyword Search: </h2>
                        <input type="text" name="keywords" value=""></input>
                        <button name="keywordsearch" type="submit" value="" class="profilebutton">Search</button>
                    </form>
                    <div class="col-lg-12">
                        <h1 class = "big-header"> Explore </h1>
                        <h2 id="movies"> Movies </h2>
                            <video class="thumbnails" src="uploads/<?=$moviesVideo[0]?>"></video>
                            <video class="thumbnails" src="uploads/<?=$moviesVideo[1]?>"></video>
                            <video class="thumbnails" src="uploads/<?=$moviesVideo[2]?>"></video>
                                <div class="vid-text">
                                    <a href="videoplayer.php?media_id=<?php echo $moviesID[0]?>" class="video-detail-1"> <?=$moviesTitle[0]?> </a>
                                    <a href="videoplayer.php?media_id=<?php echo $moviesID[1]?>" class="video-detail-1"> <?=$moviesTitle[1]?> </a>
                                    <a href="videoplayer.php?media_id=<?php echo $moviesID[2]?>" class="video-detail-1"> <?=$moviesTitle[2]?> </a>
                                </div>
                                <br>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class = "big-header"></h1>
                        <h2 id="sports"> Sports </h2>
                            <video class="thumbnails" src="uploads/<?=$sportsVideo[0]?>"></video>
                            <video class="thumbnails" src="uploads/<?=$sportsVideo[1]?>"></video>
                            <video class="thumbnails" src="uploads/<?=$sportsVideo[2]?>"></video>
                                <div class="vid-text">
                                    <a href="videoplayer.php?media_id=<?php echo $sportsID[0]?>" class="video-detail-1"> <?=$sportsTitle[0]?> </a>
                                    <a href="videoplayer.php?media_id=<?php echo $sportsID[1]?>" class="video-detail-1"> <?=$sportsTitle[1]?> </a>
                                    <a href="videoplayer.php?media_id=<?php echo $sportsID[2]?>" class="video-detail-1"> <?=$sportsTitle[2]?> </a>
                                </div>
                                <br>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class = "big-header"></h1>
                        <br>
                        <h2 id="music"> Music </h2>
                            <video class="thumbnails" src="uploads/<?=$musicVideo[0]?>"></video>
                            <video class="thumbnails" src="uploads/<?=$musicVideo[1]?>"></video>
                            <video class="thumbnails" src="uploads/<?=$musicVideo[2]?>"></video>
                                <div class="vid-text">
                                    <a href="videoplayer.php?media_id=<?php echo $musicID[0]?>" class="video-detail-1"> <?=$musicTitle[0]?> </a>
                                    <a href="videoplayer.php?media_id=<?php echo $musicID[1]?>" class="video-detail-1"> <?=$musicTitle[1]?> </a>
                                    <a href="videoplayer.php?media_id=<?php echo $musicID[2]?>" class="video-detail-1"> <?=$musicTitle[2]?> </a>
                                </div>
                                <br>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class = "big-header"></h1>
                        <h2 id="news"> News </h2>
                            <video class="thumbnails" src="uploads/<?=$newsVideo[0]?>"></video>
                            <video class="thumbnails" src="uploads/<?=$newsVideo[1]?>"></video>
                            <video class="thumbnails" src="uploads/<?=$newsVideo[2]?>"></video>
                                <div class="vid-text">
                                    <a href="videoplayer.php?media_id=<?php echo $newsID[0]?>" class="video-detail-1"> <?=$newsTitle[0]?> </a>
                                    <a href="videoplayer.php?media_id=<?php echo $newsID[1]?>" class="video-detail-1"> <?=$newsTitle[1]?> </a>
                                    <a href="videoplayer.php?media_id=<?php echo $newsID[2]?>" class="video-detail-1"> <?=$newsTitle[2]?> </a>
                                </div>
                                <br>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class = "big-header"></h1>
                        <h2 id="Gaming"> Gaming </h2>
                            <video class="thumbnails" src="uploads/<?=$gamingVideo[0]?>"></video>
                            <video class="thumbnails" src="uploads/<?=$gamingVideo[1]?>"></video>
                            <video class="thumbnails" src="uploads/<?=$gamingVideo[2]?>"></video>
                                <div class="vid-text">
                                    <a href="videoplayer.php?media_id=<?php echo $gamingID[0]?>" class="video-detail-1"> <?=$gamingTitle[0]?> </a>
                                    <a href="videoplayer.php?media_id=<?php echo $gamingID[1]?>" class="video-detail-1"> <?=$gamingTitle[1]?> </a>
                                    <a href="videoplayer.php?media_id=<?php echo $gamingID[2]?>" class="video-detail-1"> <?=$gamingTitle[2]?> </a>
                                </div>
                                <br>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class = "big-header"></h1>
                        <h2 id="fandb"> Fashion & Beauty </h2>
                            <video class="thumbnails" src="uploads/<?=$fashionVideo[0]?>"></video>
                            <video class="thumbnails" src="uploads/<?=$fashionVideo[1]?>"></video>
                            <video class="thumbnails" src="uploads/<?=$fashionVideo[2]?>"></video>
                                <div class="vid-text">
                                    <a href="videoplayer.php?media_id=<?php echo $fashionID[0]?>" class="video-detail-1"> <?=$fashionTitle[0]?> </a>
                                    <a href="videoplayer.php?media_id=<?php echo $fashionID[1]?>" class="video-detail-1"> <?=$fashionTitle[1]?> </a>
                                    <a href="videoplayer.php?media_id=<?php echo $fashionID[2]?>" class="video-detail-1"> <?=$fashionTitle[2]?> </a>
                                </div>
                                <br>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class = "big-header"></h1>
                        <h2 id="learning"> Learning </h2>
                            <video class="thumbnails" src="uploads/<?=$learningVideo[0]?>"></video>
                            <video class="thumbnails" src="uploads/<?=$learningVideo[1]?>"></video>
                            <video class="thumbnails" src="uploads/<?=$learningVideo[2]?>"></video>
                                <div class="vid-text">
                                    <a href="videoplayer.php?media_id=<?php echo $learningID[0]?>" class="video-detail-1"> <?=$learningTitle[0]?> </a>
                                    <a href="videoplayer.php?media_id=<?php echo $learningID[1]?>" class="video-detail-1"> <?=$learningTitle[1]?> </a>
                                    <a href="videoplayer.php?media_id=<?php echo $learningID[2]?>" class="video-detail-1"> <?=$learningTitle[2]?> </a>
                                </div>
                                <br>
                                <br>
                                <br>
                    </div>
                </div>
            </div>
        </div>

    
    </body>
</html>
