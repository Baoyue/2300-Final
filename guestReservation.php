<?php 
    session_start(); 
?>

<!DOCTYPE html>
<html>
<head>
    <title>CHES: Reservation</title>
    
    <!--MONTSERRAT-->
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <!--OPEN SANS-->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,300italic,400,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>

    <!--CSS-->
    <link href="css/style.css" rel="stylesheet" type="text/css">

    <!--SCRIPTS-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src= "js/script.js"></script>

    <!--META-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
</head>

<body>
    <!-- ~~~~~~~~~~~~~~~~~~~~NAVBAR~~~~~~~~~~~~~~~~~~~~ -->
    <?php
        include 'navbar.php';
    ?>
    <!-- ~~~~~~~~~~~~~~~~~~~~INDEX~~~~~~~~~~~~~~~~~~~~ -->
    <div class="section">
        <div class="content">
        <?php 
            $eventID = filter_input(INPUT_GET, "eventID", FILTER_SANITIZE_NUMBER_INT);
                print("<h3 class='title'>Make Reservation</h3>");
            if (!isset($_SESSION['logged_user'])) {
        ?>
                
        <?php 
                // the user has not submitted the form
                if(!isset($_POST['firstname']) || !isset($_POST['lastname']) || !isset($_POST['email']) || !isset($_POST['numReservation']) || !isset($_POST['comment'])) {

        ?>
                    <p>Please fill in the form below:</p>

                    <form name="guestRes_form" method="post" enctype="multipart/form-data">
                        <label>First Name:</label><br>
                        <input type="text" name="firstname"/><br>
                        <label>Last Name:</label><br>
                        <input type="text" name="lastname"/><br>
                        <label>Email:</label><br>
                        <input type="text" name="email"/><br>
                        <label>Number of Participants:</label><br>
                        <input type="number" name="numReservation" max=20 min=1 /><br>
                        <label>Optional Comment:</label><br>
                        <textarea name="comment" rows="8" cols="60"></textarea><br>
                        <input type="submit" name="userRes" value="Make Reservation"/>
                    </form>
        <?php 
                } else {
                    // check user's input
                    $error ="";
                    $isRegistered=false;
                    $isSignedUp=false;
                    $firstname = trim($_POST['firstname']);
                    $lastname = trim($_POST['lastname']);
                    $email = trim($_POST['email']);

                    if ($firstname == '' || $lastname == '' || $email == '') {
                        $error.="Please fill in all of the required fields";
                    } else {
                        $firstname = trim(filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING));
                        $lastname = trim(filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING));
                        $email = trim(filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL));
                        if (!preg_match("/^[A-Za-z -]+$/", $firstname)) {
                            $error.="The format of your input for first name is not valid<br>";
                        }

                        if (!preg_match("/^[A-Za-z -]+$/", $lastname)) {
                            $error.="The format of your input for last name is not valid<br>";
                        }

                        if (!filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)) {
                            $error.="The format of your email address is invalid.<br>";
                        }

                        if (isset($_POST['numReservation']) && (!filter_input(INPUT_POST, 'numReservation', FILTER_SANITIZE_NUMBER_INT) || $_POST['numReservation'] <= 0)) {
                            $error.="Your input for number of reservation must be a number greater than 0.";
                        }

                        if (isset($_POST['comment']) && (trim($_POST['comment'])!='') && (!filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_STRING))) {
                            $error.="Your input for comment is invalid";
                        }

                        require_once("config.php"); 
                        $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                        $checkRegistered = $mysqli -> query("SELECT * FROM Reservation WHERE email='$email' AND eventID=$eventID");
                        if(mysqli_num_rows($checkRegistered)>0) {
                            $isRegistered=true;
                        }

                        $checkSignedUp = $mysqli -> query("SELECT * FROM Users WHERE email='$email'");
                        if(mysqli_num_rows($checkSignedUp)>0) {
                            $isSignedUp=true;
                        }
                    }  

                    if ($isRegistered) {
                        print("<h3 class='title'>Error</h3>");
                        print("<p class='subtitle'>Sorry, you have already registered for this event!</p>");
                        print("<div class='itemButton' style='margin: 0 auto; float:none'><a href='events.php'>BACK TO EVENTS</a></div>");

                    } elseif ($isSignedUp) {
                        print("<h3 class='title'>Error</h3>");
                        print("<p class='subtitle'>Sorry, you have already signed up! Please <a href='login.php'>login</a> to make reservation.</p>");

                    } elseif ($error !="") {
                        print("<h3>Sorry, Please fix the errors below:</h3>");
                        print("<p>$error</p>");

        ?>
                        
                        <form method="post" enctype="multipart/form-data">
                            <label>First Name:</label><br>
                            <input type="text" name="firstname"/><br>
                            <label>Last Name:</label><br>
                            <input type="text" name="lastname"/><br>
                            <label>Email:</label><br>
                            <input type="text" name="email"/><br>
                            <label>Number of Participants:</label><br>
                            <input type="number" name="numReservation" max=20 min=1 /><br>
                            <label>Optional Comment:</label><br>
                            <textarea name="comment" rows="8" cols="60"></textarea><br>
                            <input type="submit" name="userRes" value="Make Reservation"/>
                        </form>
        <?php 
                    } else {
                        // the user submitted the form successfully
                        $num= filter_input(INPUT_POST, 'numReservation', FILTER_SANITIZE_NUMBER_INT);

                        $comment=isset($_POST['comment']) ? trim(filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_STRING)) : '';
                        require_once("config.php"); 
                        $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                        $result = $mysqli -> query("INSERT INTO Reservation(eventID,email,firstName,lastName,numReservations,comment) VALUES ('$eventID','$email','$firstname','$lastname','$num','$comment')"); 
                        print("<p class='subtitle'>You have successfully reserved this event!</p>");  
                        print("<div class='itemButton' style='margin:auto; float:none'><a href='events.php'>BACK TO EVENTS</a></div>");
                    }
                }
            } elseif (isset($_SESSION['isAdmin']) && !$_SESSION['isAdmin']) {
                // the user is not a registered user
                print("<h3 class='title'>Error</h3>");
                print("<p class='subtitle'>Sorry, you do not have the right to access this page. You have logged in as a registered user and please register this event as a user.</p>");
                print("<div class='itemButton'><a href='userReservation.php?eventID=$eventID'>REGISTER AS USER</a></div>");

            } else {
                print("<h3 class='title'>Error</h3>");
                print("<p class='subtitle'>Sorry, you are an admin and cannot register for an event!</p>");
            }
            print("</div>");
        ?>
    </div>

<!-- ~~~~~~~~~~~~~~~~~~~~FOOTER~~~~~~~~~~~~~~~~~~~~ -->
    <?php include 'footer.php' ?>

</body>
</html>