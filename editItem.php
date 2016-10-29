<?php 
    session_start(); 
?>

<!DOCTYPE html>
<html>
<head>
    <title>CHES: Edit Event</title>
    
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

                <h3 class='title'>Edit Event</h3>
                <div class="adminBottom">
        <?php
                $eventID = filter_input(INPUT_GET, "eventID", FILTER_SANITIZE_NUMBER_INT);
                require_once("config.php"); 
                $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                $result = $mysqli -> query("SELECT * FROM Events WHERE eventID=$eventID"); 
                $row = $result->fetch_assoc();
                $prevName=$row['eventName'];
                $prevDate=$row['date'];
                $prevStart=$row['startTime'];
                $prevEnd=$row['endTime'];
                $prevDescription=$row['description'];

                // the user has not submit the form
                if (!isset($_POST['eventName']) && !isset($_POST['date']) && !isset($_POST['startTime']) && !isset($_POST['endTime']) && !isset($_POST['description'])) { 
        ?>

                    <p>Please fill in at least one of the blanks in the form below:</p>
                    <div class="editEvent-form">

                        <form name="editEvent_form" method="post" enctype="multipart/form-data">
                            <label>Event Name:</label><br>
                            <input type="text" name="eventName" <?php print("value='$prevName'");?>/><br>
                            <label>Date:</label><br>
                            <input type="date" name="date" <?php print("value='$prevDate'");?>/><br>
                            <label>Start time:</label><br>
                            <input type="time" name="startTime" <?php print("value='$prevStart'");?>><br>
                            <label>End time:</label><br>
                            <input type="time" name="endTime" <?php print("value='$prevEnd'");?>><br>
                            <label>Description:</label><br>
                            <textarea name="description" rows="8" cols="60" ><?php print($prevDescription);?></textarea><br>
                            <input type="submit" name="editEvent" value="Edit Event"/>
                        </form>

                    </div>

        <?php 
                } else {
                    // check user's input
                    $error ="";
                    if (isset($_POST['eventName']) && !filter_input(INPUT_POST, 'eventName', FILTER_SANITIZE_STRING)) {
                        $error.="Your input for event name is invalid";
                    }

                    if (isset($_POST['description']) && !filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING)) {
                        $error.="Your input for event description is invalid";
                    }

                    $name= isset($_POST['eventName']) ? trim(filter_input(INPUT_POST, 'eventName', FILTER_SANITIZE_STRING)) : $prevName;
                    $date= isset($_POST['date']) ? $_POST['date'] : $prevDate;
                    $startTime= isset($_POST['startTime']) ? $_POST['startTime'] : $prevStart;
                    $endTime= isset($_POST['endTime']) ? $_POST['endTime'] : $prevEnd;
                    $description= isset($_POST['description']) ? trim(filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING)) : $prevDescription;
                    
                    if ($startTime>=$endTime ) {
                        $error.="The end time of the event cannot be piror to the start time";
                    }
                    
                    
                    if ($error !="") {
                        print("<h2>Sorry, Please fix the errors below:</h2>");
                        print("<p>$error</p>");
        ?>
                    <p>Please fill in at least one of the blanks in the form below:</p>
                    <div class="editEvent-form">

                        <form name="editEvent_form" method="post" enctype="multipart/form-data">
                            <label>Event Name:</label><br>
                            <input type="text" name="eventName" <?php print("value='$prevName'");?>/><br>
                            <label>Date:</label><br>
                            <input type="date" name="date" <?php print("value='$prevDate'");?>/><br>
                            <label>Start time:</label><br>
                            <input type="time" name="startTime" <?php print("value='$prevStart'");?>><br>
                            <label>End time:</label><br>
                            <input type="time" name="endTime" <?php print("value='$prevEnd'");?>><br>
                            <label>Description:</label><br>
                            <textarea name="description" rows="8" cols="60" ><?php print($prevDescription);?></textarea><br>
                            <input type="submit" name="editEvent" value="Edit Event"/>
                        </form>

                    </div>

                        
        <?php
                    } else {
                        // the user submitted add event form successfully
                        require_once("config.php"); 
                        $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                        $result = $mysqli -> query("UPDATE Events SET eventName='$name',date='$date',startTime='$startTime',endTime='$endTime',description='$description' WHERE eventID=$eventID"); 
                        print("<p class='subtitle'>The event $name has been successfully updated!</p>");  
                        print("<div class='itemButton' style='margin:auto; float:none'><a href='editEvent.php'>BACK TO EVENTS LIST</a></div>");
                                       
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