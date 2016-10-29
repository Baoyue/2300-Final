<?php 
    session_start(); 
?>

<!DOCTYPE html>
<html>
<head>
    <title>CHES: Edit Reservation</title>
    
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
            if (isset($_SESSION['logged_user']) && isset($_SESSION['isAdmin']) && !$_SESSION['isAdmin']) {
                $userID = $_SESSION['logged_user'];
        ?>

                <h3 class='title'>Edit Reservation</h3>
                <div class="adminBottom">
        <?php
                $eventID = filter_input(INPUT_GET, "eventID", FILTER_SANITIZE_NUMBER_INT);
                require_once("config.php"); 
                $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                $result = $mysqli -> query("SELECT * FROM Reservation WHERE eventID=$eventID AND userID=$userID"); 
                $row=$result->fetch_assoc();
                $prevNum=$row['numReservations'];
                $prevComment=$row['comment'];
                
                // the user has not submit the form
                if (!isset($_POST['numReservations']) && !isset($_POST['comment'])) { 
        ?>

                    <p>Please fill in at least one of the blanks in the form below:</p>

                    <form name="editReservation_form" method="post" enctype="multipart/form-data">
                        <label>Number of Reservation:</label><br>
                        <input type="number" name="numReservation" <?php print("value='$prevNum'");?>/><br>
                        <label>Comment:</label><br>
                        <textarea name="comment" rows="8" cols="60" ><?php print(trim($prevComment));?></textarea><br>
                        <input type="submit" name="editReservation" value="Edit Reservation"/>
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

                    $num= isset($_POST['numReservation']) ? filter_input(INPUT_POST, 'numReservation', FILTER_SANITIZE_NUMBER_INT) : $prevNum;

                    $comment= isset($_POST['comment']) ? trim(filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_STRING)) : $prevComment;

                    if ($error !="") {
                        print("<h2>Sorry, Please fix the errors below:</h2>");
                        print("<p>$error</p>");
        ?>
                        <p>Please fill in at least one of the blanks in the form below:</p>

                        <form name="editReservation_form" method="post" enctype="multipart/form-data">
                            <label>Number of Reservation:</label><br>
                            <input type="number" name="numReservation" <?php print("value='$prevNum'");?>/><br>
                            <label>Comment:</label><br>

                            <textarea name="comment" rows="8" cols="60" ><?php print(trim($prevComment));?></textarea><br>
                            <input type="submit" name="editReservation" value="Edit Reservation"/>
                        </form>
        <?php
                    } else {
                        // the user submitted add event form successfully
                        require_once("config.php"); 
                        $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                        $result = $mysqli -> query("UPDATE Reservation SET numReservations='$num',comment='$comment' WHERE eventID=$eventID AND userID=$userID"); 
                        print("<p class='subtitle'>Your reservation has been successfully updated!</p>");  
                        print("<div class='itemButton' style='margin:auto; float:none'><a href='parent.php'>BACK TO ACCOUNT</a></div>");                
                    }

                }
                print("</div>");

            } elseif (isset($_SESSION['logged_user']) && isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']) {
                // For admins, we do not have this page on their nav bar. But if they happen to access this page, we will display an error message.
                print("<h3 class='title'>Error</h3>");
                print("<p class='subtitle'>Sorry, you do not have the right to access this page. Please login as a parent.</p>");
            } elseif (!isset($_SESSION['logged_user'])) {
                // For guests, we do not have this page on their nav bar. But if they happen to access this page, we will display an error message.
                print("<h3 class='title'>Error</h3>");
                print("<p class='subtitle'>Sorry, you have not logged in. Please login as a parent.</p>");
            }
         ?>
    </div>
<!-- ~~~~~~~~~~~~~~~~~~~~FOOTER~~~~~~~~~~~~~~~~~~~~ -->
    <?php include 'footer.php' ?>

</body>
</html>