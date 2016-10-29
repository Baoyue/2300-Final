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
        <?php 
            $eventID = filter_input(INPUT_GET, "eventID", FILTER_SANITIZE_NUMBER_INT);
            if (isset($_SESSION['logged_user']) && isset($_SESSION['isAdmin']) && !$_SESSION['isAdmin']) {
                $userID = $_SESSION['logged_user'];
        ?>
        
        <div class="content">

            
        <?php 
                

                require_once("config.php"); 
                $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                $check = $mysqli -> query("SELECT * FROM Reservation WHERE userID=$userID AND eventID=$eventID");
                // the user has already registered for the event
                if(mysqli_num_rows($check)>0) {
                    print("<h3 class='title'>Error</h3>");
                    print("<p class='subtitle'>You have already registered for this event!</p>");
                    print("<div class='center'>");
                    print("<div class='itemButton'><a href='events.php'>BACK TO EVENTS</a></div>");
                    print("<div class='itemButton' style='margin-right: 0'><a href='parent.php'>GO TO MY ACCOUNT</a></div>");
                    print("<div class='clear'></div>");
                    print("</div>");
                } else {
                    print("<h3 class='title'>Make Reservation</h3>");
                    $result = $mysqli -> query("SELECT * FROM Users WHERE userID=$userID");
                    $row=$result->fetch_assoc();
                    $firstName=$row['firstName'];
                    $lastName=$row['lastName'];
                    $email=$row['email'];

                    // the user has not submitted the form
                    if(!isset($_POST['numReservation']) &&!isset($_POST['comment'])) {

        ?>
                        <p>Please fill in the form below:</p>

                        <form name="userRes_form" method="post" enctype="multipart/form-data">
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
                        if (isset($_POST['numReservation']) && (!filter_input(INPUT_POST, 'numReservation', FILTER_SANITIZE_NUMBER_INT) || $_POST['numReservation'] <= 0)) {
                            $error.="Your input for number of reservation must be a number greater than 0.";
                        }

                        if (isset($_POST['comment']) && (trim($_POST['comment'])!='') && (!filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_STRING))) {
                            $error.="Your input for comment is invalid";
                        }

                        $num= filter_input(INPUT_POST, 'numReservation', FILTER_SANITIZE_NUMBER_INT);

                        $comment=isset($_POST['comment']) ? trim(filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_STRING)) : '';

                        if ($error !="") {
                            print("<h2>Sorry, Please fix the errors below:</h2>");
                            print("<p>$error</p>");
        ?>
                            <p>Please fill in the form below:</p>

                            <form name="userRes_form" method="post" enctype="multipart/form-data">
                                <label>Number of Participants:</label><br>
                                <input type="number" name="numReservation" max=20 min=1/><br>
                                <label>Optional Comment:</label><br>
                                <textarea name="comment" rows="8" cols="60"></textarea><br>
                                <input type="submit" name="userRes" value="Make Reservation"/>
                            </form>
        <?php 
                        } else {
                            // the user submitted the form successfully
                            require_once("config.php"); 
                            $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                            $result = $mysqli -> query("INSERT INTO Reservation(eventID,email,firstName,lastName,numReservations,userID,comment) VALUES ('$eventID','$email','$firstName','$lastName','$num','$userID','$comment')"); 
                            print("<p class='subtitle'>You have successfully reserved this event!</p>");  
                            print("<div class='itemButton' style='margin:auto; float:none'><a href='events.php'>BACK TO EVENTS</a></div>");
                        }
                    }
                }
                print("</div>");
            } else {
                // the user is not a registered user
                print("<h3 class='title'>Error</h3>");
                print("<p class='subtitle'>Sorry, you do not have the right to access this page. Please login.</p>");
                print("<div class='itemButton'><a href='events.php'>BACK TO EVENTS</a></div>");
                print("<div class='itemButton'><a href='signup.php'>SIGN UP</a></div>");
                print("<div class='itemButton'><a href='guestReservation.php?eventID=$eventID'>RESERVE AS GUEST</a></div>");
            }  
        ?>
    </div>

<!-- ~~~~~~~~~~~~~~~~~~~~FOOTER~~~~~~~~~~~~~~~~~~~~ -->
    <?php include 'footer.php' ?>

</body>
</html>