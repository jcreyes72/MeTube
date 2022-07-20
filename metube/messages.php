<?php
    session_start();
    include_once "helper_funcs.php";

    if(isset($_POST['sendmessage'])){
        $sendingto = $_POST['sendto'];
        $themessage = $_POST['messagecontent'];

        if($sendingto == "" || $themessage == ""){
            echo "One or more fields empty";
        }
        else{
            sendmessage($sendingto, $themessage);
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
    	<link rel="stylesheet" href="messages.css">
    </head>

    <body>

        <form action="messages.php" method="post">
            <button class="profilebutton" name="Home" type="Submit" value="">MeTube Home</button>
        </form>

        <div class="inbox">
            <h1>Inbox</h1>
       
             <?php displayinbox(); ?>
           
        </div>

        <div class="sent">
            <h1>Sent Messages</h1>
            
            <?php displaysent(); ?>
        </div>

        <div class="sendmessage">
            <form action="messages.php" method="post" class="sendmessageform">
                <h2>Send a Message</h2>

                <div class="sendto">
                    <p>Send To: </p>
                    <input type="text" name="sendto" value=""></input>
                </div>

                <div class="messagediv">
                    <p>Message: </p>
                    <textarea type="text" name="messagecontent" value="" class="messagecontent" rows=10 cols=50></textarea>
                    <button name="sendmessage" type="submit" value="" class="profilebutton">Send Message</button>
                </div>

                

            </form>
        </div>


    </body>


</html>