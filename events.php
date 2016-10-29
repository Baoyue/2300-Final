<?php 
session_start(); 
?>

<!DOCTYPE html>
<html>
<head>
    <title>CHES: Events</title>
    
    <!--MONTSERRAT-->
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <!--OPEN SANS-->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,300italic,400,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>

    <!--CSS-->
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link href="css/styles.css" rel="stylesheet" type="text/css">

    <!--SCRIPTS-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src= "js/script.js"></script>

    <!--META-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
</head>

<body>
    <!-- ~~~~~~~~~~~~~~~~~~~~NAVBAR~~~~~~~~~~~~~~~~~~~~ -->
    <?php include 'navbar.php'; ?>
    <!-- ~~~~~~~~~~~~~~~~~~~~INDEX~~~~~~~~~~~~~~~~~~~~ -->
    <div class="section events">
        <?php 
        if (isset($_SESSION['logged_user']) && isset($_SESSION['isAdmin']) && !$_SESSION['isAdmin']) {
            $userID = $_SESSION['logged_user'];
        } else {
            $userID = 0;
        }
        ?>

        <div class="content">
            <h3 class="title">Events</h3>
            <?php 
            require_once("config.php"); 
            $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
            $result = $mysqli -> query("SELECT * FROM Events"); 
            if (!mysqli_num_rows($result)) {
                    print("<h3>There is no events.</h3>");
            } else {
                while ($row = $result->fetch_assoc()) {
                    $eventID=$row['eventID'];
                    $date=$row['date'];
                    $startTime=$row['startTime'];
                    $endTime=$row['endTime'];
                    $name=$row['eventName'];
                    $description=$row['description'];
                    print("<div class='eventItem'><h2>".$name."</h2>");
                    print("<div class='itemSub'><span><p>Date: ".$date."</p></span></div>");
                    print("<div class='itemSub'><span><p>Time: ".$startTime." - ".$endTime."</p></span></div>"); 
                    print("<div class='clear'></div>");
                    print("<p>Description: ".$description."</p>");
                    if ($userID != 0) {
                        print("<div class='itemButton'><a href='userReservation.php?eventID=$eventID'>MAKE RESERVATION</a></div>");
                        print("<div class='itemButton'><a href='volunteer.php?eventID=$eventID'>REGISTER VOLUNTEER</a></div>");
                    } elseif ($userID == 0 && !isset($_SESSION['isAdmin'])){
                        print("<p>By <a href='signup.php'>signing up</a>, you can reserve an event easily and register as volunteer for this event!</p>");
                        print("<div class='itemButton'><a href='guestReservation.php?eventID=$eventID'>MAKE RESERVATION</a></div>");
                    } else {
                        print("<p>You are an admin and therefore could not register for events. Please go to <a href='editEvent.php'>Manage Events</a>.</p>");
                    }
                    print("<div class='clear'></div>");
                    print("</div>");
                }
            }

            ?>
            <br>
            <br>
            <h3 class="title">General Events</h3>
            <div class='row separator'></div>
            <?php

            $info = array(
                array("All-School Picnic", "Bring a dish to pass, your own picnic supplies, and a smile to this opportunity to get acquainted with the families that make up our great school community.", "img/Picnic.png"),
                array("Carnival", "This is a fun ticket-based CHES spring fundraiser.  There are tons of games, a bounce house, a cakewalk, dinner items and a bake sale.  Scholarship tickets are available.", "img/Carnival.png"),
                array("Ches 5k/Fun Run", "Put on your running shoes, and join this fun family event. Runners and spectators of all ages are encouraged to participate in the fun. Funds raised will support the CHES PTA.", "img/Fun-Run.png"),
                array("Curriculum Breakfast", "Thank you teachers!  This is a parent made breakfast for all the teachers following Curriculum Night.", "img/Breakfast.png"),
                array("Firehouse Fundraiser", "Come and enjoy a parents’ night out!  This fall evening event will include a variety of unique items and classroom projects available for bidding.", "img/Firehouse.png"),
                array("The Great Escape", "Watch your children climb, swing and jump their way through an obstacle course.  It is a donation at the door event and dinner is for sale in the cafeteria.", "img/Obstacle-Course.png")
                );

            for ($x=0; $x < sizeof($info); $x++) {
                if ($x%3===0) {
                    echo "<div class='row'>";
                }

                $img = $info[$x][2];
                $name = $info[$x][0];
                $desc = $info[$x][1];

                echo "<div class='col-md-4'>";
                echo "<div class='program-picture'>";
                echo "<img src='$img' alt='image' class='program-symbol'>";
                echo "</div>";
                echo "<h3 class='program-names'>$name</h3>";
                echo "<p class='program-desc'>$desc</p>";
                echo "</div>";
                if ($x%3===2) {
                    echo "</div>";
                }
            }
            echo "</div>";

            ?>
    </div>

    <!-- ~~~~~~~~~~~~~~~~~~~~FOOTER~~~~~~~~~~~~~~~~~~~~ -->
    <?php include 'footer.php' ?>

</body>
</html>