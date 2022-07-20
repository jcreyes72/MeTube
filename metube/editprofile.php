<?php
    
    session_start();
    include_once "helper_funcs.php";

    $username = $_SESSION['account'];

    if(isset($_POST['submitbio'])){
        $newbio = $_POST['biotextbox'];
        $bio_result = setbio($newbio);

        if($bio_result == 0)
            echo "bio updated successfully";
    }

    if(isset($_POST['submitpassword'])){
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];

        if($password == "" || $cpassword == ""){
            echo "One or more fields missing";
        }

        else if($password != $cpassword){
            echo "Passwords do not match";
        }
        else{
            $pass_result = updatepassword($password);

            if($pass_result == 0)
                echo "Password updated successfully";
        }
    }

    if(isset($_POST['Home'])){
        header('location: index.php');
    }

?>

<html>
    <head>
        <meta charset="UTF-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<link rel="stylesheet" href="editprofile.css">
    </head>

    <body>

        <form action="editprofile.php" method="post">
            <button class="subbutton" name="Home" type="submit" value="">MeTube Home</button>
        </form>

        <form action="editprofile.php" method="post" class="changebio">
            <h3>Edit <?php echo $_SESSION['account']?>'s Bio</h3>

            <textarea rows = 5 cols = 50 class="biotextbox" name="biotextbox">
                <?php display_bio(); ?>
            </textarea>

            <button name="submitbio" type="submit" value="submit" class="subbutton">Submit</button>
        </form>

        <form action="editprofile.php" method="post" class="changepassword">
            <h1>Change Password</h1>

            <h3>New Password</h3>
            <input type="input" name="password" value="">

            <h3>Confirm Password</h3>
            <input type="input" name="cpassword" value="">

            <button name="submitpassword" type="submit" value="submit" class="subbutton">Submit</button>

        </form>


    </body>
    

</html>