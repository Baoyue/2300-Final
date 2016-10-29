<?php 
    session_start(); 
?>

<!DOCTYPE html>
<html>
<head>
    <title>CHES: Parent Account</title>
    
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
    <div class="section parent">
        <?php 
            if (isset($_SESSION['logged_user']) && isset($_SESSION['isAdmin']) && !$_SESSION['isAdmin']) {
                $userID = $_SESSION['logged_user'];
                require_once("config.php"); 
                $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                $user = $mysqli -> query("SELECT * FROM Users WHERE userID=$userID");
                while ($row0 = $user->fetch_assoc()) {
                    if ($userID == $row0['userID']) {
                        $username = $row0['firstName'];
                        print("<h3 class='title'>Welcome, $username!</h3>");
                        break;
                    }
                }

                print("<div class='adminBottom'>");
                print("<h2>Events Reservation:</h2>");

                $result = $mysqli -> query("SELECT * FROM Reservation WHERE userID=$userID");

                if(mysqli_num_rows($result)>0) {

                    while ($row = $result->fetch_assoc()) {

                        $eventID=$row['eventID'];
                        $num=$row['numReservations'];
                        $comment=$row['comment'];
                        if ($comment == '') {
                            $comment="N/A";
                        }

                        $result1 = $mysqli -> query("SELECT * FROM Events WHERE eventID=$eventID");
                        while ($row1 = $result1->fetch_assoc()) {
                            $date=$row1['date'];
                            $startTime=$row1['startTime'];
                            $endTime=$row1['endTime'];
                            $name=$row1['eventName'];
                            $description=$row1['description'];
                            print("<div class='eventItem'><h2>".$name."</h2>");
                            print("<div class='itemSub'><span>Date: ".$date."</span></div>");
                            print("<div class='itemSub'><span>Time: ".$startTime." - ".$endTime."</span></div>"); 
                            print("<div class='clear'></div>");
                            print("<p>Description: ".$description."</p>");

                            print("<p>Number of Reservation: ".$num."</p>");
                            print("<p>Comment: ".$comment."</p>");

                            print("<div class='itemButton'><a href='editReservation.php?eventID=$eventID'>EDIT RESERVATION</a></div>");
                            print("<div class='itemButton'><a href='deleteReservation.php?eventID=$eventID'>CANCEL RESERVATION</a></div>");
                            print("<div class='clear'></div>");
                            print("</div>");
                        }
                    }

                } else {
                    print("<h3 class='msg'>You have no reservations.</h3>");       
                }

                print("<h2>Volunteer Registration:</h2>");
                $result = $mysqli -> query("SELECT * FROM Volunteers WHERE userID=$userID");

                if(mysqli_num_rows($result)) {

                    while ($row = $result->fetch_assoc()) {

                        $eventID=$row['eventID'];
                        
                        $result1 = $mysqli -> query("SELECT * FROM Events WHERE eventID=$eventID");
                        while ($row1 = $result1->fetch_assoc()) {
                            $date=$row1['date'];
                            $startTime=$row1['startTime'];
                            $endTime=$row1['endTime'];
                            $name=$row1['eventName'];
                            $description=$row1['description'];
                            print("<div class='eventItem'><h2>".$name."</h2>");
                            print("<div class='itemSub'><span>Date: ".$date."</span></div>");
                            print("<div class='itemSub'><span>Time: ".$startTime." - ".$endTime."</span></div>");
                            print("<div class='clear'></div>"); 
                            print("<p>Description: ".$description."</p>");

                            print("<div class='itemButton'><a href='deleteRegistration.php?eventID=$eventID'>CANCEL REGISTRATION</a></div>");
                            print("<div class='clear'></div>");
                            print("</div>");
                        }
                    }

                } else {
                    print("<h3 class='msg'>You have no registrations.</h3>");  
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