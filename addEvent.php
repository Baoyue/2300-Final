<?php 
    session_start(); 
?>

<!DOCTYPE html>
<html>
<head>
    <title>CHES: Add Events</title>
    
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
            if (isset($_SESSION['logged_user']) && isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']) {
                $userID = $_SESSION['logged_user'];
        ?>

        <h3 class='title'>Add new events</h3>
        <div class="adminCard">
                    
        <?php 
                // the user has not submit the form
                if (!isset($_POST['eventName']) || !isset($_POST['date']) || !isset($_POST['startTime']) || !isset($_POST['endTime']) || !isset($_POST['description'])) { 
        ?>

                    <p>Please fill in all of the blanks in the form below:</p>
                    <div class="addEvent-form">

                        <form name="addEvent_form" method="post" enctype="multipart/form-data">
                            <label>Event Name:</label><br>
                            <input type="text" name="eventName"/><br>
                            <label>Date:</label><br>
                            <input type="date" name="date"/><br>
                            <label>Start time:</label><br>
                            <input type="time" name="startTime"><br>
                            <label>End time:</label><br>
                            <input type="time" name="endTime"><br>
                            <label>Description:</label><br>
                            <textarea name="description" rows="8" cols="60"></textarea><br>
                            <input type="submit" name="addEvent" value="Add Event"/>
                        </form>

                    </div>

        <?php 
                } else {
                    // check user's input
                    $error ="";
                    if (!filter_input(INPUT_POST, 'eventName', FILTER_SANITIZE_STRING)) {
                        $error.="Your input for event name is invalid";
                    }
                    if (!isset($_POST['date'])) {
                        $error.="Please select a date";
                    }
                    if ($_POST['date'] < date("Y-m-d")) {
                        $error.="Please select a future date";
                    }
                    if (!isset($_POST['startTime'])) {
                        $error.="Please select start time";
                    }
                    if (!isset($_POST['endTime'])) {
                        $error.="Please select end time";
                    }
                    if (isset($_POST['startTime']) && isset($_POST['endTime']) &&$_POST['startTime'] >= $_POST['endTime'] ) {
                        $error.="The end time of the event cannot be piror to the start time";
                    }
                    if (!filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING)) {
                        $error.="Your input for event description is invalid";
                    }

                    $name = trim(filter_input(INPUT_POST, 'eventName', FILTER_SANITIZE_STRING));
                    $date = $_POST['date'];
                    $startTime = $_POST['startTime'];
                    $endTime = $_POST['endTime'];
                    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
                    
                    if ($error !="") {
                        print("<h2>Sorry, Please fix the errors below:</h2>");
                        print("<p>$error</p>");
        ?>
                        <br><br>
                        <p>Please fill in all of the blanks in the form below:</p>
                        <div class="addEvent-form">

                        <form name="addEvent_form" method="post" enctype="multipart/form-data">
                            <label>Event Name:</label><br>
                            <input type="text" name="eventName"/><br>
                            <label>Date:</label><br>
                            <input type="date" name="date"/><br>
                            <label>Start time:</label><br>
                            <input type="time" name="startTime"><br>
                            <label>End time:</label><br>
                            <input type="time" name="endTime"><br>
                            <label>Description:</label><br>
                            <textarea name="description" rows="8" cols="60"></textarea><br>
                            <input type="submit" name="addEvent" value="Add Event"/>
                        </form>

                    </div>
        <?php
                    } else {
                        // the user submitted add event form successfully
                        require_once("config.php"); 
                        $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                        $result = $mysqli -> query("INSERT INTO Events(eventName,date,startTime,endTime,description) VALUES ('$name','$date','$startTime','$endTime','$description')"); 
                        print("<p class='subtitle'>The event $name has been successfully added!</p>");
                        print("<br><br><br>");
                        print("<div class='adminOpt'><a href='addEvent.php'>Add another event</a></div>");
                        print("<div class='adminOpt'><a href='editEvent.php'>View Events</a></div>"); 
                        print("<div class='adminOpt' style='margin:0'><a href='admin.php'>Back to admin account</a></div>");
                        print("<div class='clear'></div>");

                    }
                }
                print("</div>");
            } else {
                // the user is not an admin
                print("<h3 class='title'>Error</h3>");
                print("<p class='subtitle'>Sorry, you do not have the right to access this page. Please login as an admin.</p>");
            }
        ?>
        
    </div>

<!-- ~~~~~~~~~~~~~~~~~~~~FOOTER~~~~~~~~~~~~~~~~~~~~ -->
    <?php include 'footer.php' ?>

</body>
</html>