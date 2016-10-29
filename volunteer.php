<?php 
    session_start(); 
?>

<!DOCTYPE html>
<html>
<head>
    <title>CHES: Volunteer</title>
    
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
        
        <div class="content">

            
        <?php 
                $eventID = filter_input(INPUT_GET, "eventID", FILTER_SANITIZE_NUMBER_INT);

                require_once("config.php"); 
                $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                $check = $mysqli -> query("SELECT * FROM Volunteers WHERE userID=$userID AND eventID=$eventID");
                // the user has already registered for the event
                if(mysqli_num_rows($check)>0) {
                    print("<h1 class='title'>Error</h1>");
                    print("<p class='subtitle'>You have already registered as a volunteer for this event!</p>");
                    print("<div class='center'>");
                    print("<div class='itemButton'><a href='events.php'>BACK TO EVENTS</a></div>");
                    print("<div class='itemButton' style='margin-right: 0'><a href='parent.php'>GO TO MY ACCOUNT</a></div>");
                    print("<div class='clear'></div>");
                    print("</div>");
                } else {
                    print("<h1 class='title'>Register As Volunteers</h1>");
                    $result = $mysqli -> query("INSERT INTO Volunteers(eventID,userID) VALUES ('$eventID','$userID')");
                    print("<p class='subtitle'>You have successfully registered as a volunteer! Thank you very much!</p>");  
                    print("<div class='itemButton' style='margin:auto; float:none'><a href='events.php'>BACK TO EVENTS</a></div>");
                }
                print("</div>");
            } else if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']) {
                print("<h1 class='title'>Error</h1>");
                print("<p>You are an admin and therefore could not register for events. Please go to <a href='editEvent.php'>Manage Events</a>.</p>");
            } else {
                // the user is not a registered user
                print("<h1 class='title'>Error</h1>");
                print("<p class='subtitle'>Sorry, you do not have the right to access this page. Please <a href='login.php'>login</a>.</p>");
            }
            
        ?>
    </div>

<!-- ~~~~~~~~~~~~~~~~~~~~FOOTER~~~~~~~~~~~~~~~~~~~~ -->
    <?php include 'footer.php' ?>

</body>
</html>