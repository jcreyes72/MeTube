<?php 
    session_start();
    include_once "helper_funcs.php";

    if(isset($_POST['Home'])){
        header("location: index.php");
    }

?>

<html>
    <head>
        <meta charset="UTF-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<link rel="stylesheet" href="messages.css">
    </head>


    <body>
        <h1>Videos about: <?php echo $_SESSION['keyword']; ?></h1>

        <form action="keyworddisplay.php" method="post">
            <button class="profilebutton" name="Home" type="Submit" value="">MeTube Home</button>
        </form>

        <section> <?php displaykeywordvideos($_SESSION['keyword']); ?></section>

    </body>
</html>